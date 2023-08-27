<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{

    public function edit_form()
    {
        if (session('user') == Null) {
            return redirect('login');

        }
        return view('edit', [
            'currentRoute' => 'edit',
            'successes' => ''

        ]);
    }

    public function edit()
    {
        $userData = $this->request->getPost(['first_name', 'last_name', 'password1']);
        $image = $this->request->getFile('image');
        $rules = [
            'first_name' => 'required|min_length[3]|max_length[100]',
            'last_name' => 'required|min_length[3]|max_length[100]',


        ];

        if ($this->validate($rules)) {

            $userModel = model('App\Models\User');
            $id = session()->get('user')['id'];
            $currentUser = $userModel->find($id);

            $currentUser['first_name'] = $userData['first_name'];

            $currentUser['last_name'] = $userData['last_name'];


            if (isset($image)) {
                if ($this->validate(['image' => 'uploaded[image]|max_size[image,10000]|mime_in[image,image/jpeg,image/png]'
                ])) {
                    $newName = $image->getRandomName();

                    $image->move('uploads/', $newName);

                    $imagePath = 'uploads/' . $newName;

                    $currentUser['image'] = $imagePath;
                }


            }
            session()->set('user', $currentUser);
            $userModel->save($currentUser);

            return view('edit', [
                'currentRoute' => 'edit',
                'successes' => 'successful edition'
            ]);
        }

        return view('edit', [
            'errors' => $this->validator->listErrors(),
            'successes' => '',
            'currentRoute' => 'edit'
        ]);
    }

    public function profile()
    {
        if (session('user') == Null) {
            return redirect('login');

        }
        return view('profile', [
            'currentRoute' => 'profile',
            'user' => session('user')
        ]);
    }

    public function changePass()
    {
        $userData = $this->request->getPost(['password', 'confirmed_password']);
        $rules = [
            'password' => 'required|min_length[8]|max_length[30]',
            'confirmed_password' => 'required|matches[password]',
        ];
        $userModel = model('App\Models\User');
        if ($this->validate($rules)) {
            $id = session()->get('user')['id'];
            $currentUser = $userModel->find($id);
            $currentUser['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
            $userModel->save($currentUser);
            session()->set('user', $currentUser);

            return view('edit',
                [
                    'successes' => 'The password is updated ',
                    'currentRoute' => 'edit'

                ]

            );
        }
        return view('edit', [
            'errors' => $this->validator->listErrors(),
            'successes' => '',
            'currentRoute' => 'edit'
        ]);
    }
}
