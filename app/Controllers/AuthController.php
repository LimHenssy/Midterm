<?php
namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $session = session();
        $model = new UserModel();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        // Checks hashed password OR direct plain text match
        if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
            $session->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'full_name' => $user['full_name'],
                'avatar'    => $user['avatar'],
                'isLoggedIn'=> true,
            ]);
            return redirect()->to('/products')->with('success', 'Welcome back, Trainer ' . $user['full_name'] . '!');
        }

        return redirect()->back()->with('error', 'Invalid username or password.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}