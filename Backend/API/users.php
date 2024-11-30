<?php

include_once 'utils.php';
include_once 'db.php';


header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);


define('TB_NAME', 'users');


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
    $user = null;
    if (isset($_REQUEST['id'])) { // get by id
        $id = $_REQUEST['id'];
        $user = getRecordById($conn, TB_NAME, $id);
        
        if (!$user) {
            setStatusCodeAndEchoJson(200, "There are no user have id=$id", null);
            return;
        }
    } else if (isset($_REQUEST['username'])) { // get by username
        $username = $_REQUEST['username'];
        $user = getRecordByUniqueAttr($conn, TB_NAME, 'username', $username);
        
        if (!$user) {
            setStatusCodeAndEchoJson(200, "There are no user have username=$username", null);
            return;
        }
    }

    if ($user){
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
        if(!isUniqueAttribute($conn, TB_NAME, 'username', $username)){
            setStatusCodeAndEchoJson(409, "POST failed. Username already exists", null);
            return;
        }
        if(!isUniqueAttribute($conn, TB_NAME, 'email', $email)){
            setStatusCodeAndEchoJson(409, "POST failed. Email already exists", null);
            return;
        }
        if(!isUniqueAttribute($conn, TB_NAME, 'phone', $phone)){
            setStatusCodeAndEchoJson(409, "POST failed. Phone already exists", null);
            return;
        }

        // Proceed with the insertion if unique
        $insertQuery = "INSERT INTO " . TB_NAME .  " (username, 
                                            password, 
                                            lname, 
                                            fname, 
                                            email, 
                                            phone, 
                                            gender, 
                                            type, 
                                            birthday
                                           ) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssssssss", 
                            $username, 
                            $pw_hash, 
                            $lname, 
                            $fname, 
                            $email, 
                            $phone, 
                            $gender, 
                            $type, 
                            $dob
                        );
        
        $isInserted = $stmt->execute();
        if (!$isInserted) {
            throw new Exception("Database error: " . $stmt->error);
        }


        $newUser = getNewlyInsertedRecord($conn, TB_NAME);
        setStatusCodeAndEchoJson(201, "POST successfully", $newUser);        
        
    } catch (Exception $e) {
        setStatusCodeAndEchoJson(400, "Exception: POST failed", $e->getMessage());
    }
}



function handlePUT($conn, $input) { // update

    $id = null;
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        // Check existing user has id
        if(!getRecordById($conn, $id)){
            setStatusCodeAndEchoJson(404, "There are no user have id=$id", null);
            return;
        }
    } else if (isset($_REQUEST['username'])){
        $username = $_REQUEST['username'];
        // Check existing user has username
        $user = getRecordByUniqueAttr($conn, TB_NAME, 'username', $username);
        if(!$user){
            setStatusCodeAndEchoJson(404, "There are no user have username=$username", null);
            return;
        }
        $id = $user['id'];
    }

    // new data
    include 'get_users_fields.php';


    // Check if (new) email or phone is not unique
    if(!isUniqueAttribute($conn, TB_NAME, 'email', $email, $id)){
        setStatusCodeAndEchoJson(409, "PUT failed. This new email is used for another account", null);
        return;
    }
    if(!isUniqueAttribute($conn, TB_NAME, 'phone', $phone, $id)){
        setStatusCodeAndEchoJson(409, "PUT failed. This new phone is used for another account", null);
        return;
    }


    $updateQuery = "UPDATE " . TB_NAME . " SET 
                                username=?, 
                                password=?, 
                                lname=?, 
                                fname=?, 
                                email=?, 
                                phone=?, 
                                gender=?, 
                                type=?, 
                                birthday=? 
                    WHERE id=?"
                    ;
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssssssi", 
                        $username, 
                        $pw_hash, 
                        $lname, 
                        $fname, 
                        $email, 
                        $phone, 
                        $gender, 
                        $type, 
                        $dob, 
                        $id
                    );
    if(!$stmt->execute()){
        setStatusCodeAndEchoJson(400, "PUT failed", null);
        return;
    }

    $newUser = getRecordById($conn, TB_NAME, $id);
    setStatusCodeAndEchoJson(200, "Change info. successfully", $newUser);
}


function handleDELETE($conn) {
    
    if(isset($__REQUEST['delAll'])){
        deleteAllRecords($conn, TB_NAME);
        return;
    }

    $id = null;
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        // Check existing user has id
        if(!getRecordById($conn, TB_NAME, $id)){
            setStatusCodeAndEchoJson(404, "There are no user have id=$id", null);
            return;
        }
    } else if (isset($_REQUEST['username'])){
        $username = $_REQUEST['username'];
        // Check existing user has username
        $user = getRecordByUniqueAttr($conn, TB_NAME, 'username', $username);
        if(!$user){
            setStatusCodeAndEchoJson(404, "There are no user have username=$username", null);
            return;
        }
        $id = $user['id'];
    }

    if(!deleteRecordById($conn, TB_NAME, $id)){
        setStatusCodeAndEchoJson(400, "Exception: DELETE failed", null);
        return;    
    }

    $users = getAllRecords($conn, TB_NAME) ?? null;
    setStatusCodeAndEchoJson(200, "DELETE successfully", $users);
}


$conn->close();

?>
