<?php

class ShiftService {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllShifts() {
        $stmt = $this->db->query("SELECT * FROM shifts ORDER BY day, start_time");
        $shifts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $shifts[] = new Shift($row);
        }
        return $shifts;
    }

    public function getShiftsByDay($day) {
        $stmt = $this->db->prepare("SELECT * FROM shifts WHERE day = ? ORDER BY start_time");
        $stmt->execute([$day]);
        $shifts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $shifts[] = new Shift($row);
        }
        return $shifts;
    }
} 