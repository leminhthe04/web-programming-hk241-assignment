<?php
require_once __DIR__ . '/../database/database.php';

class Util {

    public static function setStatusCodeAndEchoJson($code, $msg, $data) {
        http_response_code($code);
        echo json_encode([
            'status' => $code,
            'msg' => $msg,
            'data' => $data
        ], JSON_UNESCAPED_UNICODE);
    }


    public static function getResponseArray($code, $msg, $data) {
        return [
            'code' => $code,
            'message' => $msg,
            'data' => $data
        ];
    }


    // convert a query result to an associative array (2D-array)
    public static function fetch($sqlTable){
        $res = [];
        if (!$sqlTable || $sqlTable->num_rows == 0) {
            return $res;
        }
        while ($row = $sqlTable->fetch_assoc()) {
            $res[] = $row;
        }
        return $res;
    }


    public static function getPageCount($tableName, $limit){

        $conn = Database::connect();

        $conn->query("SET @page_count = 0");
        $stmt = $conn->prepare("CALL getPageCount(?, ?, @page_count)");
        $stmt->bind_param("si", $tableName, $limit);
        $stmt->execute();
        $stmt->close();

        $result = $conn->query("SELECT @page_count AS page_count");
        return $result->fetch_assoc()['page_count'];
    }

    public static function getPageCountByField($tableName, $field, $value, $limit){

        $conn = Database::connect();

        $conn->query("SET @page_count = 0");
        $stmt = $conn->prepare("CALL getPageCountByField(?, ?, ?, ?, @page_count)");
        $stmt->bind_param("sssi", $tableName, $field, $value, $limit);
        $stmt->execute();
        $stmt->close();

        $result = $conn->query("SELECT @page_count AS page_count");
        return $result->fetch_assoc()['page_count'];
    }
}

?>