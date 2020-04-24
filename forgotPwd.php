<?php

include_once('./lib/header.php');
require_once('./functions/alert.php');

?>

<div id="login" style="padding-bottom: 150px;">

    <div>
        <h3>Forgot Password</h3>
        <p>Enter the email associated with your profile, <br>
        and we will help you reset your password.</p>
    </div>
    
    <?php
    print_message();
    ?>
    
    <form action="extract_forgotPwd.php" method="POST">

        <p>
            <label>Email:</label><br>
            <input value="<?php
                if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
                    echo $_SESSION['email'];
                    $_SESSION['email'] = '';
                }
                ?>" type="email" name="email" placeholder="Please enter email"/>
        </p>
        
        <button type="submit">Get Reset Code</button>
        
        </form>
        
</div>

<?php
include_once('./lib/footer.php');
?>