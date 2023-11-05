<?php
require './app/lib/Sensor.php'; // Ścieżka do pliku z klasą Sensor

use PHPUnit\Framework\TestCase;

class SensorTest extends TestCase {
    private $sensor;

    protected function setUp(): void {
        parent::setUp();
        $this->sensor = new Sensor();
    }

    protected function tearDown(): void {
        parent::tearDown();
        $this->sensor = null;
    }

    public function testIsLocal(): void {
        // Testowanie metody isLocal
        $this->assertTrue($this->sensor->isLocal('127.0.0.1'));
        $this->assertTrue($this->sensor->isLocal('::1'));
        $this->assertFalse($this->sensor->isLocal('192.168.1.1'));
    }

    public function testAddrIp(): void {
        // Testowanie metody addrIp
        // Aby przetestować tę metodę, musisz przekierować zmiennej superglobalnej $_SERVER.
        $_SERVER['REMOTE_ADDR'] = '192.168.1.1';
        $ip = $this->sensor->addrIp();
        $this->assertEquals('192.168.1.1', $ip);
    }

    public function testBrowser(): void {
        // Testowanie metody browser
        // Aby przetestować tę metodę, musisz przekierować zmiennej superglobalnej $_SERVER.
        $_SERVER['HTTP_USER_AGENT'] = 'Test User Agent';
        $userAgent = $this->sensor->browser();
        $this->assertEquals('Test User Agent', $userAgent);
    }

    public function testSystem(): void {
        // Testowanie metody system
        $system = $this->sensor->system();
        // Asercja, że wynik jest niepusty
        $this->assertNotEmpty($system);
    }

    public function testGenFingerprint(): void {
        // Testowanie metody genFingerprint
        $fingerprint = $this->sensor->genFingerprint(9);
        // Asercja, że wynik ma długość 9
        $this->assertEquals(9, strlen($fingerprint));
    }
}
?>