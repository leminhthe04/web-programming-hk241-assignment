<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'lemin'); 
define('DB_PASS', 'ehtEhtmysqlazzA04%'); 
define('DB_NAME', 'prismora'); 

header('Content-Type: text/html; charset=UTF-8');

// singleton pattern
class Database {
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (self::$conn->connect_error) {
                die("Connection failed: " . self::$conn->connect_error);
            }
            self::$conn->set_charset("utf8mb4");
            // echo "Connected successfullyyyyyyy<br>";
        }
        return self::$conn;
    }
}

?>