<?php
include('includes/connection.php');

$password=password_hash("abc123",PASSWORD_DEFAULT);
echo $password;

?>