<?php session_start();
require_once('functions/user.php');
require_once('functions/redirect.php');

$userData = json_decode($_SESSION['userObject']);

//Collecting the data
$date = date('y-m-d', strtotime($_POST['date']));
$time = date('h:i', strtotime($_POST['time']));
$noa = $_POST['noa'];
$department = $_POST['department'];
$complaint = $_POST['complaint'];

$appointment = [
    'date'=>$date,
    'time'=>$time,
    'noa'=>$noa,
    'department'=>$department,
    'complaint'=>$complaint,
    'email'=>$userData->email,
    'fullname'=>$userData->first_name . " " . $userData->last_name
];

//save appointment to database
save_appointment($appointment);

$_SESSION["message"] = "Your appointment has been booked succussfully";

redirect_to("player_dashboard.php");
exit();