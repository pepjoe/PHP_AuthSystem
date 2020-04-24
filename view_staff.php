<?php include_once('lib/adminheader.php'); 
require_once('functions/fetch.php');
require_once('functions/redirect.php');

if(!isset($_SESSION['loggedIn'])){
    // redirect to login
    redirect_to('login.php');
}
?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="background-color: silver;">
    <h1 class="display-5">Admin Dashboard</h1>
    <p class="lead">Hi, <?php echo $_SESSION['fullname'] ?> . Welcome to Bodily Academy!</p>
</div>
    
<div class="container">
    <div class="row">
		<div class="col-md-12 pt-3">
        <a class="btn btn-outline-danger" href="admin_dashboard.php" style="margin: 20px"> < Back</a>
        <h4 class="display-5 text-center">   All Staff</h4>
        <div id="table">
        <?php
        $rows = getAllstaff();
        if ($rows) {
        ?>
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                <th scope="col">s/n</th>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Designation</th>
                <th scope="col">Department</th>
                <th scope="col">Date of Registration</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $rows; ?>
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