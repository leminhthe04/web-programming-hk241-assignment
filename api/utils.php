<?php

function setStatusCodeAndEchoJson($code, $msg, $data) {
    http_response_code($code);
    echo json_encode([
        'status' => $code,
        'msg' => $msg,
        'data' => $data
    ]);
}


function isUnique($conn, $attr_name, $attr_value) {
    $checkQuery = "SELECT * FROM users WHERE $attr_name = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $attr_value);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows == 0;
}


function getNewlyInsertedRecord($conn) {

    $id = $conn->insert_id; // Retrieve the last inserted ID
    return getRecordById($conn, $id);
}


function getRecordById($conn, $id) {
    $selectQuery = "SELECT * FROM users WHERE id = ?";
    $selectStmt = $conn->prepare($selectQuery);
    $selectStmt->bind_param("i", $id);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    if ($result->num_rows == 0) {
        return null;
    }
    $record = $result->fetch_assoc();
    return $record;
}

?>