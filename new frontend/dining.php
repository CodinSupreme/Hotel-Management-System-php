<?php
// dining.php
session_start();
include "database.php";// ✅ your existing connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!$input) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid JSON data"]);
        exit;
    }

    // Extract the data from JSON
    $room_id = $input['id'] ?? null;
    $service = $input['service'] ?? null;
    $payment_method = $input['payment'] ?? null;
    $total_price = $input['price'] ?? null;
    $days = $input['days'] ?? 1;
    $user_id = $_SESSION['user_id'] ?? null;

    // You can calculate check-in and check-out dates here
    $check_in = date('Y-m-d');
    $check_out = date('Y-m-d', strtotime("+$days days"));

    // Example: guests default to 1, status to "Pending"
    $guests = 1;
    $status = "Pending";

    // Validate required data
    if (!$user_id || !$room_id || !$total_price || !$payment_method) {
        http_response_code(400);
        echo json_encode(["error" => "Missing required fields"]);
        exit;
    }

    // Call your function
    $msg = createBooking($user_id, $room_id, $check_in, $check_out, $guests, $total_price, $status);

    // Return JSON response
    if ($msg === true) {
        echo json_encode(["success" => "✅ Room booked successfully!"]);
    } else {
        echo json_encode(["error" => "❌ Booking failed: $msg"]);
    }
}

// ✅ Handle logout request
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: accomodation.php");
    exit();
}

include "dining.html";
?>

