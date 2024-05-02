<?php

namespace src\models;
use src\Database;
class Registration
{
    private int $id;
    private int $event_id;
    private int $user_id;

    function __construct($id,$event_id, $user_id)
    {
        $this->id = $id;
        $this->event_id = $event_id;
        $this->user_id = $user_id;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getEventId(): int {
        return $this->event_id;
    }
    public function getUserId(): int {
        return $this->user_id;
    }
}