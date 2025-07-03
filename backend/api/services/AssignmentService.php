<?php

class AssignmentService {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllAssignments() {
        $stmt = $this->db->query("
            SELECT sa.*, s.name as staff_name, sh.day as shift_day, 
                   sh.start_time as shift_start_time, sh.end_time as shift_end_time, 
                   sh.role as shift_role
            FROM shift_assignments sa
            JOIN staff s ON sa.staff_id = s.id
            JOIN shifts sh ON sa.shift_id = sh.id
            ORDER BY sh.day, sh.start_time
        ");
        $assignments = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $assignments[] = new Assignment($row);
        }
        return $assignments;
    }

    public function getAssignmentsByDay($day) {
        $stmt = $this->db->prepare("
            SELECT sa.*, s.name as staff_name, sh.day as shift_day, 
                   sh.start_time as shift_start_time, sh.end_time as shift_end_time, 
                   sh.role as shift_role
            FROM shift_assignments sa
            JOIN staff s ON sa.staff_id = s.id
            JOIN shifts sh ON sa.shift_id = sh.id
            WHERE sh.day = ?
            ORDER BY sh.start_time
        ");
        $stmt->execute([$day]);
        $assignments = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $assignments[] = new Assignment($row);
        }
        return $assignments;
    }
} 