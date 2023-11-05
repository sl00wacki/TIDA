<?php
class DataBaseConn{
    
    var $host = "localhost";   
    var $user = "root";
    var $pass = "";
    var $database = "database1";

    function DatabaseConn($host, $username, $password, $database) {
        try {
            $dsn = "mysql:host=$host;dbname=$database";
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Błąd połączenia z bazą danych: " . $e->getMessage());
        }
    }

    function put($pdo, $table, $data) {
        try {
            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));
            $query = "INSERT INTO $table ($columns) VALUES ($values)";
            $statement = $pdo->prepare($query);
            $statement->execute($data);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    function update($pdo, $table, $data, $condition) {
        try {
            $setClause = '';
            foreach ($data as $key => $value) {
                $setClause .= "$key = :$key, ";
            }
            $setClause = rtrim($setClause, ', ');
            
            $query = "UPDATE $table SET $setClause WHERE $condition";
            $statement = $pdo->prepare($query);
            $statement->execute($data);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    function delete($pdo, $table, $condition) {
        try {
            $query = "DELETE FROM $table WHERE $condition";
            $statement = $pdo->prepare($query);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    function get($pdo, $table, $condition = '') {
        try {
            $query = "SELECT * FROM $table $condition";
            $statement = $pdo->query($query);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>

?>