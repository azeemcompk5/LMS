<?php

namespace App\Controllers;

class Sections extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $sections = $db->table('sections')
            ->select('sections.*, classes.name as class_name')
            ->join('classes', 'classes.id = sections.class_id', 'left')
            ->orderBy('sections.id', 'ASC')
            ->get()
            ->getResult();

        return view('sections/index', [
            'sections' => $sections
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

        return view('sections/create', [
            'classes' => $classes
        ]);
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $db->table('sections')->insert([
            'class_id' => $this->request->getPost('class_id'),
            'name'     => trim($this->request->getPost('name')),
            'capacity' => $this->request->getPost('capacity'),
            'status'   => $this->request->getPost('status'),
        ]);

        return redirect()->to('/sections');
    }

    public function view($id)
    {
        $db = \Config\Database::connect();

        $section = $db->table('sections')
            ->select('sections.*, classes.name as class_name')
            ->join('classes', 'classes.id = sections.class_id', 'left')
            ->where('sections.id', $id)
            ->get()
            ->getRow();

        if (!$section) {
            return redirect()->to('/sections');
        }

        return view('sections/view', [
            'section' => $section
        ]);
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        $section = $db->table('sections')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$section) {
            return redirect()->to('/sections');
        }

        $classes = $db->table('classes')
            ->where('status', 'active')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResult();

        return view('sections/edit', [
            'section' => $section,
            'classes' => $classes
        ]);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $db->table('sections')
            ->where('id', $id)
            ->update([
                'class_id' => $this->request->getPost('class_id'),
                'name'     => trim($this->request->getPost('name')),
                'capacity' => $this->request->getPost('capacity'),
                'status'   => $this->request->getPost('status'),
            ]);

        return redirect()->to('/sections');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('sections')
            ->where('id', $id)
            ->delete();

        return redirect()->to('/sections');
    }
}