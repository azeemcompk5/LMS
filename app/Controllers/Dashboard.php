<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $db = \Config\Database::connect();

        $data = [
            'totalStudents' => $db->table('students')->countAllResults(),
            'totalTeachers' => $db->table('teachers')->countAllResults(),
            'totalClasses'  => $db->table('classes')->countAllResults(),
            'pendingFees'   => $db->table('fees')
                ->where('status', 'pending')
                ->selectSum('amount')
                ->get()
                ->getRow()
                ->amount ?? 0,
        ];

        return view('dashboard', $data);
    }
}