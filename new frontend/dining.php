<?php
// dining.php
session_start();
include "database.php";// ✅ your existing connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode incoming JSON
    $input = json_decode(file_get_contents("php://input"), true);

    // Validate JSON
    if (!$input) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid or empty JSON data"]);
        exit;
    }

    // Extract the data from JSON
    $service_id       = $input['id'] ?? null;
    $service_type     = $input['type'] ?? null;          
    $price            = $input['price'] ?? null;
    $payment_method   = $input['payment'] ?? null;
    $selected_service = $input['service'] ?? null;        
    $quantity         = $input['quantity'] ?? 1;          
    $user_id          = $_SESSION['user_id'] ?? null;

    // Validate required data
    if (!$service_type || !$price || !$selected_service) {
        http_response_code(400);
        echo json_encode(["error" => "Missing required fields"]);
        exit;
    }

    // Construct the service data
    $service_name = ucfirst($service_type) . " Service"; 
    $description  = "Service ID: $selected_service | Type: $service_type | Quantity: $quantity";

    // Call the database function
    $success = createService($service_name, $description, $price);

    // Respond with JSON
    if ($success) {
        echo json_encode(["success" => "✅ Service recorded successfully!"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "❌ Failed to record service."]);
    }

} else {
    // Reject non-POST requests
    http_response_code(405);
    echo json_encode(["error" => "Only POST requests are allowed"]);
}

// ✅ Handle logout request
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: accomodation.php");
    exit();
}

include "dining.html";
?>

