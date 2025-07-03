<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once 'config/Database.php';
require_once 'api/models/Staff.php';
require_once 'api/models/Shift.php';
require_once 'api/models/Assignment.php';
require_once 'commands/CreateStaffCommand.php';
require_once 'commands/CreateShiftCommand.php';
require_once 'commands/AssignShiftCommand.php';
require_once 'api/handlers/CreateStaffHandler.php';
require_once 'api/handlers/CreateShiftHandler.php';
require_once 'api/handlers/AssignShiftHandler.php';
require_once 'api/services/StaffService.php';
require_once 'api/services/ShiftService.php';
require_once 'api/services/AssignmentService.php';

$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

try {
    if (strpos($path, '/api/staff') !== false) {
        $staffService = new StaffService();
        
        if ($method === 'GET') {
            $staff = $staffService->getAllStaff();
            echo json_encode(['success' => true, 'data' => $staff]);
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $command = new CreateStaffCommand($data);
            $handler = new CreateStaffHandler();
            $id = $handler->handle($command);
            echo json_encode(['success' => true, 'id' => $id]);
        }
    } elseif (strpos($path, '/api/shifts') !== false) {
        $shiftService = new ShiftService();
        
        if ($method === 'GET') {
            $shifts = $shiftService->getAllShifts();
            echo json_encode(['success' => true, 'data' => $shifts]);
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $command = new CreateShiftCommand($data);
            $handler = new CreateShiftHandler();
            $id = $handler->handle($command);
            echo json_encode(['success' => true, 'id' => $id]);
        }
    } elseif (strpos($path, '/api/assignments') !== false) {
        $assignmentService = new AssignmentService();
        
        if ($method === 'GET') {
            $assignments = $assignmentService->getAllAssignments();
            echo json_encode(['success' => true, 'data' => $assignments]);
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $command = new AssignShiftCommand($data);
            $handler = new AssignShiftHandler();
            $id = $handler->handle($command);
            echo json_encode(['success' => true, 'id' => $id]);
        }
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'Not found']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
