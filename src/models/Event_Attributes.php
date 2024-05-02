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
}