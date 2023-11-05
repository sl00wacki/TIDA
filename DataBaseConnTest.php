<?php
require './app/lib/DataBaseConn.php'; // Ścieżka do pliku z klasą DatabaseConn

use PHPUnit\Framework\TestCase;

class DataBaseConnTest extends TestCase {
    private $pdo;

    protected function setUp(): void {
        parent::setUp();

        // Dane do połączenia z bazą testową
        $host = "localhost";
        $username = "test_user";
        $password = "test_password";
        $database = "test_database";

        // Tworzenie połączenia do bazy danych przed każdym testem
        $this->pdo = new DataBaseConn($host, $username, $password, $database);
    }

    protected function tearDown(): void {
        parent::tearDown();

        // Zamykanie połączenia po każdym teście
        $this->pdo = null;
    }

    public function testDatabaseConn(): void {
        // Sprawdź, czy połączenie zostało utworzone poprawnie
        $this->assertInstanceOf(PDO::class, $this->pdo);
    }

    public function testPut(): void {
        $data = array(
            'name' => 'John Doe',
            'email' => 'john@example.com'
        );

        // Wywołaj metodę put
        $result = $this->pdo->put('users', $data);

        // Sprawdź, czy operacja wstawiania danych zwraca true
        $this->assertTrue($result);

        // Możesz dodać dodatkowe asercje, aby sprawdzić, czy dane faktycznie zostały wstawione do bazy
        // i czy możesz je potem pobrać.
    }

    public function testGet(): void {
        // Wywołaj metodę get
        $result = $this->pdo->get('users');

        // Sprawdź, czy operacja pobierania danych zwraca wynik
        $this->assertIsArray($result);

        // Możesz dodać dodatkowe asercje, aby sprawdzić oczekiwany wynik zapytania SELECT.
    }
}
?>