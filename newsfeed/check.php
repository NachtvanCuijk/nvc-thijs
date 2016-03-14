<?php
// This file is for the login AJAX functionality
session_start();
require("inc/connection.php");
if (isset($_POST['user'])) {
    $user = $link->real_escape_string($_POST['user']);
} else {
    $user = "";
}
if (isset($_POST['pass'])) {
    $pass = $_POST['pass'];
} else {
    $pass = "";
}
$query = "SELECT
        *
    FROM
        admins
    WHERE
        user='$user'";
$row = $link->query($query)->fetch_array();

// It verifies if the
if ($row && password_verify($pass, $row['password'])) {
    $_SESSION['name'] = $row['name'];
    $response = true;
} else {
    $response = false;
}
exit(json_encode($response));
