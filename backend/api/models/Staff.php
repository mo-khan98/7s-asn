<?php

class Staff {
    public $id;
    public $name;
    public $role;
    public $phone;
    public $email;
    public $created_at;
    public $updated_at;

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
} 