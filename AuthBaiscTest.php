<?php
require './app/lib/AuthBasic.php'; // Ścieżka do pliku z klasą AuthBasic

use PHPUnit\Framework\TestCase;

class AuthBasicTest extends TestCase {
    private $auth;

    protected function setUp(): void {
        parent::setUp();
        $this->auth = new AuthBasic();
    }

    protected function tearDown(): void {
        parent::tearDown();
        $this->auth = null;
    }

    public function testGenFingerprint(): void {
        // Testowanie metody genFingerprint
        $result = $this->auth->genFingerprint('md5');
        // Asercja, że wynik nie jest pusty
        $this->assertNotEmpty($result);
    }

    public function testCreateCode(): void {
        // Testowanie metody createCode
        $result = $this->auth->createCode();
        // Asercja, że wynik ma oczekiwaną długość (domyślnie 6)
        $this->assertEquals(6, strlen($result));
    }

    public function testCreateAuthToken(): void {
        // Testowanie metody createAuthToken
        $email = 'test@example.com';
        $id = 123;
        $result = $this->auth->createAuthToken($email, $id);
        // Asercje, że wyniki są zgodne z oczekiwaniami
        $this->assertIsString($result['authCode']);
        $this->assertEquals($email, $result['email']);
        $this->assertEquals($id, $result['id']);
    }

    public function testCompAuthCode(): void {
        // Ustawienie wartości authCode
        $this->auth->authCode = '123456';
        // Testowanie metody compAuthCode z prawidłowym kodem
        $result1 = $this->auth->compAuthCode('123456');
        // Testowanie metody compAuthCode z nieprawidłowym kodem
        $result2 = $this->auth->compAuthCode('654321');

        $this->assertTrue($result1);
        $this->assertFalse($result2);
    }

    public function testDoAuthByEmail(): void {
        // Ustawienie wartości email i id
        $this->auth->email = 'test@example.com';
        $this->auth->id = 123;
        // Testowanie metody doAuthByEmail z poprawnymi danymi
        $result1 = $this->auth->doAuthByEmail('test@example.com', 123);
        // Testowanie metody doAuthByEmail z niepoprawnymi danymi
        $result2 = $this->auth->doAuthByEmail('wrong@example.com', 456);

        $this->assertTrue($result1);
        $this->assertFalse($result2);
    }

    // Dodaj kolejne testy dla pozostałych metod klasy AuthBasic
}
?>