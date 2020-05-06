<?php
include_once('lib/header.php');
require_once('functions/redirect.php');
require_once('functions/alert.php');
require_once('functions/user.php');

if(!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== "Player"){
    // redirect to login
    redirect_to('login.php');
}
?>

<?php 

if(isset($_GET['txref'])){
    $txref = $_GET['txref'];

    $userData = json_decode($_SESSION['userObject']);
    $date = (date("y-m-d",time()));
    $time = (date("h:i A",time()));
    $amount = 2000;
    $email = $_SESSION['email'];

    //create payment object
    $payment = [
        'date'=>$date,
        'time'=>$time,
        'amount'=>$amount,
        'txref'=>$txref,
        'email'=>$userData->email,
        'fullname'=>$userData->first_name . " " . $userData->last_name
    ];

    //save payment to file system
    save_payment($payment);

    //fetch and update user payment status in appointmnt
    $currentUser = $email . ".json";
    $userString = file_get_contents("file_system/appointments/".$currentUser);
    $userObject = json_decode($userString);
    $userObject->payment = "Paid";
    unlink("file_system/appointments/".$currentUser);
    file_put_contents("file_system/appointments/". $email . ".json", json_encode($userObject));
    
    //send confirmation mail to user
    $subject = "Payment successfull";
    $message = "Your payment was successful! You paid NGN 2000 for your appointment";
    send_payment_mail($subject,$message,$email);

    //redicte to dashboard with success message
    $_SESSION["message"] = "Your payment is succussfully done, thank you.";
    redirect_to("player_dashboard.php");
    exit();
}


?>

<?php
include_once('lib/footer.php');
?>