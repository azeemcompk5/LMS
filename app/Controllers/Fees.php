<?php

namespace App\Controllers;

class Fees extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $fees = $db->table('fees')
            ->select('fees.*, students.first_name, students.last_name, students.admission_no')
            ->join('students', 'students.id = fees.student_id', 'left')
            ->orderBy('fees.id', 'DESC')
            ->get()
            ->getResult();

        $totalFeesRow = $db->table('fees')
            ->selectSum('amount')
            ->get()
            ->getRow();

        $totalCollectedRow = $db->table('fees')
            ->selectSum('paid_amount')
            ->get()
            ->getRow();

        $totalFees = (float) ($totalFeesRow->amount ?? 0);
        $totalCollected = (float) ($totalCollectedRow->paid_amount ?? 0);
        $totalOutstanding = max(0, $totalFees - $totalCollected);
        $totalRecords = $db->table('fees')->countAllResults();

        return view('fees/index', [
            'fees' => $fees,
            'totalFees' => $totalFees,
            'totalCollected' => $totalCollected,
            'totalOutstanding' => $totalOutstanding,
            'totalRecords' => $totalRecords
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

        return view('fees/create', [
            'students' => $students
        ]);
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $db->table('fees')->insert([
            'student_id'     => $this->request->getPost('student_id'),
            'fee_type'       => $this->request->getPost('fee_type'),
            'amount'         => $this->request->getPost('amount'),
            'paid_amount'    => $this->request->getPost('paid_amount') ?: 0,
            'due_date'       => $this->request->getPost('due_date'),
            'payment_date'   => $this->request->getPost('payment_date') ?: null,
            'payment_method' => $this->request->getPost('payment_method') ?: null,
            'remarks'        => $this->request->getPost('remarks') ?: null,
        ]);

        return redirect()->to('/fees');
    }

    public function view($id)
    {
        $db = \Config\Database::connect();

        $fee = $db->table('fees')
            ->select('fees.*, students.first_name, students.last_name, students.admission_no')
            ->join('students', 'students.id = fees.student_id', 'left')
            ->where('fees.id', $id)
            ->get()
            ->getRow();

        if (!$fee) {
            return redirect()->to('/fees');
        }

        return view('fees/view', [
            'fee' => $fee
        ]);
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        $fee = $db->table('fees')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$fee) {
            return redirect()->to('/fees');
        }

        $students = $db->table('students')
            ->where('status', 'active')
            ->orderBy('first_name', 'ASC')
            ->get()
            ->getResult();

        return view('fees/edit', [
            'fee' => $fee,
            'students' => $students
        ]);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $db->table('fees')
            ->where('id', $id)
            ->update([
                'student_id'     => $this->request->getPost('student_id'),
                'fee_type'       => $this->request->getPost('fee_type'),
                'amount'         => $this->request->getPost('amount'),
                'paid_amount'    => $this->request->getPost('paid_amount') ?: 0,
                'due_date'       => $this->request->getPost('due_date'),
                'payment_date'   => $this->request->getPost('payment_date') ?: null,
                'payment_method' => $this->request->getPost('payment_method') ?: null,
                'remarks'        => $this->request->getPost('remarks') ?: null,
            ]);

        return redirect()->to('/fees');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('fees')
            ->where('id', $id)
            ->delete();

        return redirect()->to('/fees');
    }

    public function receipt($id)
    {
        $db = \Config\Database::connect();

        $fee = $db->table('fees')
            ->select('fees.*, students.first_name, students.last_name, students.admission_no')
            ->join('students', 'students.id = fees.student_id', 'left')
            ->where('fees.id', $id)
            ->get()
            ->getRow();

        if (!$fee) {
            return redirect()->to('/fees');
        }

        return view('fees/receipt', [
            'fee' => $fee
        ]);
    }

    public function history($studentId)
    {
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->where('id', $studentId)
            ->get()
            ->getRow();

        if (!$student) {
            return redirect()->to('/fees');
        }

        $fees = $db->table('fees')
            ->where('student_id', $studentId)
            ->orderBy('id', 'DESC')
            ->get()
            ->getResult();

        $totalFeesRow = $db->table('fees')
            ->selectSum('amount')
            ->where('student_id', $studentId)
            ->get()
            ->getRow();

        $totalPaidRow = $db->table('fees')
            ->selectSum('paid_amount')
            ->where('student_id', $studentId)
            ->get()
            ->getRow();

        $totalFees = (float) ($totalFeesRow->amount ?? 0);
        $totalPaid = (float) ($totalPaidRow->paid_amount ?? 0);
        $totalOutstanding = max(0, $totalFees - $totalPaid);

        return view('fees/history', [
            'student' => $student,
            'fees' => $fees,
            'totalFees' => $totalFees,
            'totalPaid' => $totalPaid,
            'totalOutstanding' => $totalOutstanding
        ]);
    }
}