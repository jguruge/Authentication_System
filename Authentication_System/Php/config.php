<?php
$servername = "127.0.0.1";
$port = "3307";
$username = "root";
$password = "";
$dbname = "Authentication_php";

try {
    $pdo = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'Connection Succefull';
} 
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

