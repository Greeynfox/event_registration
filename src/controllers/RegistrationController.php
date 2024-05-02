<?php

namespace src\controllers;

use src\models\Registration;
use src\models\User;

class RegistrationController
{
    public function create() {

        $user = new User();
        $registration = new Registration();
    }
    public function store() {
        $user = new User();
        $registration = new Registration();
    }
    public function show() {

    }
    public function delete() {

    }
}