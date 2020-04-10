<?php include_once('alert.php');


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function is_user_loggedIn(){

    if($_SESSION['loggedIn'] && !empty($_SESSION['loggedIn'])) {
        return true;
    }

    return false;
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

function save_user($userObject){
    file_put_contents("file_system/users/". $userObject['email'] . ".json", json_encode($userObject));
}