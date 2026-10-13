<?php

namespace App\Controllers;

class Reports extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $data = [
            'totalStudents' => $db->table('students')->countAllResults(),

            'totalTeachers' => $db->table('teachers')->countAllResults(),

            'totalClasses' => $db->table('classes')->countAllResults(),

            'totalSubjects' => $db->table('subjects')->countAllResults(),

            'totalAttendance' => $db->table('attendance')->countAllResults(),

            'totalFees' => $db->table('fees')->countAllResults(),

            'totalExams' => $db->table('exams')->countAllResults(),

            'totalResults' => $db->table('results')->countAllResults(),

            'totalNotices' => $db->table('notices')->countAllResults(),
        ];

        return view('reports/index', $data);
    }
}