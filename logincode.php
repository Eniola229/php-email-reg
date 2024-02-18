<?php
session_start();
require "dbcon.php";

if (isset($_POST['login_btn'])) {
    if (!empty($_POST['email']) && !empty($_POST['pwd'])) {

        $email = htmlspecialchars($_POST['email']);
        $pwd = htmlspecialchars($_POST['pwd']);

        $login_query = "SELECT * FROM userss WHERE email=? LIMIT 1";
        $stmt = mysqli_prepare($con, $login_query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $login_query_run = mysqli_stmt_get_result($stmt);

        if ($login_query_run) {
            if (mysqli_num_rows($login_query_run) > 0) {
                $row = mysqli_fetch_array($login_query_run);
                // Assuming password is hashed in the database
                $hashed_pwd = $row['pwd'];
                if (password_verify($pwd, $hashed_pwd)) {
                    if ($row['verify_status'] == "1") {
                        // User is verified, set session variables and redirect to dashboard
                        $_SESSION['authenticated'] = true;
                        $_SESSION['auth_user'] = [
                            'name' => $row['name'],
                            'phone' => $row['phone'],
                            'email' => $row['email'],
                        ]; 
                        $_SESSION['status'] = "You are Logged in Successfully";
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        $_SESSION['status'] = "Please Verify Your Email";
                        header("Location: login.php");
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "Invalid Email or Password";
                    header("Location: login.php");
                    exit();
                }
            } else {
                $_SESSION['status'] = "Invalid Email or Password";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Database Error";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "All Fields Required";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['status'] = "Failed! Illegal Entry";
    header("Location: login.php");
    exit();
}
?>
