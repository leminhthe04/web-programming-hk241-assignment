<?php

function setStatusCodeAndEchoJson($code, $msg, $data) {
    http_response_code($code);
    echo json_encode([
        'status' => $code,
        'msg' => $msg,
        'data' => $data
    ]);
}

function getAllRecords($conn, $table_name) {
    $result = $conn->query("SELECT * FROM $table_name");
    $records = [];
    while ($row = $result->fetch_assoc()) {
        $row['id'] = (int) $row['id'];
        $records[] = $row;
    }
    return $records;
}



function getRecordById($conn, $table_name, $id) {
    $selectQuery = "SELECT * FROM $table_name WHERE id = ?";
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

function isUniqueAttribute($conn, $table_name, $attr_name, $attr_value, $id=null) {
    $checkQuery = "SELECT * FROM $table_name WHERE $attr_name = ?";
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


function getNewlyInsertedRecord($conn, $table_name) {

    $id = $conn->insert_id; // Retrieve the last inserted ID
    return getRecordById($conn, $table_name, $id);
}




function getRecordByUniqueAttr($conn, $table_name, $attr_name, $attr_value) {
    if ($attr_name == 'id') {
        return getRecordById($conn, $table_name, $attr_value);
    }

    $selectQuery = "SELECT * FROM $table_name WHERE $attr_name = ?";
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


function deleteRecordById($conn, $table_name, $id) {
    $deleteQuery = "DELETE FROM $table_name WHERE id=?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);
    return $stmt->execute() ? true : false;
}

function deleteRecordByUniqueAttr($conn, $table_name, $attr_name, $attr_value) {
    if ($attr_name == 'id') {
        return deleteRecordById($conn, $table_name, $attr_value);
    }

    $deleteQuery = "DELETE FROM $table_name WHERE $attr_name=?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $attr_value);
    return $stmt->execute() ? true : false;

}

function deleteAllRecords($conn, $table_name) {
    $deleteQuery = "DELETE FROM $table_name";
    $stmt = $conn->prepare($deleteQuery);
    return $stmt->execute() ? true : false;
}

?>