<?php
 session_start();
 $page_title = "Registeration Form";
 include 'includes/Header.php';
 include "includes/navbar.php";
?>

    <div class="p-5">
        <div class="contianer">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="alert">
                        <?php 
                        if(isset($_SESSION['status']))
                        {
                            echo "<h4>".$_SESSION['status']."</h4>";
                            unset($_SESSION['status']);
                        }
                        ?>
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Registration Form</h5>
                        </div>
                        <div class="card-body">
                            <form action="signupcode.php" method="post">
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Email Address</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="pwd">
                                </div>
                        
                                <div class="form-group">
                                    <button name="register_btn" type="submit" class="btn btn-primary">Register Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
 include "includes/Footer.php";
?>