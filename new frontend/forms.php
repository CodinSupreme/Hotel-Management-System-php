<?php 
session_start();
include "database.php";

$loginmessage = "";
$registermessage = "";
$forgotmessage = "";
//calls this after user has submitted (login/registration/forgot) credentials
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Executes this if user has entered credentials in the login form
    if($_POST['Type'] == 'login'){
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $user = loginUser($email, $password);
        
        if ($user !== null) {
            $loginmessage = "<p style='color: lime; text-align:center; font-weight:bold; margin-bottom:15px;'>✅ Login successful! Welcome back, $email.</p>";
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username']; // or name/email
            $_SESSION['logged_in'] = true;
            
            header("Location: index.php");
            exit(); 
        } else {
            $loginmessage = "<p style='color: red; text-align:center; font-weight:bold; margin-bottom:15px;'>❌ Invalid email or password. Try again!</p>";
        }
    }
    //Executes this if user has entered credentials in the registration form
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
            header("Location: forms.php");
        } else {
            $registermessage = "<p style='color: red; text-align:center; font-weight:bold; margin-bottom:15px;'>❌ Credentials already exist. $msg</p>";
        }
    }
    //Executes this if user has entered credentials in the forgot_password form
    else{
         if ($_POST['id_no'] !== null) {
            $forgotmessage = "<p style='color: lime; text-align:center; font-weight:bold; margin-bottom:15px;'>✅ changes successful! Welcome back, $email.</p>";
        } 
    }
}

include 'login.html';
?>