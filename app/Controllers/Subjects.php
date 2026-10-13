<?php

namespace App\Controllers;

class Subjects extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $subjects = $db->table('subjects')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResult();

        return view('subjects/index', [
            'subjects' => $subjects
        ]);
    }

    public function create()
    {
        return view('subjects/create');
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $db->table('subjects')->insert([
            'name'        => trim($this->request->getPost('name')),
            'code'        => trim($this->request->getPost('code')),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ]);

        return redirect()->to('/subjects');
    }

    public function view($id)
    {
        $db = \Config\Database::connect();

        $subject = $db->table('subjects')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$subject) {
            return redirect()->to('/subjects');
        }

        return view('subjects/view', [
            'subject' => $subject
        ]);
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        $subject = $db->table('subjects')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$subject) {
            return redirect()->to('/subjects');
        }

        return view('subjects/edit', [
            'subject' => $subject
        ]);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $db->table('subjects')
            ->where('id', $id)
            ->update([
                'name'        => trim($this->request->getPost('name')),
                'code'        => trim($this->request->getPost('code')),
                'description' => $this->request->getPost('description'),
                'status'      => $this->request->getPost('status'),
            ]);

        return redirect()->to('/subjects');
    }

    public function delete($id)
{
    $db = \Config\Database::connect();

    // Get student before deleting
    $student = $db->table('students')
        ->where('id', $id)
        ->get()
        ->getRow();

    // Delete student photo
    if ($student && !empty($student->photo)) {

        $photoPath = FCPATH . 'uploads/students/' . $student->photo;

        if (is_file($photoPath)) {
            unlink($photoPath);
        }
    }

    // Delete student record
    $db->table('students')
        ->where('id', $id)
        ->delete();

    return redirect()->to('/students');
}
}