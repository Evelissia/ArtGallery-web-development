<?php
    $servername = "localhost";
    $username = "vika";
    $password = "11111";
    $database = "gallery";
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Соединение не удалось: " . mysqli_connect_error());
    }
?>