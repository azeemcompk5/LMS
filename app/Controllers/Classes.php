<?php

namespace App\Controllers;

class Classes extends BaseController
{
    public function index()
{
    $db = \Config\Database::connect();

    $classes = $db->table('classes')
        ->orderBy('id', 'ASC')
        ->get()
        ->getResult();

    // Class summary
    $totalClasses = count($classes);

    $activeClasses = 0;
    $inactiveClasses = 0;

    foreach ($classes as $class) {

        if ($class->status === 'active') {
            $activeClasses++;
        } else {
            $inactiveClasses++;
        }
    }

    return view('classes/index', [
        'classes'        => $classes,
        'totalClasses'   => $totalClasses,
        'activeClasses'  => $activeClasses,
        'inactiveClasses'=> $inactiveClasses,
    ]);
}
    public function create()
    {
        return view('classes/create');
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $db->table('classes')->insert([
            'name'        => trim($this->request->getPost('name')),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ]);

        return redirect()->to('/classes');
    }

    public function view($id)
{
    $db = \Config\Database::connect();

    // Get class
    $class = $db->table('classes')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$class) {
        return redirect()->to('/classes');
    }

    // Count students
    $studentCount = $db->table('students')
        ->where('class_id', $id)
        ->countAllResults();

    // Get students
    $students = $db->table('students')
        ->where('class_id', $id)
        ->orderBy('first_name', 'ASC')
        ->get()
        ->getResult();

    // Count subjects
    $subjectCount = $db->table('class_subjects')
        ->where('class_id', $id)
        ->countAllResults();

    return view('classes/view', [
        'class'        => $class,
        'studentCount' => $studentCount,
        'students'     => $students,
        'subjectCount' => $subjectCount
    ]);
}

    public function edit($id)
    {
        $db = \Config\Database::connect();

        $class = $db->table('classes')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$class) {
            return redirect()->to('/classes');
        }

        return view('classes/edit', [
            'class' => $class
        ]);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $db->table('classes')
            ->where('id', $id)
            ->update([
                'name'        => trim($this->request->getPost('name')),
                'description' => $this->request->getPost('description'),
                'status'      => $this->request->getPost('status'),
            ]);

        return redirect()->to('/classes');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('classes')
            ->where('id', $id)
            ->delete();

        return redirect()->to('/classes');
    }
}