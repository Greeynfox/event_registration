<?php

namespace src\models;
use src\Database;
class User
{

    private ?int $id;
    private string $first_name;
    private string $last_name;
    private ?string $password;
    private int $authorisation;

    function __construct($first_name, $last_name, $authorisation, $id = null, $password = null)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->password = $password;
        $this->authorisation = (int)$authorisation;

    }
    public function getId(): int {
        return $this->id;
    }

    public function getFirstName(): string {
        return $this->first_name;
    }

    public function getLastName(): string {
        return $this->last_name;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getAuthorisation(): int {
        return $this->authorisation;
    }

    function create()
    {
        Database::getInstance()->getConnection()->query("INSERT INTO user (first_name, last_name, password, authorisation) 
                                                VALUES ('$this->first_name',
                                                        '$this->last_name',
                                                        '$this->password',
                                                        $this->authorisation)");
        return Database::getInstance()->getConnection()->insert_id;
    }

    function update()
    {
        Database::getInstance()->getConnection()->query("UPDATE user
                                                SET first_name='$this->first_name',
                                                    last_name='$this->last_name',
                                                    authorisation=$this->authorisation 
                                                WHERE id = $this->id");
    }

    static function get($id): User
    {
        $result = Database::getInstance()->getConnection()->query("SELECT * FROM user WHERE id = $id");
        return new User(...$result->fetch_row());
    }

    static function getAll(): array
    {
        $result = Database::getInstance()->getConnection()->query("SELECT * FROM user");
        $users = array();
        while ($row = $result->fetch_row()) {
            $users[] = new User(...$row);
        }
        return $users;
    }

    static function delete($id)
    {
        Database::getInstance()->getConnection()->query("DELETE * FROM user WHERE id = $id");
    }
}