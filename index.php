<?php
session_start();
require "vendor/autoload.php";
require "config/web.php";
use src\controllers\EventController;
use src\controllers\LoginController;
use src\controllers\RegistrationController;
use src\controllers\UserController;

$_SESSION["user_id"] = 3;
$requestUri = $_SERVER['REQUEST_URI'];


$action = "";
$controller = "";

if (!empty($_GET)) {
    $action = $_GET['action'];
    $controller = $_GET['controller'];
}

// routes are determined by url-params(GET), the form data(POST) is processed inside the controllers

switch ($controller) {
    case "login":
        $controller = new LoginController();
        break;
    case "registration":
        $controller = new RegistrationController();
        break;
    case "event":
        $controller = new EventController();
        break;
    case "user":
        $controller = new UserController();
        break;
}
switch ($action) {
    case "create":
        $controller->create();
        break;
    case "edit":
        if (isset($_POST["delete_event"])) {
            $controller->delete($_GET["id"]);
        }
        $controller->update();
        break;
    case "show":
        $controller->show($_GET["id"]);
        break;
    case "showAll":
        $controller->showAll();
        break;
}
//include "src/views/event/edit_event.php";