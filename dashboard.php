<?php
include "athentication.php";
$page_title = "Dashboard";
 include 'includes/Header.php';
 include "includes/navbar.php";
?>
 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="alert alert-success">
                    <?php
                         if(isset($_SESSION['status'])) {
                            echo $_SESSION['status'];
                            unset($_SESSION['status']); 
                        }
                        ?>
                         </div>
                <div class="card">
                    <div class="card-header">
                        <h4>DashBoard</h4>
                    </div>
                    <div class="card-body">
                    <h4>Logged in</h4>
                    <h5>Full Name: <?= $_SESSION['auth_user']['name']; ?></h5>
                    <h5>E-Mail: <?= $_SESSION['auth_user']['email']; ?></h5><h5>Full Name: <?= $_SESSION['auth_user']['name']; ?></h5>
                    <h5>Phone Number: <?= $_SESSION['auth_user']['phone']; ?></h5>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

<?php
 include "includes/Footer.php";
?>