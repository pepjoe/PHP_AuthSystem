<?php include_once('lib/header.php'); 

if(!isset($_SESSION['loggedIn'])){
    // redirect to dashboard
    header("Location: login.php");
}
?>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="background-color: #87ceeb;">
        <h1 class="display-5"> Dashboard</h1>
        <p class="lead">Hi, <?php echo $_SESSION['fullname'] ?> . Welcome to Bodily Academy</p>
        
      
    </div>
<div class="container">
	<div class="row">
		<div class="col-md 4 pt-4 pl-4 ">
			<p >You are user id  <strong> <?php echo $_SESSION['loggedIn'] ?></strong></p>
			<hr/>
			<p >You are logged in as a  <strong> <?php echo $_SESSION['role'] ?></strong></p>
			<hr/>
			<p > Date of registration:  <strong> <?php echo $_SESSION['date'] ?></strong></p>
			<hr/>
			<p > Date and time of last login:  <strong> <?php echo $_SESSION['logindate'] ?></strong></p>

			<hr/>
			<p > Department:  <strong> <?php echo $_SESSION['department'] ?></strong></p>
			
			
		</div>
		
	</div>
	
</div>

<?php include_once('lib/footer.php'); ?>