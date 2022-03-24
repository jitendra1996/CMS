<?php session_start(); ?>
<?php 

$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['user_role'] = null;

// $destroy = session_destroy();
// if($destroy){
    header("Location:../index.php");
// }


?>