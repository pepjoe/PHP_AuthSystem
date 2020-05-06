<?php include_once('lib/adminheader.php'); 
require_once('functions/fetch.php');
require_once('functions/redirect.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to login
    redirect_to('login.php');
}
?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="background-color: silver;">
    <h1 class="display-5"> Admin Dashboard</h1>
    <p class="lead">Hi, <?php echo $_SESSION['fullname'] ?> . Welcome to Bodily Academy!</p>
</div>

<div class="container">
	
	<div class="row">
		<div class="col-md-12 pt-3">
        <a class="btn btn-outline-danger" href="admin_dashboard.php" style="margin: 20px"> < Back</a>

        
        <h4 class="display-5 text-center">   All Payments</h4>
        <div id="table">
        
        
        <?php
       $rows = getAllpayment();
        if ($rows) {

        ?>
            <table class="table table-bordered table-striped table-hover">
               
                <thead class="thead-dark">
                <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Payment reference</th>
                        <th scope="col">Email</th>
                        <th scope="col">Fullname</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php echo $rows; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>You have no payment</p>
        <?php } ?>
        
        </div>

		</div>
		
	</div>
		
</div>
    

<?php
include_once('lib/footer.php');
?>