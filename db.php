<?php

$host = "sql102.infinityfree.com";
$dbname = "if0_43433682_restuatest";
$username = "if0_43433682";
$password = "Teammates1943";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

} catch (PDOException $e) {

    die("Database connection failed: " . $e->getMessage());

}

?>
