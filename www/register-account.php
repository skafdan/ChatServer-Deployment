<?php
$dbhost = "chatserverdb.cd3ixmxbmpj0.us-east-1.rds.amazonaws.com";
$dbport = 3306;
$dbname = "chatserverdb";
$db_username = "admin";
$db_password = "Quack1nce4^";

$username = $_POST['username'];
$password = $_POST['password'];
$salt = sha1($password);

echo($dbhost." ".$db_username." ".$db_password." ".$dbname." ".$dbport."<br>");

$conn = new mysqli($dbhost, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM user WHERE username='$username'";
$result = $conn->query($query);
print_r($result);

if ($result->num_rows > 0) {
            header('Location: register-failed.php');
                exit;
}

$query = "INSERT INTO user VALUES ('$username', '$password', '$salt');";
$result = $conn->query($query);

$conn->close();


header('Location: register-success.php');
?>