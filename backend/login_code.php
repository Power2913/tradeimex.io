<?php
session_start();
include('backend/dbconfig.php');
if(isset($_POST['login_button']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM users where email='$email' and password='$password' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        $row = mysqli_fetch_array($query_run);
        $_SESSION['authentication'] = true;
        $_SESSION['auth_user'] = [
            'user_id'=>$row['id'],
            'user_email'=>$row['email'],
            'user_password'=>$row['password'],
        ];

        $_SESSION['message'] = "You are Logged In Successfully";
        header("Location: admin/dashboard.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Invalid Email or Password";
        header("Location: admin/index.php");
        exit(0);
    }
}
?>