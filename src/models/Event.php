<?php

namespace src\models;
use src\Database;

class Event
{
    private int $id;
    private string $name;
    private int $organiser_id;
    private string $date;
    private ?string $start_time;
    private ?string $end_time;

    function __construct($name, $organiser_id, $date, $start_time = null, $end_time = null, $id = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->organiser_id = $organiser_id;
        $this->date = $date;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getOrganiserId(): int {
        return $this->organiser_id;
    }
    public function getDate(): string {
        return $this->date;
    }
    public function getStartTime(): string {
        return $this->start_time;
    }
    public function getEndTime(): string {
        return $this->end_time;
    }

    /**
     * Inserts the event into the database and returns the id of the event
     * @return int
     */
    function create(): int
    {
        $stmt = Database::getInstance()->getConnection()->prepare("INSERT INTO event (name, organiser_id, date, start_time, end_time) 
                                                  VALUES (?,?,?,?,?)");
        $stmt->bind_param("sisss",$this->name,$this->organiser_id,$this->date,$this->start_time,$this->end_time);
        $stmt->execute();
        return $stmt->insert_id;

    }

    function update()
    {
        $stmt = Database::getInstance()->getConnection()->prepare("UPDATE event
                                                  SET name = ?, organiser_id = ?,date= ?, start_time = ?, end_time = ? WHERE id = ?");
        $stmt->bind_param("sisssi",$this->name,$this->organiser_id,$this->date,$this->start_time,$this->end_time,$this->id);
        $stmt->execute();
    }

    static function get($id): ?array
    {
        $stmt = Database::getInstance()->getConnection()->prepare("SELECT * FROM event WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if (empty($result)) {
            return null;
        }
        return $result;
    }
    static function getAll(): array
    {
        $result = Database::getInstance()->getConnection()->query("SELECT * FROM event ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static function delete($id)
    {
        $stmt = Database::getInstance()->getConnection()->prepare("DELETE FROM event WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
    }
}