<?php include_once('lib/header.php');
require_once('functions/redirect.php'); 
if(!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== "Player"){
    // redirect to login
    redirect_to('login.php');
}

?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center border shadow-sm" style="background-color: #87ceeb;">
    <h1 class="display-5">Player Dashboard</h1>
    <p class="lead">Hi, <?php echo $_SESSION['fullname'] ?> . Welcome to Bodily Academy</p>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6 pt-3">
        <p class="lead">Please fill the form below to book an appointment</p>
       
        <form method="POST" action="extract_appointment.php">
	 <p>
                <label>Date</label>
                <input type="Date" class="form-control" name="date" value="<?php echo date('y-m-d'); ?>" />

            </p>
            <p>
                <label>Time</label>
                <input type="Time" class="form-control" name="time" value="<?php echo time('h:i A'); ?>" />

            </p>
            <p>
                <label>Nature of appointment</label>
                <input type="text" class="form-control" name="noa" placeholder="nature of appointment" />

            </p>
            <p>
                <label>Department</label>
                <select class="form-control" name="department">
                
                    <option 
                    <?php
                    if(isset($_SESSION['department']) && $_SESSION['department'] == 'Club Service'){
                        echo "selected";
                    }
                    ?>
                    >Club Service</option>
                    
                    <option
                    <?php
                    if(isset($_SESSION['department']) && $_SESSION['department'] == 'Techniques and Coaching'){
                        echo "selected";                                                           
                    }
                    ?>
                    >Techniques and Coaching</option>
                    
                    <option
                    <?php
                    if(isset($_SESSION['department']) && $_SESSION['department'] == 'Sales'){
                        echo "selected";
                    }
                    ?>
                    >Sales</option>
                    
                    <option
                    <?php
                    if(isset($_SESSION['department']) && $_SESSION['department'] == 'Administration'){
                        echo "selected";
                    }
                    ?>
                    >Administration</option>
                    
                    <option
                    <?php
                    if(isset($_SESSION['department']) && $_SESSION['department'] == 'Finance'){
                        echo "selected";
                    }
                    ?>
                    >Finance</option>
                    
                </select>

            </p>
            <p>
                <label>Initial complaint</label>
                <textarea class="form-control" rows="5" name=complaint> </textarea>

            </p>
            <p>
                <button class="btn btn-sm btn-primary" type="submit">Book Appointment</button>
            </p>
	
</form>
			
		</div>
        <div class="col-md-6 pt-5 pl-4 mx-auto text-center">
		</div>
		
	</div>
	
</div>

<?php
include_once('lib/footer.php');
?>