<?php include_once('lib/header.php');
      require_once('functions/alert.php');
      require_once('functions/redirect.php');

if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
    // redirect to dashboard
    if ($_SESSION['role'] == "Coaching Team") {
        redirect_to('coachingT_dashboard.php');
    }else{
        redirect_to('player_dashboard.php');
    }
}

?>
<div class="container"  style="background-color: white;">
    <div class="row col-6">
        <h3>Login</h3>
    </div>
    <div class="row col-6">
        <p>
        <?php  print_alert(); ?>
        </p>
        <form method="POST" action="extract_login.php">
    
                
            <p>
                <label>Email</label><br />
                <input
                
                <?php              
                    if(isset($_SESSION['email'])){
                        echo "value=" . $_SESSION['email'];                                                             
                    }                
                ?>

                type="text" class="form-control" name="email" placeholder="Email"/>
            </p>

            <p>
                <label>Password</label><br />
                <input class="form-control" type="password" name="password" placeholder="Password"/>
            </p>       
        
        
            <p>
                <button class="btn btn-sm btn-primary" type="submit">Login</button>
            </p>

            <p>
                <a href="forgotPwd.php">Forgot password</a>
            </p>

            <p>
                Don't have an account?<a href="register.php"> Register</a>
            </p>
        </form>
    </div>
</div>
<?php include_once('lib/footer.php'); ?>