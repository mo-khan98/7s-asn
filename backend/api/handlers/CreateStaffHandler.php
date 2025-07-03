<?php

class CreateStaffHandler {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function handle(CreateStaffCommand $command) {
        $stmt = $this->db->prepare("INSERT INTO staff (name, role, phone, email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$command->name, $command->role, $command->phone, $command->email]);
        return (int)$this->db->lastInsertId();
    }
} 