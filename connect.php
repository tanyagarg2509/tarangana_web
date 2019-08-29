<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="myformdb";

// Create connection
// $conn = new mysqli($servername, $username, $password);
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

echo "Connected successfully";


// $sql = "CREATE DATABASE myformdb";
// if ($conn->query($sql) === TRUE) {
//     echo "Database created successfully";
// } else {
//     echo "Error creating database: " . $conn->error;
// }

// $sql = "CREATE TABLE tarangana (
// team_name VARCHAR(30)  NOT NULL, 
// team_leader VARCHAR(30) NOT NULL,
// no_of_members INT NOT NULL,
// email VARCHAR(50),
// phone_no VARCHAR(10)
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table tarangana created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }


?>