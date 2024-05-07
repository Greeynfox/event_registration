<?php

namespace src\models;
use src\Database;
class User
{

    private int $id;
    private string $username;
    private ?string $password;
    private int $authorisation;

    function __construct($username, $authorisation, $password, $id = 0)
    {
        $this->id = (int)$id; //cast is necessary, as the validate() function of the user controller returns a string
        $this->username = $username;
        $this->password = $password;
        $this->authorisation = (int)$authorisation;//cast is necessary, as the validate() function of the user controller returns a string

    }
    public function getId(): int {
        return $this->id;
    }
    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getAuthorisation(): int {
        return $this->authorisation;
    }

    /**
     * Returns the id of the created User
     * @return int
     */
    function create(): int
    {
        Database::getInstance()->getConnection()->query("INSERT INTO user (username, password, authorisation) 
                                                VALUES ('$this->username',
                                                        '$this->password',
                                                        $this->authorisation)");
        return Database::getInstance()->getConnection()->insert_id;
    }

    function update()
    {
        Database::getInstance()->getConnection()->query("UPDATE user
                                                SET username='$this->username',
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