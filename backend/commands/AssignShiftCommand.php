<?php

class AssignShiftCommand {
    public $shift_id;
    public $staff_id;

    public function __construct($data) {
        $this->shift_id = $data['shift_id'] ?? 0;
        $this->staff_id = $data['staff_id'] ?? 0;
    }
} 