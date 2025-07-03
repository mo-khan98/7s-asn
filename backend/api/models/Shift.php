<?php

class Shift {
    public $id;
    public $day;
    public $start_time;
    public $end_time;
    public $role;
    public $created_at;
    public $updated_at;

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
} 