<?php
namespace App\Controllers;

use App\Models\UsersModel;

class navbarController extends BaseController
{
    public function getProfile()
    {
        $userId = session()->get('id_user');
        $usersModel = new UsersModel();
        $user = $usersModel->find($userId);

        return view('user_profile', ['user' => $user]);
    }
}
