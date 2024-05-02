<?php

namespace src\controllers;

use src\models\User;

class UserController
{
    private function validate(...$params): array
    {
        foreach ($params as &$param) {
            $param = htmlspecialchars($param);
        }
        return $params;

    }
    public function create() {
        $user = new User(...$this->validate($_POST["first_name"], $_POST["last_name"],$_POST["user_role"]));
        $id = $user->create();
        include "src/views/user/edit_user.php";
    }
    public function store() {
        $user = new User(...$this->validate($_POST["id"],$_POST["firstname"], $_POST["lastname"],$_POST["user_role"]));
        $user->update();
    }
    public function show($id) {
        $user = User::get($id);
        include "src/views/user/edit_user.php";
    }
    public function delete($id) {
        User::delete($id);
    }

}