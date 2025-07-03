<?php

use PHPUnit\Framework\TestCase;

class ServicesTest extends TestCase
{
    private $pdo;
    private $staffService;
    private $shiftService;
    private $assignmentService;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=db;dbname=main_db', 'user', 'pass');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->pdo->exec('DELETE FROM shift_assignments');
        $this->pdo->exec('DELETE FROM shifts');
        $this->pdo->exec('DELETE FROM staff');
    
        $this->pdo->exec('ALTER TABLE staff AUTO_INCREMENT = 1');
        $this->pdo->exec('ALTER TABLE shifts AUTO_INCREMENT = 1');
        $this->pdo->exec('ALTER TABLE shift_assignments AUTO_INCREMENT = 1');

        $this->insertTestData();
        
        $this->staffService = new StaffService();
        $this->shiftService = new ShiftService();
        $this->assignmentService = new AssignmentService();
    }

    private function insertTestData()
    {
        $stmt = $this->pdo->prepare('INSERT INTO staff (name, role, phone, email) VALUES (?, ?, ?, ?)');
        $stmt->execute(['FirstName1 LastName1', 'server', '111-123-1234', 'fn1@example.com']);
        $stmt->execute(['FirstName2 LastName2', 'cook', '111-123-5678', 'fn2@example.com']);
        $stmt->execute(['FirstName3 LastName3', 'manager', '111-123-9012', 'fn3@example.com']);
        
        $stmt = $this->pdo->prepare('INSERT INTO shifts (day, start_time, end_time, role) VALUES (?, ?, ?, ?)');
        $stmt->execute(['2024-07-03', '09:00:00', '17:00:00', 'manager']);
        $stmt->execute(['2024-07-03', '10:00:00', '18:00:00', 'server']);
        $stmt->execute(['2024-07-03', '08:00:00', '16:00:00', 'cook']);
        
        $stmt = $this->pdo->prepare('INSERT INTO shift_assignments (shift_id, staff_id) VALUES (?, ?)');
        $stmt->execute([1, 3]);
    }

    public function testStaffServiceGetAllStaff()
    {
        $staff = $this->staffService->getAllStaff();
        
        $this->assertIsArray($staff);
        $this->assertCount(3, $staff);
        $this->assertInstanceOf(Staff::class, $staff[0]);
        $this->assertEquals('FirstName1 LastName1', $staff[0]->name);
        $this->assertEquals('server', $staff[0]->role);
    }

    public function testStaffServiceGetStaffByRole()
    {
        $servers = $this->staffService->getStaffByRole('server');
        
        $this->assertIsArray($servers);
        $this->assertCount(1, $servers);
        $this->assertEquals('FirstName1 LastName1', $servers[0]->name);
        $this->assertEquals('server', $servers[0]->role);
    }

    public function testShiftServiceGetAllShifts()
    {
        $shifts = $this->shiftService->getAllShifts();
        
        $this->assertIsArray($shifts);
        $this->assertCount(3, $shifts);
        $this->assertInstanceOf(Shift::class, $shifts[0]);
        $this->assertEquals('2024-07-03', $shifts[0]->day);
        $this->assertEquals('08:00:00', $shifts[0]->start_time);
        $this->assertEquals('cook', $shifts[0]->role);
    }

    public function testShiftServiceGetShiftsByDay()
    {
        $shifts = $this->shiftService->getShiftsByDay('2024-07-03');
        
        $this->assertIsArray($shifts);
        $this->assertCount(3, $shifts);
        
        foreach ($shifts as $shift) {
            $this->assertEquals('2024-07-03', $shift->day);
        }
    }

    public function testAssignmentServiceGetAllAssignments()
    {
        $assignments = $this->assignmentService->getAllAssignments();
        
        $this->assertIsArray($assignments);
        $this->assertCount(1, $assignments);
        $this->assertInstanceOf(Assignment::class, $assignments[0]);
        $this->assertEquals(1, $assignments[0]->shift_id);
        $this->assertEquals(3, $assignments[0]->staff_id);
        $this->assertEquals('FirstName3 LastName3', $assignments[0]->staff_name);
        $this->assertEquals('2024-07-03', $assignments[0]->shift_day);
        $this->assertEquals('09:00:00', $assignments[0]->shift_start_time);
        $this->assertEquals('17:00:00', $assignments[0]->shift_end_time);
        $this->assertEquals('manager', $assignments[0]->shift_role);
    }

    public function testAssignmentServiceGetAssignmentsByDay()
    {
        $assignments = $this->assignmentService->getAssignmentsByDay('2024-07-03');
        
        $this->assertIsArray($assignments);
        $this->assertCount(1, $assignments);
    
        foreach ($assignments as $assignment) {
            $this->assertEquals('2024-07-03', $assignment->shift_day);
        }
    }

    protected function tearDown(): void
    {
        $this->pdo->exec('DELETE FROM shift_assignments');
        $this->pdo->exec('DELETE FROM shifts');
        $this->pdo->exec('DELETE FROM staff');
    }
} 