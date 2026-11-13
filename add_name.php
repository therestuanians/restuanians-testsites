<?php

$allowedOrigin = "https://therestuanians.github.io";

header("Access-Control-Allow-Origin: " . $allowedOrigin);
header("Vary: Origin");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(204);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit(json_encode(["error" => "POST required"]));
}

require_once "db.php";

$data = json_decode(file_get_contents("php://input"), true);
$name = trim($data["Name"] ?? "");

if ($name === "" || mb_strlen($name) > 100) {
    http_response_code(400);
    exit(json_encode(["error" => "Invalid name"]));
}

try {

    $stmt = $pdo->prepare(
        "INSERT INTO names (Name) VALUES (?)"
    );

    $stmt->execute([$name]);

    echo json_encode([
        "success" => true,
        "message" => "Name added successfully!"
    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        "error" => "Unable to save name."
    ]);

}

?>