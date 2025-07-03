CREATE DATABASE IF NOT EXISTS main_db;
USE main_db;

-- staaf
CREATE TABLE staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    role ENUM('server', 'cook', 'manager') NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_role (role),
    INDEX idx_name (name)
);

-- shifts info
CREATE TABLE shifts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    day DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    role ENUM('server', 'cook', 'manager') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_day (day),
    INDEX idx_role (role),
    INDEX idx_day_role (day, role),
    -- Ensure end_time is after start_time
    CONSTRAINT chk_time_order CHECK (end_time > start_time)
);

-- assignments tracking
CREATE TABLE shift_assignments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    shift_id INT NOT NULL,
    staff_id INT NOT NULL,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (shift_id) REFERENCES shifts(id) ON DELETE CASCADE,
    FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE,
    UNIQUE KEY unique_assignment (shift_id, staff_id),
    INDEX idx_shift_id (shift_id),
    INDEX idx_staff_id (staff_id)
);

-- sample staff
INSERT INTO staff (name, role, phone, email) VALUES
('John Smith', 'manager', '555-0101', 'john.smith@restaurant.com'),
('Sarah Johnson', 'server', '555-0102', 'sarah.johnson@restaurant.com'),
('Mike Davis', 'cook', '555-0103', 'mike.davis@restaurant.com'),
('Lisa Wilson', 'server', '555-0104', 'lisa.wilson@restaurant.com'),
('Tom Brown', 'cook', '555-0105', 'tom.brown@restaurant.com');

-- sample shifts
INSERT INTO shifts (day, start_time, end_time, role) VALUES
(CURDATE(), '09:00:00', '17:00:00', 'manager'),
(CURDATE(), '10:00:00', '18:00:00', 'server'),
(CURDATE(), '08:00:00', '16:00:00', 'cook'),
(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '09:00:00', '17:00:00', 'manager'),
(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '10:00:00', '18:00:00', 'server'),
(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '08:00:00', '16:00:00', 'cook'),
(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '09:00:00', '17:00:00', 'manager'),
(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '10:00:00', '18:00:00', 'server'),
(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '08:00:00', '16:00:00', 'cook');

-- sample assignments
INSERT INTO shift_assignments (shift_id, staff_id) VALUES
(1, 1), -- John Smith assigned to manager shift
(2, 2), -- Sarah Johnson assigned to server shift
(3, 3), -- Mike Davis assigned to cook shift
(4, 1), -- John Smith assigned to next day manager shift
(5, 4), -- Lisa Wilson assigned to next day server shift
(6, 5); -- Tom Brown assigned to next day cook shift
