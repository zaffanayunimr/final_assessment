<?php

//declare
 $hostname = "localhost";
 $username = "root";
 $password = "";
 $database = "student-grading";

 $conn = new mysqli('localhost', 'root', '', 'student-grading', 3306);

 if ($conn -> connect_error)
    die("Connection failed: " . $conn->connect_error);

?>
