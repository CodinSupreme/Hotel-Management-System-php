<?php
// book.php - Simple booking page
session_start();
include 'database_connection.php';
include 'functions.php';

// Get room details
$room_id = $_GET['room_id'];
$room = getRoomById($room_id);

if ($_POST) {
    // Create booking using your existing function
    $result = createBooking(
        $_SESSION['user_id'],
        $_POST['room_id'],
        $_POST['check_in'],
        $_POST['check_out'],
        $_POST['guests'],
        $_POST['total_price'],
        'confirmed'
    );
    
    header('Location: index.php?message=Booking confirmed!');
    exit;
}
?>

<!-- Simple booking form -->
<!DOCTYPE html>
<html>
<head>
    <title>Book Room - Haven Hub Hotels</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Book <?php echo $room['room_type']; ?></h1>
    <form method="POST">
        <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
        <input type="date" name="check_in" required>
        <input type="date" name="check_out" required>
        <input type="number" name="guests" min="1" max="<?php echo $room['max_occupation']; ?>" required>
        <button type="submit">Book Now</button>
    </form>
</body>
</html>