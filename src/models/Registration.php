<?php

namespace src\models;
use src\Database;
class Registration
{
    private int $id;
    private string $first_name;
    private string $last_name;
    private int $event_id;

    function __construct($first_name,$last_name,$event_id, $id = 0)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->event_id = $event_id;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getEventId(): int {
        return $this->event_id;
    }
    public function getFirstName(): string {
        return $this->first_name;
    }
    public function getLastName(): string {
        return $this->last_name;
    }

    function create(): int
    {
        $stmt = Database::getInstance()->getConnection()->prepare("INSERT INTO registration (first_name,last_name,event_id) VALUES (?,?,?)");
        $stmt->bind_param("ssi",$this->first_name,$this->last_name,$this->event_id);
        $stmt->execute();
        return $stmt->insert_id;

    }

    function update()
    {
        //Database::getInstance()->getConnection()->prepare("UPDATE registration SET ");
    }

    static function get($id)
    {
        $result = Database::getInstance()->getConnection()->query("SELECT FROM event WHERE id = $id");
        return $result->fetch_row();
    }
    static function getAll()
    {
        $result = Database::getInstance()->getConnection()->query();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function delete($id)
    {
        Database::getInstance()->getConnection()->query("DELETE * FROM registration WHERE id = $id");
    }
}