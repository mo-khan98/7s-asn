<?php

class Assignment {
    public $id;
    public $shift_id;
    public $staff_id;
    public $assigned_at;
    public $staff_name;
    public $shift_day;
    public $shift_start_time;
    public $shift_end_time;
    public $shift_role;

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
} 