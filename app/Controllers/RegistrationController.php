<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RegistrationController extends BaseController
{
    public function index()
    {
        if (session('user') != Null) {
            return redirect('profile');
        }
        return view('register', [
            'currentRoute' => 'register'
        ]);
    }

    public function register()
    {

        $userData = $this->request->getPost(['first_name', 'last_name', 'email', 'password1']);
        $rules = [
            'first_name' => 'required|min_length[3]|max_length[100]',
            'last_name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password1' => 'required|min_length[8]|max_length[30]',
            'password2' => 'required|matches[password1]',
            'image' => 'uploaded[image]|max_size[image,10000]|mime_in[image,image/jpeg,image/png]'

        ];
        if ($this->validate($rules)) {

            $image = $this->request->getFile('image');
            $newName = $image->getRandomName();
            $image->move('uploads', $newName);
            $imagePath = 'uploads/' . $newName;

            $userModel = model('App\Models\User');
            $userData['password1'] = password_hash($userData['password1'], PASSWORD_DEFAULT);
            $userModel->save([
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'password' => $userData['password1'],
                'email' => $userData['email'],
                'image' => $imagePath

            ]);
            return view('login', [
                'currentRoute' => 'login'
            ]);
        }

        return view('register', [
            'errors' => $this->validator->listErrors(),
            'currentRoute' => 'register'
        ]);


    }
}
