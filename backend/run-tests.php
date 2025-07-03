<?php

// Simple test runner for the backend
echo "Running PHPUnit tests...\n";

// Check if PHPUnit is available
if (!class_exists('PHPUnit\Framework\TestCase')) {
    echo "PHPUnit not found. Please install it first:\n";
    echo "composer require --dev phpunit/phpunit\n";
    exit(1);
}

// Run tests using PHPUnit
$command = 'vendor/bin/phpunit --configuration phpunit.xml';
$output = [];
$returnCode = 0;

exec($command, $output, $returnCode);

// Display output
foreach ($output as $line) {
    echo $line . "\n";
}

// Exit with appropriate code
exit($returnCode); 