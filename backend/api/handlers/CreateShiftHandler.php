<?php

class CreateShiftHandler {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function handle(CreateShiftCommand $command) {
        $stmt = $this->db->prepare("INSERT INTO shifts (day, start_time, end_time, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$command->day, $command->start_time, $command->end_time, $command->role]);
        return (int)$this->db->lastInsertId();
    }
} 