<?php

class StaffService {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllStaff() {
        $stmt = $this->db->query("SELECT * FROM staff ORDER BY name");
        $staff = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $staff[] = new Staff($row);
        }
        return $staff;
    }

    public function getStaffByRole($role) {
        $stmt = $this->db->prepare("SELECT * FROM staff WHERE role = ? ORDER BY name");
        $stmt->execute([$role]);
        $staff = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $staff[] = new Staff($row);
        }
        return $staff;
    }
} 