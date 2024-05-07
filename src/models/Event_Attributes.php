<?php

namespace src\models;
use src\Database;
class Event_Attributes
{
    private int $event_id;
    private int $attributes_id;

    function __construct($event_id, $attributes_id)
    {
        $this->event_id = $event_id;
        $this->attributes_id = $attributes_id;
    }

    function create () {
        Database::getInstance()->getConnection()->query("INSERT INTO event_attributes (attribute_id, event_id) 
                                                VALUES ($this->attributes_id,$this->event_id)");
    }

    static function getEventAttributes ($event_id) : array {
        $result = Database::getInstance()->getConnection()->query("SELECT * FROM attribute a 
                                                JOIN event_attributes ea ON a.id = ea.attribute_id
                                                WHERE event_id = $event_id");
        return $result->fetch_all(MYSQLI_ASSOC);

    }

}