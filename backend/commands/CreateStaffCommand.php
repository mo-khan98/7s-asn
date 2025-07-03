<?php

class CreateStaffCommand {
    public $name;
    public $role;
    public $phone;
    public $email;

    public function __construct($data) {
        $this->name = $data['name'] ?? '';
        $this->role = $data['role'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->email = $data['email'] ?? '';
    }
} 