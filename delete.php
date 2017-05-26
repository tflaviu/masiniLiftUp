<?php

include_once "./functions/connect.php";
$id = $_GET['id'];
$db = dbConnect();
$sql = "DELETE FROM `cars` WHERE CarID = '$id'";

if ($db->query($sql) === TRUE) {
    echo "Record deleted!";
} else {
    echo "Erroor deleting record!";
}
header('Location: admin.php');

