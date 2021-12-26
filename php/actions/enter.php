<?php 
 include '../db/connect.php';
       session_start();
 $error = array();  
 if ($_POST['login'] != "" && $_POST['password'] != "")

 {       
     $login = $_POST['login']; 
     $password = $_POST['password'];

     $rez = mysqli_query($conn,"SELECT * FROM users WHERE login='".$login."'");    
     
     if (mysqli_num_rows($rez) == 1)      
     
     {           
         $row = mysqli_fetch_assoc($rez); 
    
         if (md5(md5($password)) == $row['password'] && $row['status']!=2)                   
         { 
            setcookie ("login", $row['login'], time() + 50000);                         
            setcookie ("password", md5($row['login'].$row['password']), time() + 50000);                    
            $_SESSION['uid'] = $row['uid'];
            $_SESSION['login'] = $row['login']; 
            $_SESSION['role'] = $row['role'];              
            $uid = $_SESSION['uid'];              
            lastAct($uid, 1);      
            exit('Reload');         
            return $error;          
        }           
        else         

            {               
                $error[] = "Invalid password";                                       
                return $error;          
            }       
     }       
     else      

     {           
         $error[] = "Invalid login or password";           
         return $error;      
     }   
 }   
     else    
     {       
         $error[] = "Fields must not be empty!";              
         return $error;  
     }

     function lastAct($uid, $status)
    {           
        include '../db/connect.php'; 
        mysqli_query($conn, "UPDATE users SET status='".$status."', data_login='".date("Y-m-d H:i:s")."' WHERE uid='".$uid."'"); 
    }
?>