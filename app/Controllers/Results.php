<?php

namespace App\Controllers;

class Results extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $results = $db->table('results')
            ->select('
                results.*,
                students.first_name,
                students.last_name,
                students.admission_no,
                exams.name as exam_name,
                exam_subjects.subject_name
            ')
            ->join('students', 'students.id = results.student_id', 'left')
            ->join('exams', 'exams.id = results.exam_id', 'left')
            ->join(
                'exam_subjects',
                'exam_subjects.id = results.subject_id',
                'left'
            )
            ->orderBy('results.id', 'DESC')
            ->get()
            ->getResult();

        foreach ($results as $result) {

            $totalMarks = (float) $result->total_marks;
            $marksObtained = (float) $result->marks_obtained;

            $result->percentage = $totalMarks > 0
                ? ($marksObtained / $totalMarks) * 100
                : 0;

            $result->grade = $this->calculateGrade($result->percentage);
        }

        return view('results/index', [
            'results' => $results
        ]);
    }


    public function create()
    {
        $db = \Config\Database::connect();

        $students = $db->table('students')
            ->where('status', 'active')
            ->orderBy('first_name', 'ASC')
            ->get()
            ->getResult();

        $exams = $db->table('exams')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResult();

        $subjects = $db->table('exam_subjects')
            ->orderBy('subject_name', 'ASC')
            ->get()
            ->getResult();

        return view('results/create', [
            'students' => $students,
            'exams'    => $exams,
            'subjects' => $subjects
        ]);
    }


    public function store()
    {
        $db = \Config\Database::connect();

        $marksObtained = (float) $this->request->getPost('marks_obtained');
        $totalMarks    = (float) $this->request->getPost('total_marks');

        $percentage = $totalMarks > 0
            ? ($marksObtained / $totalMarks) * 100
            : 0;

        $grade = $this->calculateGrade($percentage);

        $db->table('results')->insert([
            'student_id'     => $this->request->getPost('student_id'),
            'exam_id'        => $this->request->getPost('exam_id'),
            'subject_id'     => $this->request->getPost('subject_id'),
            'marks_obtained' => $marksObtained,
            'total_marks'    => $totalMarks,
            'grade'          => $grade,
            'remarks'        => $this->request->getPost('remarks'),
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/results');
    }


    public function view($id)
    {
        $db = \Config\Database::connect();

        $selectedResult = $db->table('results')
            ->select('
                results.*,
                students.first_name,
                students.last_name,
                students.admission_no,
                exams.name as exam_name,
                exams.term,
                exams.exam_date
            ')
            ->join('students', 'students.id = results.student_id', 'left')
            ->join('exams', 'exams.id = results.exam_id', 'left')
            ->where('results.id', $id)
            ->get()
            ->getRow();

        if (!$selectedResult) {
            return redirect()->to('/results');
        }

        $results = $db->table('results')
            ->select('
                results.*,
                exam_subjects.subject_name
            ')
            ->join(
                'exam_subjects',
                'exam_subjects.id = results.subject_id',
                'left'
            )
            ->where('results.student_id', $selectedResult->student_id)
            ->where('results.exam_id', $selectedResult->exam_id)
            ->orderBy('exam_subjects.subject_name', 'ASC')
            ->get()
            ->getResult();

        $totalObtained = 0;
        $totalMarks = 0;

        foreach ($results as $result) {
            $totalObtained += (float) $result->marks_obtained;
            $totalMarks += (float) $result->total_marks;

            $result->percentage = $result->total_marks > 0
                ? ((float) $result->marks_obtained / (float) $result->total_marks) * 100
                : 0;

            $result->grade = $this->calculateGrade($result->percentage);
        }

        $overallPercentage = $totalMarks > 0
            ? ($totalObtained / $totalMarks) * 100
            : 0;

        $overallGrade = $this->calculateGrade($overallPercentage);

        $overallStatus = $overallPercentage >= 40
            ? 'Pass'
            : 'Fail';

        return view('results/view', [
            'student'           => $selectedResult,
            'results'           => $results,
            'totalObtained'     => $totalObtained,
            'totalMarks'        => $totalMarks,
            'overallPercentage' => $overallPercentage,
            'overallGrade'      => $overallGrade,
            'overallStatus'     => $overallStatus,
        ]);
    }


    public function edit($id)
    {
        $db = \Config\Database::connect();

        $result = $db->table('results')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$result) {
            return redirect()->to('/results');
        }

        $students = $db->table('students')
            ->where('status', 'active')
            ->orderBy('first_name', 'ASC')
            ->get()
            ->getResult();

        $exams = $db->table('exams')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResult();

        $subjects = $db->table('exam_subjects')
            ->orderBy('subject_name', 'ASC')
            ->get()
            ->getResult();

        return view('results/edit', [
            'result'   => $result,
            'students' => $students,
            'exams'    => $exams,
            'subjects' => $subjects
        ]);
    }


    public function update($id)
    {
        $db = \Config\Database::connect();

        $marksObtained = (float) $this->request->getPost('marks_obtained');
        $totalMarks    = (float) $this->request->getPost('total_marks');

        $percentage = $totalMarks > 0
            ? ($marksObtained / $totalMarks) * 100
            : 0;

        $grade = $this->calculateGrade($percentage);

        $db->table('results')
            ->where('id', $id)
            ->update([
                'student_id'     => $this->request->getPost('student_id'),
                'exam_id'        => $this->request->getPost('exam_id'),
                'subject_id'     => $this->request->getPost('subject_id'),
                'marks_obtained' => $marksObtained,
                'total_marks'    => $totalMarks,
                'grade'          => $grade,
                'remarks'        => $this->request->getPost('remarks'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ]);

        return redirect()->to('/results');
    }


    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('results')
            ->where('id', $id)
            ->delete();

        return redirect()->to('/results');
    }


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