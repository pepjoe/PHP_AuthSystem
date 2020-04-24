<?php session_start();

require_once('./functions/alert.php');
require_once('./functions/user.php');
require_once('./functions/redirect.php');

$errorCount = 0;

if(!is_user_loggedIn()){
    $token = $_POST['token'] != "" ? $_POST['token'] :  $errorCount++;
    $_SESSION['token'] = $token;
}

$email = $_POST['email'] != "" ? $_POST['email'] :  $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] :  $errorCount++;

$_SESSION['email'] = $email;

if ($errorCount > 0) {
    $session_message = 'Cannot reset password, you have ' . $errorCount . ' error';

    if ($errorCount > 1) {
        $session_message .= "s";
    }
    $session_message .= ' in your form submmision';
    set_message('error', $session_message);

    redirect_to("resetPwd.php");

} else {
    $alltokens = scandir('file_system/tokens/');
    $numOfTokens = count($alltokens) - 1;

    for ($counter = 0; $counter < $numOfTokens; $counter++) {
        $currentToken = $alltokens[$counter];
        if (is_user_loggedIn()) {
            $checkToken = true;
        } else {
            $checkToken = $currentToken == $email . ".json";
        }
        
        if ($checkToken) {
            
            $tokenObject = json_decode(file_get_contents('file_system/tokens/' . $currentToken));
            $tokenFromFileS = $tokenObject->token;

            if ($tokenFromFileS == $token) {
                $allusers = scandir('file_system/users/');
                $numOfUsers = count($allusers);
                
                for ($counter = 0; $counter < $numOfUsers; $counter++) {
                    $currentUser = $allusers[$counter];

                    if ($currentUser == $email . ".json") {
                        $userObject = json_decode(file_get_contents('file_system/users/' . $currentUser));
                        $userObject->password = password_hash($password, PASSWORD_DEFAULT);
                        unlink('file_system/users/' . $currentUser);
                        unlink('file_system/tokens/' . $currentToken);
                        file_put_contents("file_system/users/" . $email . ".json", json_encode($userObject));
                        
                        $subject = "Password Reset Successful";
                        $message = "Your account on Bodily Academy has been updated, your password has changed.
                        If you did not request this change, please visit bodilyacademy.com and reset your password ";
                        $headers = "From: no-reply@bodilyacademy.com" . "\r\n" . "CC:admin@bodilyacademy.com";
                        
                        $sent =  mail($email, $subject, $message, $headers);
                        
                        if ($sent) {
                            session_unset();
                            $_SESSION['email'] = $email;
                            set_message('message', "Password reset successful, you can now login");
                            
                            redirect_to("login.php");
                            return;
                        }
                    
                    }
                
                }
            
            }

        }

    }
    set_message('error', 'Password reset failed, email invalid or token expired');
    redirect_to("resetPwd.php");
}