<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../api/models/Staff.php';
require_once __DIR__ . '/../api/models/Shift.php';
require_once __DIR__ . '/../api/models/Assignment.php';
require_once __DIR__ . '/../commands/CreateStaffCommand.php';
require_once __DIR__ . '/../commands/CreateShiftCommand.php';
require_once __DIR__ . '/../commands/AssignShiftCommand.php';
require_once __DIR__ . '/../api/handlers/CreateStaffHandler.php';
require_once __DIR__ . '/../api/handlers/CreateShiftHandler.php';
require_once __DIR__ . '/../api/handlers/AssignShiftHandler.php';
require_once __DIR__ . '/../api/services/StaffService.php';
require_once __DIR__ . '/../api/services/ShiftService.php';
require_once __DIR__ . '/../api/services/AssignmentService.php'; 