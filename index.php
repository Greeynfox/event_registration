<?php
session_start();
require "vendor/autoload.php";
require "config/web.php";
require "config/constants.php";

use src\controllers\EventController;
use src\controllers\LoginController;
use src\controllers\RegistrationController;
use src\controllers\UserController;

$_SESSION["user_id"] = 3;
$requestUri = $_SERVER['REQUEST_URI'];


$action = "";
$controller = "";

if (!empty($_GET["action"]) && !empty($_GET["controller"])) {
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
        switch ($action) {
            case "create":
                $controller->create();
                break;
            case "edit":
                if (isset($_POST["delete_registration"])) { // possible value from edit
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
        break;
    case "event":
        $controller = new EventController();
        switch ($action) {
            case "create":
                $controller->create();
                break;
            case "edit":
                if (isset($_POST["delete_event"])) { // possible value from edit
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
        break;
    case "user":
        $controller = new UserController();
        switch ($action) {
            case "create":
                $controller->create();
                break;
            case "edit":
                $controller->update();
                break;
            case "show":
                $controller->show($_GET["id"]);
                break;
            case "showAll":
                $controller->showAll();
                break;
        }
        break;
    default:
        $controller = new RegistrationController();
        if (isset($_GET["selected_event"])) {
            $controller->showAttributes($_GET["selected_event"]);
        }
        else {
            $controller->index();
        }
}

