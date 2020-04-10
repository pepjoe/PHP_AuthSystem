<?php include_once('lib/adminheader.php'); 

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="background-color: silver;">
        <h1 class="display-5"> Admin Dashboard</h1>
        <p class="lead">Hi, <?php echo $_SESSION['fullname'] ?> . Welcome to Bodily Academy</p>
    </div>
    
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
       
        <p>
            <a class="btn btn-bg btn-outline-primary" href="add_user.php">Add Users</a>            
        </p>
    </div>

    
<?php include_once('lib/footer.php'); ?>