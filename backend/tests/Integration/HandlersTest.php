<?php

use PHPUnit\Framework\TestCase;

class HandlersTest extends TestCase
{
    private $pdo;
    private $createStaffHandler;
    private $createShiftHandler;
    private $assignShiftHandler;

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
        
        $this->createStaffHandler = new CreateStaffHandler();
        $this->createShiftHandler = new CreateShiftHandler();
        $this->assignShiftHandler = new AssignShiftHandler();
    }

    public function testCreateStaffHandler()
    {
        $command = new CreateStaffCommand([
            'name' => 'Test Staff',
            'role' => 'server',
            'phone' => '263-293-2398',
            'email' => 'test@example.com'
        ]);
        
        $staffId = $this->createStaffHandler->handle($command);
        
        $this->assertIsInt($staffId);
        $this->assertGreaterThan(0, $staffId);

        $stmt = $this->pdo->prepare('SELECT * FROM staff WHERE id = ?');
        $stmt->execute([$staffId]);
        $staff = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->assertEquals('Test Staff', $staff['name']);
        $this->assertEquals('server', $staff['role']);
        $this->assertEquals('263-293-2398', $staff['phone']);
        $this->assertEquals('test@example.com', $staff['email']);
    }

    public function testCreateShiftHandler()
    {
        $command = new CreateShiftCommand([
            'day' => '2024-01-15',
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
            'role' => 'manager'
        ]);
        
        $shiftId = $this->createShiftHandler->handle($command);
        
        $this->assertIsInt($shiftId);
        $this->assertGreaterThan(0, $shiftId);

        $stmt = $this->pdo->prepare('SELECT * FROM shifts WHERE id = ?');
        $stmt->execute([$shiftId]);
        $shift = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->assertEquals('2024-01-15', $shift['day']);
        $this->assertEquals('09:00:00', $shift['start_time']);
        $this->assertEquals('17:00:00', $shift['end_time']);
        $this->assertEquals('manager', $shift['role']);
    }

    public function testAssignShiftHandler()
    {
        $staffCommand = new CreateStaffCommand([
            'name' => 'Test Staff',
            'role' => 'server',
            'phone' => '263-293-2398',
            'email' => 'test@example.com'
        ]);
        $staffId = $this->createStaffHandler->handle($staffCommand);
        
        $shiftCommand = new CreateShiftCommand([
            'day' => '2024-01-15',
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
            'role' => 'server'
        ]);
        $shiftId = $this->createShiftHandler->handle($shiftCommand);
        
        $assignCommand = new AssignShiftCommand([
            'shift_id' => $shiftId,
            'staff_id' => $staffId
        ]);
        
        $assignmentId = $this->assignShiftHandler->handle($assignCommand);
        
        $this->assertIsInt($assignmentId);
        $this->assertGreaterThan(0, $assignmentId);
        
        $stmt = $this->pdo->prepare('SELECT * FROM shift_assignments WHERE id = ?');
        $stmt->execute([$assignmentId]);
        $assignment = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->assertEquals($shiftId, $assignment['shift_id']);
        $this->assertEquals($staffId, $assignment['staff_id']);
    }

    protected function tearDown(): void
    {
        $this->pdo->exec('DELETE FROM shift_assignments');
        $this->pdo->exec('DELETE FROM shifts');
        $this->pdo->exec('DELETE FROM staff');
    }
} 