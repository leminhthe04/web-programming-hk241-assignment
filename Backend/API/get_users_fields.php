<?php

$username   = $input['username'];
$pw_hash    = password_hash($input['password'], PASSWORD_DEFAULT);
$lname      = $input['lname'];
$fname      = $input['fname'];
$phone      = $input['phone'];
$email      = $input['email'];
$gender     = $input['gender'];
$type       = $input['type'];
$dob        = $input['birthday'];

?>