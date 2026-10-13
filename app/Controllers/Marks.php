<?php

namespace App\Controllers;

class Marks extends BaseController
{
    public function index($examId, $subjectId)
    {
        $db = \Config\Database::connect();

        // Get exam
        $exam = $db->table('exams')
            ->where('id', $examId)
            ->get()
            ->getRow();

        if (!$exam) {
            return redirect()->to('/exams');
        }

        // Get exam subject
        $subject = $db->table('exam_subjects')
            ->where('id', $subjectId)
            ->where('exam_id', $examId)
            ->get()
            ->getRow();

        if (!$subject) {
            return redirect()->to('/exams/view/' . $examId);
        }

        // Get students of selected class and section
        $students = $db->table('students')
            ->where('class_id', $exam->class_id)
            ->where('section_id', $exam->section_id)
            ->where('status', 'active')
            ->orderBy('first_name', 'ASC')
            ->get()
            ->getResult();

        // Get existing marks
        $marks = $db->table('exam_marks')
            ->where('exam_id', $examId)
            ->where('subject_id', $subjectId)
            ->get()
            ->getResult();

        $marksByStudent = [];

        foreach ($marks as $mark) {
            $marksByStudent[$mark->student_id] = $mark;
        }

        return view('marks/index', [
            'exam'           => $exam,
            'subject'        => $subject,
            'students'       => $students,
            'marksByStudent' => $marksByStudent
        ]);
    }


    public function save()
    {
        dd($this->request->getPost());
        $db = \Config\Database::connect();

        $examId    = $this->request->getPost('exam_id');
        $subjectId = $this->request->getPost('subject_id');
        $marks     = $this->request->getPost('marks');

        if (!$examId || !$subjectId || !is_array($marks)) {
            return redirect()->to('/exams');
        }

        $subject = $db->table('exam_subjects')
            ->where('id', $subjectId)
            ->where('exam_id', $examId)
            ->get()
            ->getRow();

        if (!$subject) {
            return redirect()->to('/exams');
        }


        foreach ($marks as $studentId => $obtainedMarks) {

            $obtainedMarks = trim($obtainedMarks);

            // Empty marks are allowed
            if ($obtainedMarks === '') {
                $obtainedValue = null;
            } else {

                $obtainedValue = (float) $obtainedMarks;

                // Prevent marks greater than total marks
                if ($obtainedValue > $subject->total_marks) {
                    $obtainedValue = (float) $subject->total_marks;
                }

                // Prevent negative marks
                if ($obtainedValue < 0) {
                    $obtainedValue = 0;
                }
            }


            /*
             * ---------------------------------------------------------
             * SAVE / UPDATE EXAM MARKS
             * ---------------------------------------------------------
             */

            $existing = $db->table('exam_marks')
                ->where('exam_id', $examId)
                ->where('subject_id', $subjectId)
                ->where('student_id', $studentId)
                ->get()
                ->getRow();


            if ($existing) {

                $db->table('exam_marks')
                    ->where('id', $existing->id)
                    ->update([
                        'obtained_marks' => $obtainedValue,
                        'total_marks'    => $subject->total_marks,
                        'updated_at'     => date('Y-m-d H:i:s'),
                    ]);

            } else {

                $db->table('exam_marks')->insert([
                    'exam_id'        => $examId,
                    'subject_id'     => $subjectId,
                    'student_id'     => $studentId,
                    'total_marks'    => $subject->total_marks,
                    'obtained_marks' => $obtainedValue,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s'),
                ]);
            }


            /*
             * ---------------------------------------------------------
             * SYNC MARKS TO RESULTS
             * ---------------------------------------------------------
             */

            if ($obtainedValue !== null) {

                $totalMarks = (float) $subject->total_marks;

                $percentage = $totalMarks > 0
                    ? ($obtainedValue / $totalMarks) * 100
                    : 0;

                $grade = $this->calculateGrade($percentage);


                // Check whether result already exists
                $existingResult = $db->table('results')
                    ->where('student_id', $studentId)
                    ->where('exam_id', $examId)
                    ->where('subject_id', $subjectId)
                    ->get()
                    ->getRow();


                if ($existingResult) {

                    // Update existing result
                    $db->table('results')
                        ->where('id', $existingResult->id)
                        ->update([
                            'marks_obtained' => $obtainedValue,
                            'total_marks'    => $totalMarks,
                            'grade'          => $grade,
                            'updated_at'     => date('Y-m-d H:i:s'),
                        ]);

                } else {

                    // Create new result
                    $db->table('results')->insert([
                        'student_id'     => $studentId,
                        'exam_id'        => $examId,
                        'subject_id'     => $subjectId,
                        'marks_obtained' => $obtainedValue,
                        'total_marks'    => $totalMarks,
                        'grade'          => $grade,
                        'remarks'        => null,
                        'created_at'     => date('Y-m-d H:i:s'),
                        'updated_at'     => date('Y-m-d H:i:s'),
                    ]);
                }
            }
        }


        return redirect()->to(
            '/exams/marks/' . $examId . '/' . $subjectId
        );
    }


    /*
     * -------------------------------------------------------------
     * GRADE CALCULATION
     * -------------------------------------------------------------
     */

    private function calculateGrade($percentage)
    {
        if ($percentage >= 80) {
            return 'A+';
        } elseif ($percentage >= 70) {
            return 'A';
        } elseif ($percentage >= 60) {
            return 'B';
        } elseif ($percentage >= 50) {
            return 'C';
        } elseif ($percentage >= 40) {
            return 'D';
        }

        return 'F';
    }
}