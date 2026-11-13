<?php

$allowedOrigin = "https://therestuanians.github.io";

header("Access-Control-Allow-Origin: " . $allowedOrigin);
header("Vary: Origin");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(204);
    exit;
}

require_once "db.php";

try {

    $stmt = $pdo->query(
        "SELECT ID, Name FROM names ORDER BY ID ASC"
    );

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        "error" => "Unable to retrieve names."
    ]);

}

?>