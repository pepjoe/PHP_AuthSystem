<?php include_once('alert.php');


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function is_user_loggedIn() {

    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
        return true;
    }

    return false;
}

function is_token_set(){

    return is_token_set_in_get() || is_token_set_in_session();

}

function is_token_set_in_session(){

    return  isset($_SESSION['token']);

}

function is_token_set_in_get(){

    return isset($_GET['token']); 

}



function find_user($email = ""){
    //check the filing system if the user exsits
    if(!$email){
        set_alert('error','User Email is not set');
        die();
    }

    $allUsers = scandir("file_system/users/");
    $countAllUsers = count($allUsers);

    for ($counter = 0; $counter < $countAllUsers ; $counter++) {
       
        $currentUser = $allUsers[$counter];

        if($currentUser == $email . ".json"){
          //check the user password.
            $userString = file_get_contents("file_system/users/".$currentUser);
            $userObject = json_decode($userString);
                       
            return $userObject;
          
        }        
        
    }

    return false;
}

function send_payment_mail(
    $subject = "", 
    $message = "",
    $email = ""
    ){
    
    $headers = "From: no-reply@bodilyacademy.com" . "\r\n" .
    "CC: admin@bodilyacademy.com";

    $try = mail($email,$subject,$message,$headers);

    if($try){
        
        set_alert('message',"Payment successful " . $email);        
        

    }else{
        
        set_alert('error',"Something went wrong, we could not send confirmation email: " . $email);             

    }

}

function save_payment($payment){
    file_put_contents("file_system/payments/". $payment['txref'] . ".json", json_encode($payment));
}

function save_user($userObject){
    file_put_contents("file_system/users/". $userObject['email'] . ".json", json_encode($userObject));
}

function save_appointment($appointment){
    file_put_contents("file_system/appointments/". $appointment['email'] . ".json", json_encode($appointment));
}