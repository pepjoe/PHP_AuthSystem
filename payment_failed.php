<?php
include_once('lib/header.php');
require_once('functions/redirect.php');
require_once('functions/alert.php');

if(!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== "Patient"){
    // redirect to login
    redirect_to('login.php');
}
?>

<div class="pricing-header mt-5 px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center border-bottom shadow-sm">
        <h1 class="display-5"> Your transaction was not successful <br/> 
        <p><a href="player_dashboard.php" class="btn btn-bg btn-primary"> continue to dashboard </a></p>
        </h1>
  </div>


<?php
include_once('lib/footer.php');
?>