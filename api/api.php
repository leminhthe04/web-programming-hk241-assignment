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
    if (isset($_GET['id'])) { // get by id
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM users WHERE id=$id");
        

        if ($result->num_rows == 0) {
            setStatusCodeAndEchoJson(200, "User not found", null);
            return;
        }
        
        setStatusCodeAndEchoJson(200, "User found", $result->fetch_assoc());
        return;
    }

    // get all users
    $result = $conn->query("SELECT * FROM users");
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    if (count($users) == 0) {
        setStatusCodeAndEchoJson(200, "There are no users", null);
        return;
    }
    setStatusCodeAndEchoJson(200, "Found all users in system", $users);
}


function handlePOST($conn, $input){
    $username   = $input['username'];
    $pw_hash    = password_hash($input['password'], PASSWORD_DEFAULT);
    $lname      = $input['lname'];
    $fname      = $input['fname'];
    $phone      = $input['phone'];
    $email      = $input['email'];
    $gender     = $input['gender'];
    $type       = $input['type'];
    $dob        = $input['birthday'];

    $id = hash('sha256', $username . $pw_hash . $email . $phone . $dob);

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
        $insertQuery = "INSERT INTO users (id, username, password, lname, fname, email, phone, gender, type, birthday) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssssssssss", $id, $username, $pw_hash, $lname, $fname, $email, $phone, $gender, $type, $dob);
        
        if (!$stmt->execute()) {
            throw new Exception("Database error: " . $stmt->error);
        }

        setStatusCodeAndEchoJson(201, "POST successfully", $stmt->get_result()->fetch_assoc());        
    
    } catch (Exception $e) {
        setStatusCodeAndEchoJson(400, "POST failed", $e->getMessage());
    }
}



function handlePUT($conn, $input) {
    // $id = $input['id'];
    // $username = $input['username'];
    // $pw_hash = password_hash($input['password'], PASSWORD_DEFAULT);
    // $lname = $input['lname'];
    // $fname = $input['fname'];
    // $phone = $input['phone'];
    // $email = $input['email'];
    // $gender


    $id = $_GET['id'];
        $name = $input['name'];
        $email = $input['email'];
        $age = $input['age'];
        $conn->query("UPDATE users SET name='$name',
                     email='$email', age=$age WHERE id=$id");
        echo json_encode(["message" => "User updated successfully"]);
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
