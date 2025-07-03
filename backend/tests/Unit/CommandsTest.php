<?php

use PHPUnit\Framework\TestCase;

class CommandsTest extends TestCase
{
    public function testCreateStaffCommand()
    {
        $data = [
            'name' => 'FirstName1 LastName1',
            'role' => 'server',
            'phone' => '111-123-1234',
            'email' => 'fn1@test.com'
        ];
        
        $command = new CreateStaffCommand($data);
        
        $this->assertEquals('FirstName1 LastName1', $command->name);
        $this->assertEquals('server', $command->role);
        $this->assertEquals('111-123-1234', $command->phone);
        $this->assertEquals('fn1@test.com', $command->email);
    }

    public function testCreateShiftCommand()
    {
        $data = [
            'day' => '2024-07-03',
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
            'role' => 'manager'
        ];
        
        $command = new CreateShiftCommand($data);
        
        $this->assertEquals('2024-07-03', $command->day);
        $this->assertEquals('09:00:00', $command->start_time);
        $this->assertEquals('17:00:00', $command->end_time);
        $this->assertEquals('manager', $command->role);
    }

    public function testAssignShiftCommand()
    {
        $data = [
            'shift_id' => 1,
            'staff_id' => 2
        ];
        
        $command = new AssignShiftCommand($data);
        
        $this->assertEquals(1, $command->shift_id);
        $this->assertEquals(2, $command->staff_id);
    }

    public function testCommandsWithMissingData()
    {
        $staffCommand = new CreateStaffCommand([]);
        $this->assertEquals('', $staffCommand->name);
        $this->assertEquals('', $staffCommand->role);
        
        $shiftCommand = new CreateShiftCommand([]);
        $this->assertEquals('', $shiftCommand->day);
        $this->assertEquals('', $shiftCommand->start_time);
        
        $assignCommand = new AssignShiftCommand([]);
        $this->assertEquals(0, $assignCommand->shift_id);
        $this->assertEquals(0, $assignCommand->staff_id);
    }
} 