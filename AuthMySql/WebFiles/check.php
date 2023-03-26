<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gtlauncher";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id']) && isset($_GET['username']) && isset($_GET['password'])) {
    $id = $_GET['id'];
    $username = $_GET['username'];
    $password = $_GET['password'];

    $sql = "SELECT * FROM users WHERE id = '$id' AND username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "done";
    } else {
        echo "not";
    }
}
?>
