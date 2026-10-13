<?php

namespace App\Controllers;

class Notices extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $notices = $db->table('notices')
            ->orderBy('publish_date', 'DESC')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResult();

        return view('notices/index', [
            'notices' => $notices
        ]);
    }

    public function create()
    {
        return view('notices/create');
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $db->table('notices')->insert([
            'title'           => trim($this->request->getPost('title')),
            'message'         => $this->request->getPost('message'),
            'target_audience' => $this->request->getPost('target_audience'),
            'publish_date'    => $this->request->getPost('publish_date'),
            'expiry_date'     => $this->request->getPost('expiry_date') ?: null,
            'status'          => $this->request->getPost('status') ?: 'active',
            'created_by'      => session()->get('user_id'),
            'created_at'      => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/notices');
    }

    public function view($id)
    {
        $db = \Config\Database::connect();

        $notice = $db->table('notices')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$notice) {
            return redirect()->to('/notices');
        }

        return view('notices/view', [
            'notice' => $notice
        ]);
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        $notice = $db->table('notices')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$notice) {
            return redirect()->to('/notices');
        }

        return view('notices/edit', [
            'notice' => $notice
        ]);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $db->table('notices')
            ->where('id', $id)
            ->update([
                'title'           => trim($this->request->getPost('title')),
                'message'         => $this->request->getPost('message'),
                'target_audience' => $this->request->getPost('target_audience'),
                'publish_date'    => $this->request->getPost('publish_date'),
                'expiry_date'     => $this->request->getPost('expiry_date') ?: null,
                'status'          => $this->request->getPost('status') ?: 'active',
            ]);

        return redirect()->to('/notices');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('notices')
            ->where('id', $id)
            ->delete();

        return redirect()->to('/notices');
    }
}