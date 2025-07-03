<?php

class AssignShiftHandler {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function handle(AssignShiftCommand $command) {
        $stmt = $this->db->prepare("INSERT INTO shift_assignments (shift_id, staff_id) VALUES (?, ?)");
        $stmt->execute([$command->shift_id, $command->staff_id]);
        return $this->db->lastInsertId();
    }
} 