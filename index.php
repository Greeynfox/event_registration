<?php
require "vendor/autoload.php";
require "config/web.php";

use src\controllers\EventController;
use src\controllers\LoginController;
use src\controllers\RegistrationController;
use src\controllers\UserController;


$requestUri = $_SERVER['REQUEST_URI'];
echo $requestUri;

$action = "";
$controller = "";

if (!empty($_GET)) {
    $action = $_GET['action'];
    $controller = $_GET['controller'];
}
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
        switch ($action) {
            case "create":
                print_r($_POST);
                $controller->create();
                break;
        }
        break;
}