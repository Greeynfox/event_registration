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
        $stmt = Database::getInstance()->getConnection()->prepare("SELECT a.*, event_id FROM attribute a 
                                                JOIN event_attributes ea ON a.id = ea.attribute_id
                                                WHERE event_id = ?");
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);

    }
    static function delete($event_id,$attribute_id) {
        $stmt = Database::getInstance()->getConnection()->prepare("DELETE FROM event_attributes WHERE event_id = ? AND attribute_id = ?");
        $stmt->bind_param("ii",$event_id,$attribute_id);
        $stmt->execute();
    }
    static function deleteAll($id) {
        $stmt = Database::getInstance()->getConnection()->prepare("DELETE FROM event_attributes WHERE event_id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
    }

}