<?php
require_once __DIR__ . '/auth.php';
require_login();

include "db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

$id = $_POST['delete'];

$sql = $conn->prepare("DELETE FROM results where id = $id");

if ($sql->execute()) {
    header("Location: index.php");
    exit ();
}
}

?>
