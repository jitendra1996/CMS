<?php include "db.php"; ?>
<?php session_start(); ?>
<?php

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
    $login_query = mysqli_query($connection,$query);

    if(!$login_query){
        die("Error".mysqli_error($connection));
    }else{
        $count = mysqli_num_rows($login_query);
        if(!$count){
            header("Location:../index.php");
        }else{
            $user_details = mysqli_fetch_assoc($login_query);
            $_SESSION['username'] = $user_details['username'];
            $_SESSION['firstname'] = $user_details['user_firstname'];
            $_SESSION['lastname'] = $user_details['user_lastname'];
            $_SESSION['user_role'] = $user_details['user_role'];
            
            header("Location:../admin");
        }
    }
}

?>