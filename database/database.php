

<?php
// functions.php
include 'database_connection.php';  // include connection

// ================= CREATE USER ==================
function createUser($email, $password, $username, $contact, $gender, $salary, $role, $service_id, $id_no) {
    global $pdo;

    // Hash password before saving (secure!)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO app_customuser (email, password, username, contact, gender, salary, role, service_id, id_no, 
                is_active, is_staff, is_superuser, first_name, last_name, date_joined)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, true, false, false, '', '', NOW())";

    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$email, $hashed_password, $username, $contact, $gender, $salary, $role, $service_id, $id_no]);
        return "✅ User created successfully!";
    } catch (PDOException $e) {
        return "❌ Error creating user: " . $e->getMessage();
    }
}

// ================= GET USER BY EMAIL ==================
function getUserByEmail($email) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM app_customuser WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user ?: null;
}

// ================= GET ALL USERS ==================
function getAllUsers() {
    global $pdo;

    $stmt = $pdo->query("SELECT id, email, username, contact, gender, role, salary, id_no, service_id FROM app_customuser");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ================= DELETE USER ==================
function deleteUser($user_id) {
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM app_customuser WHERE id = ?");
    try {
        $stmt->execute([$user_id]);
        return "🗑️ User deleted successfully!";
    } catch (PDOException $e) {
        return "❌ Error deleting user: " . $e->getMessage();
    }
}

// ================= LOGIN VALIDATION ==================
function loginUser($email, $password) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM app_customuser WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user; // success
    } else {
        return null;  // invalid login
    }
}

// ================== SERVICE TABLE =====================
function createService($service_name, $description, $price) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Service (service_name, service_description, service_price) VALUES (?, ?, ?)");
    return $stmt->execute([$service_name, $description, $price]);
}

function getAllServices() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM Service");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateService($id, $name, $description, $price) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE Service SET service_name=?, service_description=?, service_price=? WHERE service_id=?");
    return $stmt->execute([$name, $description, $price, $id]);
}

function deleteService($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM Service WHERE service_id=?");
    return $stmt->execute([$id]);
}

// ================== ROOM TABLE =====================
function createRoom($room_type, $bed_type, $price, $availability, $max_occupation) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Room (room_type, bed_type, price_per_night, availabilty_status, max_occupation)
                           VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$room_type, $bed_type, $price, $availability, $max_occupation]);
}

function getAllRooms() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM Room");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ================== BOOKING TABLE =====================
function createBooking($user_id, $room_id, $check_in, $check_out, $guests, $total, $status) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Booking (user_id, room_id, check_in_date, check_out_date, number_of_guests, total_price, booking_status)
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$user_id, $room_id, $check_in, $check_out, $guests, $total, $status]);
}

function getBookings() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM Booking");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ================== PAYMENT TABLE =====================
function createPayment($user_id, $booking_id, $service_id, $amount, $mode, $account, $status) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO payment (user_id, booking_id, service_id, amount, payment_mode, account, payment_status)
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$user_id, $booking_id, $service_id, $amount, $mode, $account, $status]);
}

function getAllPayments() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM payment");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ================== INVENTORY TABLE =====================
function createInventory($item_name, $category, $service_time, $desc, $quantity, $price) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Inventory (item_name, category, service_time, item_description, quantity, price_per_unit)
                           VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$item_name, $category, $service_time, $desc, $quantity, $price]);
}

function getAllInventoryItems() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM Inventory");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
