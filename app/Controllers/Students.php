<?php

namespace App\Controllers;

class Students extends BaseController
{
    public function index()
{
    $db = \Config\Database::connect();

    $students = $db->table('students')
        ->select('students.*, classes.name as class_name, sections.name as section_name')
        ->join('classes', 'classes.id = students.class_id', 'left')
        ->join('sections', 'sections.id = students.section_id', 'left')
        ->orderBy('students.id', 'DESC')
        ->get()
        ->getResult();

    // Student summary
    $totalStudents = count($students);

    $activeStudents = 0;
    $inactiveStudents = 0;

    foreach ($students as $student) {

        if ($student->status === 'active') {
            $activeStudents++;
        } else {
            $inactiveStudents++;
        }
    }

    return view('students/index', [
        'students'        => $students,
        'totalStudents'   => $totalStudents,
        'activeStudents'  => $activeStudents,
        'inactiveStudents'=> $inactiveStudents,
    ]);
}

    public function create()
    {
        $db = \Config\Database::connect();

        $classes = $db->table('classes')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResult();

        $sections = $db->table('sections')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResult();

        return view('students/create', [
            'classes' => $classes,
            'sections' => $sections
        ]);
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $photoName = null;
        $photo = $this->request->getFile('photo');

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $photoName = $photo->getRandomName();

            $uploadPath = FCPATH . 'uploads/students';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $photo->move($uploadPath, $photoName);
        }

        $db->table('students')->insert([
            'admission_no'   => $this->request->getPost('admission_no'),
            'b_form_no'      => $this->request->getPost('b_form_no'),
            'first_name'     => $this->request->getPost('first_name'),
            'last_name'      => $this->request->getPost('last_name'),
            'gender'         => $this->request->getPost('gender'),
            'date_of_birth'  => $this->request->getPost('date_of_birth'),
            'guardian_name'  => $this->request->getPost('guardian_name'),
            'guardian_phone' => $this->request->getPost('guardian_phone'),
            'father_cnic'    => $this->request->getPost('father_cnic'),
            'address'        => $this->request->getPost('address'),
            'class_id'       => $this->request->getPost('class_id'),
            'section_id'     => $this->request->getPost('section_id'),
            'status'         => $this->request->getPost('status'),
            'photo'          => $photoName,
        ]);

        if ($db->error()['code'] !== 0) {
    dd($db->error());
}

return redirect()->to('/students');
    }

    public function view($id)
    {
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->select('
                students.*,
                classes.name as class_name,
                sections.name as section_name
            ')
            ->join('classes', 'classes.id = students.class_id', 'left')
            ->join('sections', 'sections.id = students.section_id', 'left')
            ->where('students.id', $id)
            ->get()
            ->getRow();

        if (!$student) {
            return redirect()->to('/students');
        }

        return view('students/view', [
            'student' => $student
        ]);
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$student) {
            return redirect()->to('/students');
        }

        $classes = $db->table('classes')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResult();

        $sections = $db->table('sections')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResult();

        return view('students/edit', [
            'student'  => $student,
            'classes'  => $classes,
            'sections' => $sections
        ]);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$student) {
            return redirect()->to('/students');
        }

        $photoName = $student->photo;

        $photo = $this->request->getFile('photo');

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $photoName = $photo->getRandomName();

            $uploadPath = FCPATH . 'uploads/students';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $photo->move($uploadPath, $photoName);

            if (!empty($student->photo)) {
                $oldPhoto = $uploadPath . '/' . $student->photo;

                if (is_file($oldPhoto)) {
                    unlink($oldPhoto);
                }
            }
        }

        $db->table('students')
            ->where('id', $id)
            ->update([
                'admission_no'   => $this->request->getPost('admission_no'),
                'b_form_no'      => $this->request->getPost('b_form_no'),
                'first_name'     => $this->request->getPost('first_name'),
                'last_name'      => $this->request->getPost('last_name'),
                'gender'         => $this->request->getPost('gender'),
                'date_of_birth'  => $this->request->getPost('date_of_birth'),
                'guardian_name'  => $this->request->getPost('guardian_name'),
                'guardian_phone' => $this->request->getPost('guardian_phone'),
                'father_cnic' => $this->request->getPost('father_cnic'),
                'address'        => $this->request->getPost('address'),
                'class_id'       => $this->request->getPost('class_id'),
                'section_id'     => $this->request->getPost('section_id'),
                'status'         => $this->request->getPost('status'),
                'photo'          => $photoName,
            ]);

        return redirect()->to('/students');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->where('id', $id)
            ->get()
            ->getRow();

        if ($student && !empty($student->photo)) {
            $photoPath = FCPATH . 'uploads/students/' . $student->photo;

            if (is_file($photoPath)) {
                unlink($photoPath);
            }
        }

        $db->table('students')
            ->where('id', $id)
            ->delete();

        return redirect()->to('/students');
    }
}