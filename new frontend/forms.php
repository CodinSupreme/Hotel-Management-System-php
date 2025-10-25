<?php 
include "database.php";

$loginmessage = "";
$registermessage = "";
$forgotmessage = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['Type'] == 'login'){
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        if (loginUser($email, $password) !== null) {
            $loginmessage = "<p style='color: lime; text-align:center; font-weight:bold; margin-bottom:15px;'>✅ Login successful! Welcome back, $email.</p>";
            header("Location: /phpinfo.php");
        } else {
            $loginmessage = "<p style='color: red; text-align:center; font-weight:bold; margin-bottom:15px;'>❌ Invalid email or password. Try again!</p>";
        }
    }
    elseif($_POST['Type'] == 'register'){
        $email = trim($_POST['email']);
        $password = trim($_POST["password"]);
        $first_name = trim($_POST['first_name']);
        $last_name = trim( $_POST['last_name']);
        $contact = trim($_POST['contact']);
        $gender = trim($_POST['gender']);
        $id_no = trim($_POST['id_no']);
        $msg = createUser($email, $password, $first_name, $last_name, $contact, $gender, $id_no);
        if ($msg === true) {
            $registermessage = "<p style='color: lime; text-align:center; font-weight:bold; margin-bottom:15px;'>✅ Registration successful! Welcome back, $email.</p>";
            header("Location: /phpinfo.php");
        } else {
            $registermessage = "<p style='color: red; text-align:center; font-weight:bold; margin-bottom:15px;'>❌ Credentials already exist. $msg</p>";
        }
    }
    else{
         if ($_POST['id_no'] !== null) {
            $forgotmessage = "<p style='color: lime; text-align:center; font-weight:bold; margin-bottom:15px;'>✅ changes successful! Welcome back, $email.</p>";
        } 
    }
}

include 'login.html';
?>