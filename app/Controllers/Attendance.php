<?php

namespace App\Controllers;

class Attendance extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $attendance = $db->table('attendance')
            ->select('attendance.*, students.first_name, students.last_name, students.admission_no')
            ->join('students', 'students.id = attendance.student_id', 'left')
            ->orderBy('attendance.attendance_date', 'DESC')
            ->orderBy('attendance.id', 'DESC')
            ->get()
            ->getResult();

        return view('attendance/index', [
            'attendance' => $attendance
        ]);
    }
    public function bulk()
{
    $db = \Config\Database::connect();

    $classes = $db->table('classes')
        ->orderBy('name', 'ASC')
        ->get()
        ->getResult();

    return view('attendance/bulk', [
        'classes' => $classes
    ]);
}
public function students($classId)
{
    $db = \Config\Database::connect();

    $students = $db->table('students')
        ->where('class_id', $classId)
        ->where('status', 'active')
        ->orderBy('first_name', 'ASC')
        ->get()
        ->getResult();

    return $this->response->setJSON($students);
}
public function bulkStore()
{
    $db = \Config\Database::connect();

    $classId = $this->request->getPost('class_id');
    $attendanceDate = $this->request->getPost('attendance_date');
    $students = $this->request->getPost('students');

    if (!$classId || !$attendanceDate || empty($students)) {
        return redirect()->back()
            ->with('error', 'Please select class, date and students.');
    }

    foreach ($students as $student) {

        $studentId = $student['student_id'];
        $status = $student['status'];
        $remarks = $student['remarks'] ?? null;

        // Check if attendance already exists
        $existing = $db->table('attendance')
            ->where('student_id', $studentId)
            ->where('attendance_date', $attendanceDate)
            ->get()
            ->getRow();

        if ($existing) {

            // Update existing attendance
            $db->table('attendance')
                ->where('id', $existing->id)
                ->update([
                    'status'     => $status,
                    'remarks'    => $remarks,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

        } else {

            // Create new attendance
            $db->table('attendance')->insert([
                'student_id'      => $studentId,
                'attendance_date' => $attendanceDate,
                'status'          => $status,
                'remarks'         => $remarks,
                'created_at'      => date('Y-m-d H:i:s')
            ]);
        }
    }

    return redirect()->to('/attendance')
        ->with('success', 'Bulk attendance saved successfully.');
}

    public function create()
    {
        $db = \Config\Database::connect();

        $students = $db->table('students')
            ->where('status', 'active')
            ->orderBy('first_name', 'ASC')
            ->get()
            ->getResult();

        return view('attendance/create', [
            'students' => $students
        ]);
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $db->table('attendance')->insert([
            'student_id'      => $this->request->getPost('student_id'),
            'attendance_date' => $this->request->getPost('attendance_date'),
            'status'          => $this->request->getPost('status'),
            'remarks'         => $this->request->getPost('remarks'),
        ]);

return redirect()->to('/attendance')
    ->with('success', 'Attendance marked successfully.');    }

    public function view($id)
    {
        $db = \Config\Database::connect();

        $attendance = $db->table('attendance')
            ->select('attendance.*, students.first_name, students.last_name, students.admission_no')
            ->join('students', 'students.id = attendance.student_id', 'left')
            ->where('attendance.id', $id)
            ->get()
            ->getRow();

        if (!$attendance) {
            return redirect()->to('/attendance');
        }

        return view('attendance/view', [
            'attendance' => $attendance
        ]);
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        $attendance = $db->table('attendance')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$attendance) {
            return redirect()->to('/attendance');
        }

        $students = $db->table('students')
            ->where('status', 'active')
            ->orderBy('first_name', 'ASC')
            ->get()
            ->getResult();

        return view('attendance/edit', [
            'attendance' => $attendance,
            'students'   => $students
        ]);
    }

    public function update($id)
{
    $db = \Config\Database::connect();

    $db->table('attendance')
        ->where('id', $id)
        ->update([
            'student_id'      => $this->request->getPost('student_id'),
            'attendance_date' => $this->request->getPost('attendance_date'),
            'status'          => $this->request->getPost('status'),
            'remarks'         => $this->request->getPost('remarks'),
        ]);

return redirect()->to('/attendance')
    ->with('success', 'Attendance updated successfully.');
}

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('attendance')
            ->where('id', $id)
            ->delete();

        return redirect()->to('/attendance');
    }
}