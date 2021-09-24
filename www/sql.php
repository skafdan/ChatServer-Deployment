<?php
$dbhost = "chatserverdb.cd3ixmxbmpj0.us-east-1.rds.amazonaws.com";
$dbport = 3306;
$dbname = "chatserverdb";
$db_username = "admin";
$db_password = "Quack1nce4^";

echo($dbhost." ".$db_username." ".$db_password." ".$dbname." ".$dbport."<br>");

$conn = new mysqli($dbhost, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['SQL'])){
        echo($_POST['SQL']."<br>");
        $query = $_POST['SQL'];
        //echo($query."<br>");
        $result = $conn->query($query);
        echo($conn->error."<br>");
        print_r($result);
        echo("<br>");
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                print_r($row);
                echo("<br>");
        }
}
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <form action="sql.php" method="POST">
        <div class="row">
            <div class="four columns">
                <h3>SQL</h3>
            </div>
            <div class="eight columns"><input id="SQL" name="SQL"></div>
        </div>

        <div class="twelve columns"><input type="submit"></div>
    </form>
</body>

</html>