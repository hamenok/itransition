<?php 
include '../db/connect.php';

if(isset($_POST['submit']))
{
    $err = [];

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Login can only consist of letters of the English alphabet and numbers";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 50)
    {
        $err[] = "Login must be at least 3 characters and no more than 50";
    }

    $query = mysqli_query($conn, "SELECT uid FROM users WHERE login='".mysqli_real_escape_string($conn, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "A user with this login already exists in the database";
    }

    if(count($err) == 0)
    {

        $login = $_POST['login'];

        $password = md5(md5(trim($_POST['password'])));
        $email = $_POST['email'];
        $uid = md5($_POST['login'].md5(trim($_POST['password'])));
        mysqli_query($conn,"INSERT INTO users SET uid='".$uid."', login='".$login."', password='".$password."', mail='".$email."', data_reg='".date("Y-m-d H:i:s")."'");
        exit('Reload');
    }
    else
    {
        print "<b>The following errors occurred during registration:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>".$_POST['login']."|".$_POST['password']."|".$_POST['email'];
        }
    }
}
?>