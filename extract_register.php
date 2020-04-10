<?php session_start();

require_once('functions/user.php');
//Collecting the data

$errorCount = 0;

//Verifying the data, validation

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$designation = $_POST['designation'];
$department = $_POST['department'];

//Checking that name is not blank, not numbers and not less than 2 characters long.
if (!preg_match("/^[a-zA-Z]*$/",$first_name) || (strlen($first_name) < 2 ) || (empty($first_name)) ) {
  $_SESSION['error'] = "*Name must be more than two string and must contain only letters";
  $errorCount++;
} else {
    $first_name = test_input($_POST["first_name"]);
     

  }

    if (empty($_POST["email"])) {
    $_SESSION['error'] =  "*Email is required";
    
    $errorCount++;
  } else {
    $email = test_input($_POST["email"]);
     if (!preg_match("/^[a-zA-Z0-9\.]*@[a-z\.]{1,}[a-z]*$/",$email) || $email=='') {
      $_SESSION['error'] =  "*Enter a valid email"; 
      $errorCount++;
    }
  }




$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;


if($errorCount > 0){

   
    header("Location: register.php");

}else{

    
    $allusers = scandir("file_system/users/");
    $countallusers = count($allusers);
    $newUserId = $countallusers++;


    $userObject = [
        'logindate'=>date("y/m/d h:i:s A"),
        'date'=>date("y/m/d"),
        'id'=>$newUserId,
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'email'=>$email,
        'password'=> password_hash($password, PASSWORD_DEFAULT),
        'gender'=>$gender,
        'designation'=>$designation,
        'department'=>$department
    ];

    //Check if the user already exists.
    $userExists = find_user($email);

        if($userExists){
            $_SESSION["error"] = "Registration Failed, User already exits ";
            header("Location: register.php");
            die();
        }
        

    //save in the database;
    save_user($userObject);

    $_SESSION["message"] = "Registration Successful, you can now login " . $first_name;
    header("Location: login.php");
}