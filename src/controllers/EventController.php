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
    public function create() {
        if(empty($_POST["name"])) {
            echo "name fehlt";
            return;
        }
        if(empty($_POST["date"])) {
            echo "datum fehlt";
            return;
        }
        if( (!empty($_POST["start_time"]) && empty($_POST["end_time"])) || (empty($_POST["start_time"]) && !empty($_POST["end_time"]) )) {
            echo "start- oder endzeit fehlt";
            return;
        }
        if(!empty($_POST["attributes"])) {
            foreach ($_POST["attributes"] as $name) {
                if (empty($name)) {
                    echo "attributsname fehlt";
                    return;
                }
            }
        }

        $event = new Event(...Helper::validate($_POST["name"],$_SESSION["user_id"],$_POST["date"],$_POST["start_time"],$_POST["end_time"]));

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
                $attribute = new Attribute(...Helper::validate($att["name"],$att["type"]));
                $a_id = $attribute->create();
            }
            else {
                $attribute = new Attribute(...Helper::validate($attribute["name"],$attribute["type"],$attribute["mru_counter"],$attribute["id"]));
                $a_id = $attribute->getId();
            }
            $event_attributes = new Event_Attributes($id,$a_id);
            $event_attributes->create();

        }
        include "src/views/event/view_events.php";
    }
    public function update() {
        var_dump($_POST);
        $event = new Event(...Helper::validate($_POST["name"],$_SESSION["user_id"],$_POST["date"],$_POST["start_time"],$_POST["end_time"],$_POST["event_id"]));
        $attributes = [];
        for ($i = 0; $i < count($_POST["attributes"]); $i++) {
            $attributes[] = ["name" => $_POST["attributes"][$i], "type" => $_POST["attribute_types"][$i], "id" => $_POST["attribute_id"]];
        }
        $event->update();
    }
    public function show($id) {
        $event = Event::get($id);
        if($event === null) {
            return;
        }
        $event_attributes = Event_Attributes::getEventAttributes($id);
        foreach ($event_attributes as &$event_attribute) {
            $event_attribute = new Attribute($event_attribute["name"],$event_attribute["type"],$event_attribute["mru_counter"],$event_attribute["id"]);
        }
        unset($event_attribute);
        $event = new Event($event["name"],$event["organiser_id"],$event["date"],$event["start_time"],$event["end_time"],$event["id"]);
        include "src/views/event/edit_event.php";
    }
    public function showAll() {
        $events = Event::getAll();
        include "src/views/event/view_events.php";
    }
    public function delete($id) {
        Event::delete($id);
        $events = Event::getAll();
        include "src/views/event/view_events.php";
    }
}