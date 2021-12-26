<?php
session_start();    
$uid = $_SESSION['uid']; 
$host='localhost';
    $dbname='task5';
    $username='root';
    $password='';             
$conn = mysqli_connect($host,$username,$password,$dbname);
$rez = mysqli_query($conn,"SELECT * FROM users WHERE uid='".$uid."'");         
         $row = mysqli_fetch_assoc($rez); 
         if ($row['status']==2)                       
         { 
            mysqli_query($conn,"UPDATE users SET data_login='".date("Y-m-d H:i:s")."' WHERE uid='".$uid."'");      
        }           
        else         
            {               
                mysqli_query($conn,"UPDATE users SET status=0, data_login='".date("Y-m-d H:i:s")."' WHERE uid='".$uid."'");       
            }        
unset($_SESSION['uid']);
unset($_SESSION['login']);
setcookie ("login", $_COOKIE['login'], time() - 50000, '/');            
setcookie ("password", $_COOKIE['password'], time() - 50000, '/');
exit('Reload');

