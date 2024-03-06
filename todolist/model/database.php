<?php
//Set up the server
$dsn ="mysql:host=localhost; dbname = todolist";
$username = 'root';
$password = 'password1';

// Connect to the first database
$conn1 = mysqli_connect($host, $username, $password, "todolist");
if (!$conn1) {
    echo "Could not connect to todolist: " . mysqli_error($conn1);
}

// Connect to the second database
$conn2 = mysqli_connect($host, $username, $password, "category");
if (!$conn2) {
    echo "Could not connect to category: " . mysqli_error($conn2);
}
?>
 