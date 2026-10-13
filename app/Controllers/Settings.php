<?php

namespace App\Controllers;

class Settings extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $settings = $db->table('school_settings')
            ->orderBy('id', 'DESC')
            ->get()
            ->getRow();

        return view('settings/index', [
            'settings' => $settings
        ]);
    }

    public function save()
    {
        $db = \Config\Database::connect();

        $data = [
            'school_name'   => trim($this->request->getPost('school_name')),
            'school_code'   => trim($this->request->getPost('school_code')),
            'logo'          => trim($this->request->getPost('logo')),
            'email'         => trim($this->request->getPost('email')),
            'phone'         => trim($this->request->getPost('phone')),
            'address'       => $this->request->getPost('address'),
            'website'       => trim($this->request->getPost('website')),
            'academic_year' => trim($this->request->getPost('academic_year')),
            'currency'      => trim($this->request->getPost('currency')) ?: 'PKR',
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        $existing = $db->table('school_settings')
            ->orderBy('id', 'DESC')
            ->get()
            ->getRow();

        if ($existing) {
            $db->table('school_settings')
                ->where('id', $existing->id)
                ->update($data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');

            $db->table('school_settings')->insert($data);
        }

        return redirect()->to('/settings');
    }
}