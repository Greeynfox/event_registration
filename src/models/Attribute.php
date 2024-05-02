<?php

namespace src\models;
use src\Database;

class Attribute
{
    private ?int $id;
    private string $name;
    private bool $value;
    private string $additional_information;
    private int $mru_counter;


    function __construct($name, $value,$additional_information, $mru_counter, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->additional_information= $additional_information;
        $this->mru_counter = $mru_counter;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getValue(): bool {
        return $this->value;
    }
    public function getAdditionalInformation(): string
    {
        return $this->additional_information;
    }
    public function getMRU_Counter(): int {
        return $this->mru_counter;
    }

    /**
     * Returns the id of the created User
     * @return int
     */
    function create(): int
    {
        Database::getInstance()->getConnection()->query("INSERT INTO attribute (name, value,additional_information,mru_counter) 
                                                  VALUES ('$this->name',
                                                          $this->value,
                                                          '$this->additional_information',
                                                          $this->mru_counter)");
        return Database::getInstance()->getConnection()->insert_id;
    }

    function update()
    {
        Database::getInstance()->getConnection()->query("UPDATE attribute 
                                                    SET name='$this->name',
                                                        value='$this->value',
                                                        mru_counter=$this->mru_counter
                                                    WHERE id = $this->id");
    }

    static function get($id)
    {
        $result = Database::getInstance()->getConnection()->query("SELECT name,value,additional_information,mru_counter FROM attribute WHERE id = $id");
        return $result->fetch_row();
    }

    static function getAll()
    {
        $result = Database::getInstance()->getConnection()->query("SELECT name,value,additional_information,mru_counter FROM attribute ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function delete($id)
    {
        Database::getInstance()->getConnection()->query("DELETE * FROM attributes WHERE id = $id");
    }
}