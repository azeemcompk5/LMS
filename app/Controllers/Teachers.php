<?php

namespace App\Controllers;

class Teachers extends BaseController
{
    public function index()
{
    $db = \Config\Database::connect();

    $teachers = $db->table('teachers')
        ->orderBy('id', 'ASC')
        ->get()
        ->getResult();

    $totalTeachers = count($teachers);

    $activeTeachers = 0;
    $inactiveTeachers = 0;

    foreach ($teachers as $teacher) {
        if ($teacher->status === 'active') {
            $activeTeachers++;
        } else {
            $inactiveTeachers++;
        }
    }

    return view('teachers/index', [
        'teachers'        => $teachers,
        'totalTeachers'   => $totalTeachers,
        'activeTeachers'  => $activeTeachers,
        'inactiveTeachers'=> $inactiveTeachers,
    ]);
}

    public function create()
    {
        return view('teachers/create');
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $photo = $this->request->getFile('photo');

$photoName = null;

if ($photo && $photo->isValid() && !$photo->hasMoved()) {

    $uploadPath = FCPATH . 'uploads/teachers';

    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0775, true);
    }

    $photoName = $photo->getRandomName();

    $photo->move($uploadPath, $photoName);
}

        $db->table('teachers')->insert([
            'employee_id'  => trim($this->request->getPost('employee_id')),
            'first_name'   => trim($this->request->getPost('first_name')),
            'last_name'    => trim($this->request->getPost('last_name')),
            'father_name' => trim($this->request->getPost('father_name')),
            'designation'  => $this->request->getPost('designation'),
            'phone'        => $this->request->getPost('phone'),
            'email'        => $this->request->getPost('email'),
            'joining_date' => $this->request->getPost('joining_date'),
            'address'      => $this->request->getPost('address'),
            'status'       => $this->request->getPost('status'),
        ]);

        return redirect()->to('/teachers');
    }

    public function view($id)
    {
        $db = \Config\Database::connect();

        $teacher = $db->table('teachers')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$teacher) {
            return redirect()->to('/teachers');
        }

        return view('teachers/view', [
            'teacher' => $teacher
        ]);
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        $teacher = $db->table('teachers')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$teacher) {
            return redirect()->to('/teachers');
        }

        return view('teachers/edit', [
            'teacher' => $teacher
        ]);
    }

    public function update($id)
{
    $db = \Config\Database::connect();

    // Get current teacher
    $teacher = $db->table('teachers')
        ->where('id', $id)
        ->get()
        ->getRow();

    // Current photo
    $photoName = $teacher->photo ?? null;

    // New photo
    $photo = $this->request->getFile('photo');

    if ($photo && $photo->isValid() && !$photo->hasMoved()) {

        $uploadPath = FCPATH . 'uploads/teachers';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }

        $photoName = $photo->getRandomName();

        $photo->move($uploadPath, $photoName);

        // Delete old photo
        if (!empty($teacher->photo)) {

            $oldPhoto = $uploadPath . '/' . $teacher->photo;

            if (is_file($oldPhoto)) {
                unlink($oldPhoto);
            }
        }
    }

    $db->table('teachers')
        ->where('id', $id)
        ->update([
            'employee_id'  => trim($this->request->getPost('employee_id')),
            'first_name'   => trim($this->request->getPost('first_name')),
            'last_name'    => trim($this->request->getPost('last_name')),
            'father_name'  => trim($this->request->getPost('father_name')),
            'designation'  => $this->request->getPost('designation'),
            'phone'        => $this->request->getPost('phone'),
            'email'        => $this->request->getPost('email'),
            'joining_date' => $this->request->getPost('joining_date'),
            'address'      => $this->request->getPost('address'),
            'status'       => $this->request->getPost('status'),
            'photo'        => $photoName,
        ]);

    return redirect()->to('/teachers');
}
    public function delete($id)
{
    $db = \Config\Database::connect();

    // Get teacher before deleting
    $teacher = $db->table('teachers')
        ->where('id', $id)
        ->get()
        ->getRow();

    // Delete teacher photo
    if ($teacher && !empty($teacher->photo)) {

        $photoPath = FCPATH . 'uploads/teachers/' . $teacher->photo;

        if (is_file($photoPath)) {
            unlink($photoPath);
        }
    }

    // Delete teacher record
    $db->table('teachers')
        ->where('id', $id)
        ->delete();

    return redirect()->to('/teachers');
}
}