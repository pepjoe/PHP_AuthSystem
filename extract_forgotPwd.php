<?php session_start();

require_once('./functions/alert.php');
require_once('functions/redirect.php');
require_once('functions/tokens.php');
require_once('functions/user.php');

$errorCount = 0;

$_POST['email'] !== '' ? $email = $_POST['email'] : $errorCount++;

$_SESSION['email'] = $email;

    if ($errorCount > 0) {
        $session_message = 'Process failed, you have ' . $errorCount . ' error';
        
        if ($errorCount > 1) {
        $session_message .= "s";
    }
    $session_message .= ' in your form submmision';

    set_message('error', $session_message);
    redirect_to("forgotPwd.php");

}
else {
    $allusers = scandir('file_system/users/');
    $numOfUsers = count($allusers);
    
    for ($counter = 0; $counter < $numOfUsers; $counter++) {
        $currentUser = $allusers[$counter];
        if ($currentUser == $email . ".json") {
            $token = generateToken();
            
            $subject = "Password reset information";
            $message = "A password reset has been initiated on this account,
            if you didn't request this password reset or you received this message in error, 
            please disregard this email. Otherwise, visit: localhost/PHP_TASK_2_TODO/resetPwd.php?token=" . $token;
            $headers = "From: no-reply@bodilyacademy.com" . "\r\n" . "CC:pepjoe@bodilyacademy.com";
            
            file_put_contents("file_system/tokens/" . $email . ".json", json_encode(['token' => $token]));

            $sent =  mail($email, $subject, $message, $headers);

            if ($sent) {
                set_message('message', 'Password reset link as been sent to your email: ' . $email);
                redirect_to("login.php");
            }else {
                set_message('error', 'Something went wrong we could not sent password reset link to email: ' . $email);
                redirect_to("forgotPwd.php");
            }
            die();
        }
    }
    set_message('error', 'Email not registered with us: ' . $email);
    redirect_to("forgotPwd.php");
    
}