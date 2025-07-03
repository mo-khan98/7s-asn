<?php

use PHPUnit\Framework\TestCase;

class ModelsTest extends TestCase
{
    public function testStaffModel()
    {
        $data = [
            'id' => 1,
            'name' => 'FirstName1 LastName1',
            'role' => 'server',
            'phone' => '111-123-1234',
            'email' => 'fn1@test.com',
            'created_at' => '2024-01-01 10:00:00',
            'updated_at' => '2024-01-01 10:00:00'
        ];
        
        $staff = new Staff($data);
        
        $this->assertEquals(1, $staff->id);
        $this->assertEquals('FirstName1 LastName1', $staff->name);
        $this->assertEquals('server', $staff->role);
        $this->assertEquals('111-123-1234', $staff->phone);
        $this->assertEquals('fn1@test.com', $staff->email);
        $this->assertEquals('2024-01-01 10:00:00', $staff->created_at);
        $this->assertEquals('2024-01-01 10:00:00', $staff->updated_at);
    }

    public function testShiftModel()
    {
        $data = [
            'id' => 1,
            'day' => '2024-07-03',
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
            'role' => 'manager',
            'created_at' => '2024-01-01 10:00:00',
            'updated_at' => '2024-01-01 10:00:00'
        ];
        
        $shift = new Shift($data);
        
        $this->assertEquals(1, $shift->id);
        $this->assertEquals('2024-07-03', $shift->day);
        $this->assertEquals('09:00:00', $shift->start_time);
        $this->assertEquals('17:00:00', $shift->end_time);
        $this->assertEquals('manager', $shift->role);
        $this->assertEquals('2024-01-01 10:00:00', $shift->created_at);
        $this->assertEquals('2024-01-01 10:00:00', $shift->updated_at);
    }

    public function testAssignmentModel()
    {
        $data = [
            'id' => 1,
            'shift_id' => 1,
            'staff_id' => 2,
            'assigned_at' => '2024-01-01 10:00:00',
            'staff_name' => 'FirstName1 LastName1',
            'shift_day' => '2024-07-03',
            'shift_start_time' => '09:00:00',
            'shift_end_time' => '17:00:00',
            'shift_role' => 'manager'
        ];
        
        $assignment = new Assignment($data);
        
        $this->assertEquals(1, $assignment->id);
        $this->assertEquals(1, $assignment->shift_id);
        $this->assertEquals(2, $assignment->staff_id);
        $this->assertEquals('2024-01-01 10:00:00', $assignment->assigned_at);
            $this->assertEquals('FirstName1 LastName1', $assignment->staff_name);
        $this->assertEquals('2024-07-03', $assignment->shift_day);
        $this->assertEquals('09:00:00', $assignment->shift_start_time);
        $this->assertEquals('17:00:00', $assignment->shift_end_time);
        $this->assertEquals('manager', $assignment->shift_role);
    }

    public function testModelsWithEmptyData()
    {
        $staff = new Staff([]);
        $this->assertNull($staff->id);
        $this->assertNull($staff->name);
        
        $shift = new Shift([]);
        $this->assertNull($shift->id);
        $this->assertNull($shift->day);
        
        $assignment = new Assignment([]);
        $this->assertNull($assignment->id);
        $this->assertNull($assignment->shift_id);
    }
} 