<?php session_start();

$email = $_SESSION['email'];
$currentUser = $email . ".json";
$userString = file_get_contents("file_system/users/".$currentUser);
$userObject = json_decode($userString);

$userObject->logindate = date("y/m/d h:i:s");

unlink("file_system/users/".$currentUser);
                        
file_put_contents("file_system/users/". $email . ".json", json_encode($userObject));
                       
session_unset();
session_destroy();

header("Location: login.php");

?>