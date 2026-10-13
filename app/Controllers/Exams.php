<?php

namespace App\Controllers;

class Exams extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $exams = $db->table('exams')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResult();

        return view('exams/index', [
            'exams' => $exams
        ]);
    }

    public function create()
{
    $db = \Config\Database::connect();

    $classes = $db->table('classes')
        ->where('status', 'active')
        ->orderBy('name', 'ASC')
        ->get()
        ->getResult();

    $sections = $db->table('sections')
        ->where('status', 'active')
        ->orderBy('name', 'ASC')
        ->get()
        ->getResult();

    return view('exams/create', [
        'classes'  => $classes,
        'sections' => $sections
    ]);
}
    public function store()
{
    $db = \Config\Database::connect();

    $db->table('exams')->insert([
        'name'        => trim($this->request->getPost('name')),
        'term'        => $this->request->getPost('term') ?: null,
        'class_id'    => $this->request->getPost('class_id') ?: null,
        'section_id'  => $this->request->getPost('section_id') ?: null,
        'exam_date'   => $this->request->getPost('exam_date') ?: null,
        'description' => $this->request->getPost('description'),
        'status'      => $this->request->getPost('status') ?: 'upcoming',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s'),
    ]);

    return redirect()->to('/exams');
}

    public function view($id)
    {
        $db = \Config\Database::connect();

        $exam = $db->table('exams')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$exam) {
            return redirect()->to('/exams');
        }

        $subjects = $db->table('exam_subjects')
            ->where('exam_id', $id)
            ->orderBy('id', 'ASC')
            ->get()
            ->getResult();

        return view('exams/view', [
            'exam'     => $exam,
            'subjects' => $subjects
        ]);
    }

    public function edit($id)
{
    $db = \Config\Database::connect();

    $exam = $db->table('exams')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$exam) {
        return redirect()->to('/exams');
    }

    $classes = $db->table('classes')
        ->where('status', 'active')
        ->orderBy('name', 'ASC')
        ->get()
        ->getResult();

    $sections = $db->table('sections')
        ->where('status', 'active')
        ->orderBy('name', 'ASC')
        ->get()
        ->getResult();

    return view('exams/edit', [
        'exam'     => $exam,
        'classes'  => $classes,
        'sections' => $sections
    ]);
}

    public function update($id)
{
    $db = \Config\Database::connect();

    $db->table('exams')
        ->where('id', $id)
        ->update([
            'name'        => trim($this->request->getPost('name')),
            'term'        => $this->request->getPost('term') ?: null,
            'class_id'    => $this->request->getPost('class_id') ?: null,
            'section_id'  => $this->request->getPost('section_id') ?: null,
            'exam_date'   => $this->request->getPost('exam_date') ?: null,
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status') ?: 'upcoming',
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

    return redirect()->to('/exams');
}

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('exams')
            ->where('id', $id)
            ->delete();

        return redirect()->to('/exams');
    }

    public function addSubject($examId)
    {
        $db = \Config\Database::connect();

        $exam = $db->table('exams')
            ->where('id', $examId)
            ->get()
            ->getRow();

        if (!$exam) {
            return redirect()->to('/exams');
        }

        return view('exams/add_subject', [
            'exam' => $exam
        ]);
    }

    public function storeSubject()
    {
        $db = \Config\Database::connect();

        $db->table('exam_subjects')->insert([
            'exam_id'      => $this->request->getPost('exam_id'),
            'subject_name' => trim($this->request->getPost('subject_name')),
            'total_marks'  => $this->request->getPost('total_marks') ?: 100,
            'exam_date'    => $this->request->getPost('exam_date') ?: null,
            'start_time'   => $this->request->getPost('start_time') ?: null,
            'end_time'     => $this->request->getPost('end_time') ?: null,
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(
            '/exams/view/' . $this->request->getPost('exam_id')
        );
    }
    public function editSubject($id)
{
    $db = \Config\Database::connect();

    $subject = $db->table('exam_subjects')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$subject) {
        return redirect()->to('/exams');
    }

    return view('exams/edit_subject', [
        'subject' => $subject
    ]);
}
public function updateSubject($id)
{
    $db = \Config\Database::connect();

    $subject = $db->table('exam_subjects')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$subject) {
        return redirect()->to('/exams');
    }

    $db->table('exam_subjects')
        ->where('id', $id)
        ->update([
            'subject_name' => trim($this->request->getPost('subject_name')),
            'total_marks'  => $this->request->getPost('total_marks') ?: 100,
            'exam_date'    => $this->request->getPost('exam_date') ?: null,
            'start_time'   => $this->request->getPost('start_time') ?: null,
            'end_time'     => $this->request->getPost('end_time') ?: null,
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

    return redirect()->to('/exams/view/' . $subject->exam_id);
}
public function deleteSubject($id)
{
    $db = \Config\Database::connect();

    $subject = $db->table('exam_subjects')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$subject) {
        return redirect()->to('/exams');
    }

    $examId = $subject->exam_id;

    $db->table('exam_subjects')
        ->where('id', $id)
        ->delete();

    return redirect()->to('/exams/view/' . $examId);
}
public function schedule($examId)
{
    $db = \Config\Database::connect();

    $exam = $db->table('exams')
        ->where('id', $examId)
        ->get()
        ->getRow();

    if (!$exam) {
        return redirect()->to('/exams');
    }

    $subjects = $db->table('exam_subjects')
        ->where('exam_id', $examId)
        ->orderBy('id', 'ASC')
        ->get()
        ->getResult();

    $schedules = $db->table('exam_schedules')
        ->where('exam_id', $examId)
        ->orderBy('schedule_date', 'ASC')
        ->orderBy('start_time', 'ASC')
        ->get()
        ->getResult();

    return view('exams/schedule', [
        'exam'      => $exam,
        'subjects'  => $subjects,
        'schedules' => $schedules
    ]);
}
public function addSchedule($examId)
{
    $db = \Config\Database::connect();

    $exam = $db->table('exams')
        ->where('id', $examId)
        ->get()
        ->getRow();

    if (!$exam) {
        return redirect()->to('/exams');
    }

    $subjects = $db->table('exam_subjects')
        ->where('exam_id', $examId)
        ->orderBy('id', 'ASC')
        ->get()
        ->getResult();

    return view('exams/add_schedule', [
        'exam'     => $exam,
        'subjects' => $subjects
    ]);
}
public function storeSchedule()
{
    $db = \Config\Database::connect();

    $examId = $this->request->getPost('exam_id');

    $db->table('exam_schedules')->insert([
        'exam_id'       => $examId,
        'subject_id'    => $this->request->getPost('subject_id'),
        'schedule_date' => $this->request->getPost('schedule_date') ?: null,
        'start_time'    => $this->request->getPost('start_time') ?: null,
        'end_time'      => $this->request->getPost('end_time') ?: null,
        'room'          => trim($this->request->getPost('room')),
        'notes'         => trim($this->request->getPost('notes')),
        'created_at'    => date('Y-m-d H:i:s'),
        'updated_at'    => date('Y-m-d H:i:s'),
    ]);

    return redirect()->to('/exams/schedule/' . $examId);
}
public function editSchedule($id)
{
    $db = \Config\Database::connect();

    $schedule = $db->table('exam_schedules')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$schedule) {
        return redirect()->to('/exams');
    }

    $exam = $db->table('exams')
        ->where('id', $schedule->exam_id)
        ->get()
        ->getRow();

    if (!$exam) {
        return redirect()->to('/exams');
    }

    $subjects = $db->table('exam_subjects')
        ->where('exam_id', $schedule->exam_id)
        ->orderBy('id', 'ASC')
        ->get()
        ->getResult();

    return view('exams/edit_schedule', [
        'schedule' => $schedule,
        'exam'     => $exam,
        'subjects' => $subjects
    ]);
}
public function updateSchedule($id)
{
    $db = \Config\Database::connect();

    $schedule = $db->table('exam_schedules')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$schedule) {
        return redirect()->to('/exams');
    }

    $db->table('exam_schedules')
        ->where('id', $id)
        ->update([
            'subject_id'    => $this->request->getPost('subject_id'),
            'schedule_date' => $this->request->getPost('schedule_date') ?: null,
            'start_time'    => $this->request->getPost('start_time') ?: null,
            'end_time'      => $this->request->getPost('end_time') ?: null,
            'room'          => trim($this->request->getPost('room')),
            'notes'         => trim($this->request->getPost('notes')),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

    return redirect()->to('/exams/schedule/' . $schedule->exam_id);
}
public function deleteSchedule($id)
{
    $db = \Config\Database::connect();

    $schedule = $db->table('exam_schedules')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$schedule) {
        return redirect()->to('/exams');
    }

    $examId = $schedule->exam_id;

    $db->table('exam_schedules')
        ->where('id', $id)
        ->delete();

    return redirect()->to('/exams/schedule/' . $examId);
}
}