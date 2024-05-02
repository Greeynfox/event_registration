<?php

namespace src\models;
use src\Database;

class Event
{
    private int $id;
    private string $name;
    private int $organiser_id;
    private string $date;
    private string $start_time;
    private string $end_time;

    function __construct($name, $organiser_id, $date, $id = 0, $start_time = null, $end_time = null)
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

    function create()
    {
        Database::getInstance()->getConnection()->query("INSERT INTO event (name, organiser_id, date, start_time, end_time) 
                                                  VALUES ('$this->name',
                                                          '$this->organiser_id',
                                                          '$this->date',
                                                          '$this->start_time',
                                                          '$this->end_time')");
        return Database::getInstance()->getConnection()->insert_id;

    }

    function update()
    {
        Database::getInstance()->getConnection()->query("UPDATE event 
                                                SET name='$this->name',
                                                    organiser=$this->organiser_id,
                                                    date='$this->date',
                                                    start_time='$this->start_time',
                                                    end_time='$this->end_time'
                                                WHERE id = $this->id");
    }

    static function get($id)
    {
        $result = Database::getInstance()->getConnection()->query("SELECT name, date, start_time, end_time FROM event WHERE id = $id");
        return $result->fetch_row();
    }
    static function getAll()
    {
        $result = Database::getInstance()->getConnection()->query("SELECT user.first_name,user.last_name, name, date, start_time, end_time 
                                                            FROM event JOIN user ON user.id = event.organiser_id ORDER BY name");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function delete($id)
    {
        Database::getInstance()->getConnection()->query("DELETE * FROM event WHERE id = $id");
    }
}