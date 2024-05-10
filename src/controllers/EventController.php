<?php

namespace src\controllers;

use src\Helper;
use src\models\Attribute;
use src\models\Event;
use src\models\Event_Attributes;

/**
 * This class uses following $_POST - parameters: id, name, date, start_time, end_time, attributes[], and attribute_types[]
 */
class EventController
{
    public function create()
    {
        if (empty($_POST["name"])) {
            echo "name fehlt";
            return;
        }
        if (empty($_POST["date"])) {
            echo "datum fehlt";
            return;
        }
        if ((!empty($_POST["start_time"]) && empty($_POST["end_time"])) || (empty($_POST["start_time"]) && !empty($_POST["end_time"]))) {
            echo "start- oder endzeit fehlt";
            return;
        }
        if (!empty($_POST["attributes"])) {
            foreach ($_POST["attributes"] as $name) {
                if (empty($name)) {
                    echo "attributsname fehlt";
                    return;
                }
            }
        }

        $event = new Event(...Helper::html_validate($_POST["name"], $_SESSION["user_id"], $_POST["date"], $_POST["start_time"], $_POST["end_time"]));
        $id = $event->create();
        $event->setId($id);

        $attributes = [];
        for ($i = 0; $i < count($_POST["attributes"]); $i++) {
            $attributes[] = ["name" => $_POST["attributes"][$i], "type" => $_POST["attribute_types"][$i]];
        }
        foreach ($attributes as $att) {

            $attribute = Attribute::getByName($att["name"]);
            $a_id = 0;
            if ($attribute === null) {
                $attribute = new Attribute(...Helper::html_validate($att["name"], $att["type"]));
                $a_id = $attribute->create();
            } else {
                $attribute = new Attribute(...Helper::html_validate($attribute["name"], $attribute["type"], $attribute["mru_counter"], $attribute["id"]));
                $a_id = $attribute->getId();
            }
            $event_attributes = new Event_Attributes($id, $a_id);
            $event_attributes->create();

        }
        include "src/views/event/view_events.php";
    }

    public function update()
    {
        if (empty($_POST["event_id"])) {
            echo "id fehlt";
            return;
        }
        if (empty($_POST["name"])) {
            echo "name fehlt";
            return;
        }
        if (empty($_POST["date"])) {
            echo "datum fehlt";
            return;
        }
        if ((!empty($_POST["start_time"]) && empty($_POST["end_time"])) || (empty($_POST["start_time"]) && !empty($_POST["end_time"]))) {
            echo "start- oder endzeit fehlt";
            return;
        }
        if (!empty($_POST["attributes"])) {
            foreach ($_POST["attributes"] as $name) {
                if (empty($name)) {
                    echo "attributsname fehlt";
                    return;
                }
            }
        }

        $event = new Event(...Helper::html_validate($_POST["name"], $_SESSION["user_id"], $_POST["date"], $_POST["start_time"], $_POST["end_time"], $_POST["event_id"]));
        $event->update();

        $event_attributes = Event_Attributes::getEventAttributes($_POST["event_id"]);
        foreach ($event_attributes as &$event_attribute) {
            $event_attribute = new Attribute($event_attribute["name"], $event_attribute["type"], $event_attribute["mru_counter"], $event_attribute["id"]);
        }
        unset($event_attribute);


        // create a structure like a database record to better compare old attributes and possible new ones
        $form_attributes = [];
        for ($i = 0; $i < count($_POST["attributes"]); $i++) {
            $form_attributes[] = ["name" => $_POST["attributes"][$i], "type" => $_POST["attribute_types"][$i], "id" => $_POST["attribute_ids"][$i]];
        }
        foreach ($form_attributes as &$form_attribute) {
            $form_attribute = new Attribute($form_attribute["name"], $form_attribute["type"], 1, $form_attribute["id"]);
        }

        unset($form_attribute);

        foreach ($event_attributes as $event_attribute) {
            foreach ($form_attributes as $form_attribute) {
                if ($form_attribute == $event_attribute) {

                }
            }
        }


        // remove the deleted attributes from the Event_attributes table, only the id is needed for that
        $deleted_attribute_ids = array_diff(array_column($event_attributes, "id"), array_column($form_attributes, "id"));
        foreach ($deleted_attribute_ids as $deleted_attribute) {
            Event_Attributes::delete($_POST["event_id"], $deleted_attribute);
        }
    }

    public function show($id)
    {
        $event = Event::get($id);
        if ($event === null) {
            return;
        }
        $event_attributes = Event_Attributes::getEventAttributes($id);
        foreach ($event_attributes as &$event_attribute) {
            $event_attribute = new Attribute($event_attribute["name"], $event_attribute["type"], $event_attribute["mru_counter"], $event_attribute["id"]);
        }
        unset($event_attribute);
        $event = new Event($event["name"], $event["organiser_id"], $event["date"], $event["start_time"], $event["end_time"], $event["id"]);
        include "src/views/event/edit_event.php";
    }

    public function showAll()
    {
        $events = Event::getAll();
        include "src/views/event/view_events.php";
    }

    public function delete($id)
    {
        Event_Attributes::deleteAll($id);
        Event::delete($id);
        $events = Event::getAll();
        include "src/views/event/view_events.php";
    }
}