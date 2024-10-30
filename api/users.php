<?php

include_once 'utils.php';
include_once 'db.php';


header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);


switch ($method) {
    case 'GET':
        handleGET($conn);
        break;

    case 'POST':
        handlePOST($conn, $input);
        break;

    case 'PUT': // update
        handlePUT($conn, $input);
        break;

    case 'DELETE':
        handleDELETE($conn);
        break;

    default:
        echo json_encode(["message" => "Invalid request method"]);
        break;
}


function handleGET($conn) {
    if (isset($_REQUEST['id'])) { // get by id
        $id = $_REQUEST['id'];
        $user = getRecordById($conn, $id);
        

        if (!$result) {
            setStatusCodeAndEchoJson(200, "User not found", null);
            return;
        }
        
        setStatusCodeAndEchoJson(200, "User found", $user);
        return;
    }

    // get all users
    $result = $conn->query("SELECT * FROM users");
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $row['id'] = (int) $row['id'];
        $users[] = $row;
    }

    if (count($users) == 0) {
        setStatusCodeAndEchoJson(200, "There are no users", null);
        return;
    }
    setStatusCodeAndEchoJson(200, "Found all users in system", $users);
}


function handlePOST($conn, $input){

    include 'get_users_fields.php';


    try {
        // Check if username, email, or phone already exists
        $statusCode = null;
        $msg = null;
        
        if(!isUnique($conn, 'username', $username)){
            $statusCode = 409;
            $msg = "POST failed. Username already exists";
        } else if(!isUnique($conn, 'email', $email)){
            $statusCode = 409;
            $msg = "POST failed. Email already exists";
        } else if(!isUnique($conn, 'phone', $phone)){
            $statusCode = 409;
            $msg = "POST failed. Phone already exists";
        }

        if ($statusCode != null) {
            setStatusCodeAndEchoJson($statusCode, $msg, null);
            return;
        }

        // Proceed with the insertion if unique
        $insertQuery = "INSERT INTO users (username, password, lname, fname, email, phone, gender, type, birthday) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssssssss", $username, $pw_hash, $lname, $fname, $email, $phone, $gender, $type, $dob);
        // $result = $stmt->execute();
        // echo 'hehe ', $result;

        
        $isInserted = $stmt->execute();
        if (!$isInserted) {
            throw new Exception("Database error: " . $stmt->error);
        }


        $newUser = getNewlyInsertedRecord($conn);
        setStatusCodeAndEchoJson(201, "POST successfully", $newUser);        
        
    } catch (Exception $e) {
        setStatusCodeAndEchoJson(400, "Exception: POST failed", $e->getMessage());
    }
}



function handlePUT($conn, $input) { // update

    include 'get_users_fields.php';

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        
        $selectQuery = "SELECT * FROM users WHERE id=?";
        $stmt = $conn->prepare($selectQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            setStatusCodeAndEchoJson(404, "User not found", null);
            return;
        }

        $updateQuery = "UPDATE users SET username=?, password=?, lname=?, fname=?, email=?, phone=?, gender=?, type=?, birthday=? WHERE id=?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssssssssi", $username, $pw_hash, $lname, $fname, $email, $phone, $gender, $type, $dob, $id);
        if(!$stmt->execute()){
            setStatusCodeAndEchoJson(400, "PUT failed", null);
            return;
        }

        
        $newUser = getRecordById($conn, $id);
        setStatusCodeAndEchoJson(200, "PUT successfully", $newUser);

    }else if (isset($_REQUEST['username'])){

    }

}


function handleDELETE($conn) {
    // $id = $_GET['id'];
    // $conn->query("DELETE FROM users WHERE id=$id");
    // echo json_encode(["message" => "User deleted successfully"]);
    $id = $_GET['id'];
    $conn->query("DELETE FROM users WHERE id=$id");
    echo json_encode(["message" => "User deleted successfully"]);
    
}


$conn->close();

?>
