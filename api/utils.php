function setStatusCodeAndEchoJson($code, $msg, $data) {
    http_response_code($code);
    echo json_encode([
        'status' => $code,
        'msg' => $msg,
        'data' => $data
    ]);
}

function isUnique($conn, $attr_name, $attr_value) {
    $checkQuery = "SELECT * FROM users WHERE ? = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $attr_name, $attr_value);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows == 0;
}