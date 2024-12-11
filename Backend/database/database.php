<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'lemin'); 
define('DB_PASS', 'ehtEhtmysqlazzA04%'); 
define('DB_NAME', 'prismora'); 
define('DB_PORT', '3306');

// define('DB_HOST', 'mysql-service-btl-cnpm.f.aivencloud.com');
// define('DB_USER', 'avnadmin'); 
// define('DB_PASS', 'AVNS_EGkAPz8AzV68D2Xg-p0'); 
// define('DB_NAME', 'prismora'); 
// define('DB_PORT', '12567');

header('Content-Type: text/html; charset=UTF-8');


// singleton pattern
class Database {
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

            if (self::$conn->connect_error) {
                die("Connection failed: " . self::$conn->connect_error);
            }
            self::$conn->set_charset("utf8mb4");
            // echo "Connected successfullyyyyyyy<br>";
        }
        return self::$conn;
    }
}


// $conn = Database::connect();
?>