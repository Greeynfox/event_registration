<?php

namespace src\controllers;

use src\Helper;
use src\models\User;

/**
 * This class uses following $_POST - parameters: username, password, user_role, id
 */
class UserController
{

    public function create() {
        $user = new User(...Helper::validate($_POST["username"],$_POST["password"],$_POST["user_role"]));
        $id = $user->create();
        $user = User::get($id); // get() call to ensure all data of the user is available in the edit-view
        include "src/views/user/edit_user.php";
    }
    public function update() {
        $user = new User(...Helper::validate($_POST["firstname"],$_POST["lastname"],$_POST["user_role"],$_POST["id"]));
        $user->update();
    }
    public function show($id) {
        $user = User::get($id);
        include "src/views/user/edit_user.php";
    }
    public function showAll() {
        $users = User::getAll();
        include "src/views/user/view_users.php";
    }
    public function delete($id) {
        User::delete($id);
        $users = User::getAll();
        include "src/views/user/view_users.php";
    }

}