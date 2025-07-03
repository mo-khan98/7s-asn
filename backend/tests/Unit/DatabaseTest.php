<?php

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function testGetInstanceReturnsSameInstance()
    {
        $instance1 = Database::getInstance();
        $instance2 = Database::getInstance();
        
        $this->assertSame($instance1, $instance2);
    }

    public function testGetConnectionReturnsPDOInstance()
    {
        $database = Database::getInstance();
        $connection = $database->getConnection();
        
        $this->assertInstanceOf(PDO::class, $connection);
    }

    public function testConnectionHasCorrectAttributes()
    {
        $database = Database::getInstance();
        $connection = $database->getConnection();
        
        $this->assertEquals(PDO::ERRMODE_EXCEPTION, $connection->getAttribute(PDO::ATTR_ERRMODE));
    }
} 