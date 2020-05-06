<?php include_once('lib/header.php'); 
require_once('functions/fetch.php');
require_once('functions/redirect.php');

if(!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== "Coaching Team"){
    // redirect to loginn
    redirect_to('login.php');
}

$userObject = json_decode($_SESSION['userObject']);
?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="background-color: #87ceeb;">
    <h1 class="display-5">Coach Dashboard</h1>
    <p class="lead">Hi, <?php echo $_SESSION['fullname'] ?> . Welcome to Bodily Academy!</p>
</div>

<div class="container">
	
	<div class="row">
		<div class="col-md-12 pt-3">
        <a class="btn btn-outline-primary" href="coachingT_dashboard.php" style="margin: 20px"> < Back</a>
        
        <p><?php echo $userObject->department ?> Department Appointments</p>

        <div id="table">
        <?php
        $rows = Appointment($userObject->department);
        if ($rows) {
        ?>
        <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
        
        <tr>
            <th scope="col">S/N</th>
            <th scope="col">Player Name</th>
            <th scope="col">Nature of Apointment</th>
            <th scope="col">Appointment Date</th>
            <th scope="col">Appointment Time</th>
            <th scope="col">Department</th>
            <th scope="col">Initial Complaint</th>
            <th scope="col">Payment Status</th>
        </tr>
        </thead>
        
        <tbody>
            <?php
            echo $rows;
            ?>
        </tbody>
        </table>
        <?php } else { ?>
            <p>You have no pending appointments</p>
        <?php } ?>
        </div>
        </div>
    </div>
    
</div>

<?php
include_once('lib/footer.php');
?>