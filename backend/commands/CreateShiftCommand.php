<?php

class CreateShiftCommand {
    public $day;
    public $start_time;
    public $end_time;
    public $role;

    public function __construct($data) {
        $this->day = $data['day'] ?? '';
        $this->start_time = $data['start_time'] ?? '';
        $this->end_time = $data['end_time'] ?? '';
        $this->role = $data['role'] ?? '';
    }
} 