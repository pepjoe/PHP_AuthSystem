<?php session_start();

require_once('functions/alert.php');
require_once('functions/redirect.php');
require_once('functions/user.php');

$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] :  $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] :  $errorCount++;


if ($email == "admin@bodilyacademy.com") {
  
    $userString = file_get_contents("file_system/admin/admin@bodilyacademy.com.json");

    $userObject = json_decode($userString);
    $passwordFromFileS = $userObject->password;

    if (password_verify($password, $passwordFromFileS)) {

         $_SESSION['fullname'] = $userObject->first_name;
         $_SESSION['loggedIn'] = $userObject->id;

        redirect_to("admin_dashboard.php");
    
    }


    




} else{



$_SESSION['email'] = $email;

if($errorCount > 0){

    $session_error = "You have " . $errorCount . " error";
    
    if($errorCount > 1) {        
        $session_error .= "s";
    }

    $session_error .=   " in your form submission";
    
    set_alert('error',$session_error);
      
    redirect_to("login.php");

}else{
    $currentUser = find_user($email);
    
    if($currentUser){
        //check the user password.
        $userString = file_get_contents("file_system/users/".$currentUser->email . ".json");
        $userObject = json_decode($userString);
        $passwordFromFileS = $userObject->password;
        $passwordFromUser = password_verify($password, $passwordFromFileS);
        
            if($passwordFromFileS == $passwordFromUser){
                //redicrect to dashboard
                date_default_timezone_set('Africa/Lagos');
                $_SESSION['logindate'] = $userObject->logindate;
                $_SESSION['date'] = $userObject->date;
                $_SESSION['loggedIn'] = $userObject->id; 
                $_SESSION['email'] = $userObject->email;
                $_SESSION['fullname'] = $userObject->first_name . " " . $userObject->last_name;
                $_SESSION['role'] = $userObject->designation;
                $_SESSION['department'] = $userObject->department;
                $_SESSION['logintime'] = date("y/m/d h:i:s A");
                $_SESSION['userObject'] = json_encode($userObject);
                
                if ($_SESSION['role'] == "Coaching Team") {
                    redirect_to("coachingT_dashboard.php");
                }
                else{
                    redirect_to("player_dashboard.php");
                }
                die();
            }
          
        }
        
        set_alert('error',"Invalid Email or Password");
        redirect_to("login.php");
        die();
    }
}
