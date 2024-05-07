<?php

namespace src\models;
use src\Database;

class Attribute
{
    private int $id;
    private string $name;
    private int $mru_counter;
    private int $type;

    function __construct($name, $type, $mru_counter = 1, $id = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->mru_counter = $mru_counter;
        $this->type = (int)$type;

    }

    public function getId(): int {
        return $this->id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getMRU_Counter(): int {
        return $this->mru_counter;
    }
    public function getType(): int {
        return $this->type;
    }

    /**
     * Inserts the attribute into the database and returns the id of the attribute
     * @return int
     */
    function create(): int
    {
        $stmt = Database::getInstance()->getConnection()->prepare("INSERT INTO attribute (name,mru_counter,type) 
                                                  VALUES (?,?,?)");
        $stmt->bind_param("sii",$this->name,$this->mru_counter,$this->type);
        $stmt->execute();
        return $stmt->insert_id;
    }

    function update()
    {
        $stmt = Database::getInstance()->getConnection()->prepare("UPDATE attribute 
                                                    SET name = ?, mru_counter = ?, type = ? WHERE id = ?");
        $stmt->bind_param("siii",$this->name,$this->mru_counter,$this->type,$this->id);
        $stmt->execute();
    }

    static function get($id): ?array
    {
        $stmt = Database::getInstance()->getConnection()->prepare("SELECT * FROM attribute WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if (empty($result)) {
            return null;
        }
        return $result;
    }
    static function getByName($name): ?array
    {
        $stmt = Database::getInstance()->getConnection()->prepare("SELECT * FROM attribute WHERE name = ?");
        $stmt->bind_param("s",$name);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if (empty($result)) {
            return null;
        }
        return $result;
    }

    static function getAll(): array
    {
        $result = Database::getInstance()->getConnection()->query("SELECT * FROM attribute");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function delete($id)
    {
        $stmt = Database::getInstance()->getConnection()->prepare("DELETE FROM attribute WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}