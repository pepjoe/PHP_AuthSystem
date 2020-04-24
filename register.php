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
<div class="container">
    <div class="row col-6">
        <h3>Register</h3>
    </div>
    <div class="row col-6">
        <p><strong>Welcome, Please Register</strong></p>
    </div>
    <div class="row col-6">
        <p>All Fields are required</p> 
        
    </div>
    <div class="row col-6">
         
        <p><?php  print_alert(); ?></p>
    </div>
    <div class="row col-12">

        <form method="POST" action="extract_register.php">
        
            <p>
                <label>First Name</label>
                <input  
                <?php              
                    if(isset($_SESSION['first_name'])){
                        echo "value=" . $_SESSION['first_name'];                                                             
                    }                
                ?>
                type="text" class="form-control" name="first_name" placeholder="First Name" />

            </p>
            <p>
                <label>Last Name</label>
                <input
                <?php              
                    if(isset($_SESSION['last_name'])){
                        echo "value=" . $_SESSION['last_name'];                                                             
                    }                
                ?>
                type="text" class="form-control" name="last_name" placeholder="Last Name"  />
            </p>
            <p>
                <label>Email</label>
                <input
                
                <?php              
                    if(isset($_SESSION['email'])){
                        echo "value=" . $_SESSION['email'];                                                             
                    }                
                ?>

                type="text" class="form-control" name="email" placeholder="Email"  />
                
            </p>

            <p>
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password"  />
            </p>
            <p>
                <label>Gender</label>
                <select class="form-control" name="gender" >
                <?php              
                    if(isset($_SESSION['gender'])){
                        echo "value=" . $_SESSION['gender'];                                                             
                    }                
                ?>
                    
                    <option 
                    <?php              
                        if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female'){
                            echo "selected";                                                           
                        }                
                    ?>
                    >Female</option>
                    <option 
                    <?php              
                        if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male'){
                            echo "selected";                                                           
                        }                
                    ?>
                    >Male</option>
                </select>
            </p>
        
            <p>
                <label>Designation</label><br />
                <select class="form-control" name="designation" >
                
                    <option 
                    <?php              
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Coaching Team'){
                            echo "selected";                                                           
                        }                
                    ?>
                    >Coaching Team</option>
                     <option 
                    <?php              
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Player'){
                            echo "selected";                                                           
                        }                
                    ?>
                    >Player</option>
                </select>


            </p>
            <p>
                <label class="label" for="department">Department</label><br/>
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
                <button class="btn btn-sm btn-success" type="submit">Register</button>
            </p>
            <p>
                Already have an account?<a href="login.php"> Login</a>
            </p>
        </form>

    </div>

</div>
<?php include_once('lib/footer.php'); ?>