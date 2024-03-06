<?php
try{
$db= new PDO($dsn, $username, $password);
}
catch (PDOException){
$error_message = 'Database Error'
$error_message = $e->getMessage();
echo $error_message;
exit();
}
?>