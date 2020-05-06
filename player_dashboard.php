<?php
include_once('lib/header.php');
require_once('functions/redirect.php');
require_once('functions/alert.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to login
    redirect_to('login.php');
}
?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center border-bottom shadow-sm" style="background-color: #87ceeb;">
    <h1 class="display-5">Player Dashboard</h1>
    <p class="lead">Hi, <?php echo $_SESSION['fullname'] ?> . Welcome to Bodily Academy!</p>
</div>
<script>
function hide() {
    document.getElementById('alert').style.display = "none";
    }
</script>
<div class="container">
	<div class="row">
		<div class="col-md-6 pt-3">
        <?php
        if(isset($_SESSION['message'])){
            echo	'<div id="alert" onclick="hide()">';
            echo $_SESSION['message'];
            echo   '<span class="closebtn"> &times;</span> </div>';
            unset($_SESSION['message']);
        }
        ?>
        
        <p>You are user id  <strong> <?php echo $_SESSION['loggedIn'] ?></strong></p>
        <hr/>
        <p>You are logged in as a  <strong> <?php echo $_SESSION['role'] ?></strong></p>
        <hr/>
        <p>Date of registration:  <strong> <?php echo $_SESSION['date'] ?></strong></p>
        <hr/>
        <p>Date and time of last login:  <strong> <?php echo $_SESSION['logindate'] ?></strong></p>
        <hr/>
        <p>Department:  <strong> <?php echo $_SESSION['department'] ?></strong></p>
		</div>

        <div class="col-md-6 pt-5 pl-4 mx-auto text-center">
        <p>
            <a href="https://flutterwave.com/pay/pepjoeatbi" class="btn btn-bg btn-primary"> Pay Bill</a>
        </p>
        
        <p>
            <a href="book_appointment.php" class="btn btn-bg btn-primary"> Book Appointment</a>
        </p>
		</div>
		
	</div>
	
</div>

<?php
include_once('lib/footer.php');
?>