<?php
session_start();

// if (isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
//     $_SESSION['status'] = "You are Already Logged In";
//     header("Location: dashboard.php");
//     exit;
// }
// else
// {
//     header("Location: login.php");
//     exit;
// }

 $page_title = "Login Form";
 include 'includes/Header.php';
 include "includes/navbar.php";
?>

    <div class="p-5">
        <div class="contianer">
            <div class="row justify-content-center">
                <div class="col-md-6">
                   <div class="alert alert-danger">
                    <?php
                         if(isset($_SESSION['status'])) {
                            echo $_SESSION['status'];
                            unset($_SESSION['status']); // Remove the message after displaying it
                        }
                        ?>
                         </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Login</h5>
                        </div>
                        <div class="card-body">
                            <form action="logincode.php" method="post">
                                <div class="form-group mb-3">
                                    <label for="">Email Address</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="pwd">
                                </div>
                                
                                <div class="form-group">
                                    <button name="login_btn" type="submit" class="btn btn-primary">Login</button>
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