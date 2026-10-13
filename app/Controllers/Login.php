<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $db = \Config\Database::connect();

        $user = $db->table('users')
            ->where('email', $email)
            ->where('status', 'active')
            ->get()
            ->getRow();

        if ($user && password_verify($password, $user->password)) {
            $session->set([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role,
                'isLoggedIn' => true,
            ]);

            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}