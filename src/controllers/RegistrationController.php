<?php

namespace src\controllers;

use src\Helper;
use src\models\Attribute;
use src\models\Event;
use src\models\Event_Attributes;
use src\models\Registration;
use src\models\User;

class RegistrationController
{

    public function create()
    {
        if (empty($_POST["event_id"])) {
            echo "id fehlt";
            return;
        }
        if (empty($_POST["first_name"])) {
            echo "name fehlt";
            return;
        }
        if (empty($_POST["last_name"])) {
            echo "datum fehlt";
            return;
        }
        $registration = new Registration(...Helper::html_validate($_POST["first_name"],$_POST["last_name"],$_POST["event_id"]));
        $registration->create();
    }

    public function update()
    {
    }

    public function show()
    {

    }

    public function index()
    {
        $events = Event::getAll();
        include "src/views/registration/create_registration.php";
    }

    public function showAttributes($event_id)
    {
        $events = Event::getAll();
        $event_attributes = Event_Attributes::getEventAttributes($event_id);
        foreach ($event_attributes as &$event_attribute) {
            $event_attribute = new Attribute($event_attribute["name"], $event_attribute["type"], $event_attribute["mru_counter"], $event_attribute["id"]);
        }
        unset($event_attribute);
        include "src/views/registration/create_registration.php";
    }

    public function delete()
    {

    }
}