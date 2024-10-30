<?php

function setStatusCodeAndEchoJson($code, $msg, $data) {
    http_response_code($code);
    echo json_encode([
        'status' => $code,
        'msg' => $msg,
        'data' => $data
    ]);
}


function isUniqueAttribute($conn, $attr_name, $attr_value, $id=null) {
    $checkQuery = "SELECT * FROM users WHERE $attr_name = ?";
    // If id is provided, exclude it from the check to excess record itself
    if ($id) {
        $checkQuery .= " AND id != ?";
    }
    $stmt = $conn->prepare($checkQuery);
    $id ? $stmt->bind_param("si", $attr_value, $id) : $stmt->bind_param("s", $attr_value);
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


function getRecordByUniqueAttr($conn, $attr_name, $attr_value) {
    if ($attr_name == 'id') {
        return getRecordById($conn, $attr_value);
    }

    $selectQuery = "SELECT * FROM users WHERE $attr_name = ?";
    $selectStmt = $conn->prepare($selectQuery);
    $selectStmt->bind_param("s", $attr_value);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    if ($result->num_rows == 0) {
        return null;
    }
    $record = $result->fetch_assoc();
    return $record;
}

?>