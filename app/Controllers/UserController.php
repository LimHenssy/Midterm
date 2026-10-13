<?php
namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('users/index', $data);
    }

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        $rules = [
            'username'  => 'required|is_unique[users.username]',
            'full_name' => 'required',
            'password'  => 'required|min_length[6]',
            'avatar'    => 'is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $avatar = $this->request->getFile('avatar');
        $avatarName = null;

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $avatarName = $avatar->getRandomName();
            $avatar->move(FCPATH . 'uploads/avatars', $avatarName);
        }

        $model = new UserModel();
        $model->save([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'avatar'     => $avatarName,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/users')->with('success', 'Staff member added!');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('users/edit', $data);
    }

    public function update($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        $rules = [
            'username'  => "required|is_unique[users.username,id,{$id}]",
            'full_name' => 'required',
            'avatar'    => 'is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $avatar = $this->request->getFile('avatar');
        $avatarName = $user['avatar'];

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $avatarName = $avatar->getRandomName();
            $avatar->move(FCPATH . 'uploads/avatars', $avatarName);
        }

        $updateData = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'avatar'    => $avatarName
        ];

        if ($this->request->getPost('password')) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }

        $model->update($id, $updateData);

        return redirect()->to('/users')->with('success', 'Staff details updated!');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/users')->with('success', 'Staff removed!');
    }
}