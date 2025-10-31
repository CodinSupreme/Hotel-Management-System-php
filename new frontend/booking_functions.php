<?php
// booking_functions.php

// Function to check if user is logged in and handle redirect
function checkBookingAuth() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Type']) && $_POST['Type'] == 'book_room') {
        if (!isset($_SESSION['user'])) {
            header("Location: forms.php");
            exit();
        }
    }
}

// Function to get login status HTML for navigation
function getLoginStatusHTML() {
    if (isset($_SESSION['user'])) {
        return '
            <li><span style="color: var(--primary); padding: 8px 16px; font-weight: bold;">Welcome, ' . htmlspecialchars($_SESSION['user']) . '</span></li>
            <li><a href="accomodation.php?logout=true" class="btn btn-primary">Logout</a></li>
        ';
    } else {
        return '<li><a href="forms.php" class="btn btn-primary">Login</a></li>';
    }
}

// Function to get JavaScript for booking handling
function getBookingJS() {
    ob_start();
    ?>
    <script>
    function bookRoom(roomId, price) {
        <?php if (!isset($_SESSION['user'])): ?>
            if(confirm('You need to login to book a room. Redirect to login page?')) {
                window.location.href = 'forms.php';
                return;
            }
        <?php else: ?>
            selectedPrice = parseFloat(price);
            selectedRoomId = roomId;
            
            document.getElementById('room_id').value = roomId;
            document.getElementById('payment-popup').style.display = 'flex';
            document.getElementById('payment-popup').setAttribute('aria-hidden','false');
            
            // Reset form
            document.getElementById('days').value = '';
            document.getElementById('payment-summary').innerHTML = '';
            document.getElementById('payment-methods').style.display = 'none';
            document.getElementById('book-button').style.display = 'none';
        <?php endif; ?>
    }
    </script>
    <?php
    return ob_get_clean();
}

// Function to get booking form HTML
function getBookingFormHTML() {
    return '
    <!-- Booking Form Popup -->
    <div id="payment-popup" class="popup" aria-hidden="true">
        <div class="popup-content">
            <form id="booking-form" method="POST">
                <input type="hidden" name="Type" value="book_room">
                <input type="hidden" id="room_id" name="room_id">
                <input type="hidden" id="total_price" name="total_price">
                <input type="hidden" id="payment_method" name="payment_method">
                
                <h3>Book Your Room</h3>
                <div class="form-group">
                    <label for="days">Number of Days:</label>
                    <input type="number" id="days" name="days" placeholder="Days" min="1" required>
                </div>
                
                <button type="button" onclick="calculatePayment()">Calculate Total</button>
                
                <div id="payment-summary" class="payment-summary"></div>
                
                <div id="payment-methods" style="display:none;">
                    <p>Select Payment Method:</p>
                    <button type="button" class="payment-method" onclick="choosePaymentMethod(\'Mpesa\')">Mpesa</button>
                    <button type="button" class="payment-method" onclick="choosePaymentMethod(\'Bank Transfer\')">Bank Transfer</button>
                </div>
                
                <div id="book-button" style="display:none; margin-top: 1rem;">
                    <button type="submit" class="btn-primary">Confirm Booking</button>
                </div>
            </form>
        </div>
    </div>';
}
?>