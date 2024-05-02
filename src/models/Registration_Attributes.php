<?php

namespace src\models;
use src\Database;
class Registration_Attributes
{
    private int $registration_id;
    private int $attributes_id;

    function __construct($registration_id, $attributes_id)
    {
        $this->registration_id = $registration_id;
        $this->attributes_id = $attributes_id;
    }
    public function getRegistrationId(): int {
        return $this->registration_id;
    }
    public function getAttributesId(): int {
        return $this->attributes_id;
    }
}