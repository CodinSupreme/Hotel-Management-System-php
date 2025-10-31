<?php
session_start();
include "database.php";
include "booking_functions.php"; // Include the new functions file

$bookmessage = "";
$fetchmessage = "";
$paymentmessage = "";

// ✅ Check booking authentication
checkBookingAuth();

// Handle booking or payment actions
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
    /*
    if ($_POST['Type'] == 'book_room') {
        $room_id = trim($_POST['room_id']);
        $client_name = $_SESSION['user'] ?? trim($_POST['client_name']);
        $days = trim($_POST['days']);
        $total_price = trim($_POST['total_price']);
        $payment_method = trim($_POST['payment_method']);

        $msg = createBooking($room_id, $client_name, $days, $total_price, $payment_method);

        if ($msg === true) {
            $bookmessage = "<p style='color: lime; text-align:center; font-weight:bold; margin-bottom:15px;'>✅ Room booked successfully for $client_name.</p>";
            header("Location: success.html");
            exit();
        } else {
            $bookmessage = "<p style='color: red; text-align:center; font-weight:bold; margin-bottom:15px;'>❌ Booking failed: $msg</p>";
        }
    }

    elseif ($_POST['Type'] == 'confirm_payment') {
        $booking_id = trim($_POST['booking_id']);
        $payment_status = trim($_POST['payment_status']);

        $msg = confirmPayment($booking_id, $payment_status);

        if ($msg === true) {
            $paymentmessage = "<p style='color: lime; text-align:center; font-weight:bold; margin-bottom:15px;'>✅ Payment confirmed successfully.</p>";
        } else {
            $paymentmessage = "<p style='color: red; text-align:center; font-weight:bold; margin-bottom:15px;'>❌ Payment confirmation failed: $msg</p>";
        }
    }*/
}

// ✅ Handle logout request
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: accomodation.php");
    exit();
}

// Load the accommodation front-end page
include 'accomodation.html';
?>