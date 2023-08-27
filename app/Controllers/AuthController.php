<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use PharIo\Manifest\Author;

class AuthController extends BaseController
{

    public function __construct()
    {
        helper('session');
    }

    public function login_form()
    {
        if (session('user') != Null) {
            return redirect('profile');

        }
        return view('login', [
            'currentRoute' => 'login'
        ]);
    }

    public function login()
    {
        $userData = $this->request->getPost(['email', 'password']);

        $userModel = model('App\Models\User');
        $rules =
            [
                'email' => 'required|valid_email',
                'password' => 'required'
            ];
        if (!$this->validate($rules)) {
            return view('login', [
                'errors' => $this->validator->listErrors(),
                'currentRoute' => 'login'

            ]);
        }
        $user = $userModel->where('email', $userData['email'])->first();
        //var_dump($user['password']);die();
        if ($user && password_verify($userData['password'], $user['password'])) {

            session()->set('user', $user);
            return redirect('dashboard');

        } else
            return view('login', [
                'errors' => 'The credential are wrong',
                'currentRoute' => 'login'
            ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect('login');

    }


}
