<?php
include "php/db/connect.php";
        if (isset($_SESSION['uid']))
        {       
            if(isset($_COOKIE['login']) && isset($_COOKIE['password']))     
            {           
            SetCookie("login", "", time() - 1, '/');            
            SetCookie("password","", time() - 1, '/');          
            setcookie ("login", $_COOKIE['login'], time() + 50000, '/');            
            setcookie ("password", $_COOKIE['password'], time() + 50000, '/');          
            $uid = $_SESSION['uid'];          
            lastAct($uid,1);           
            return true;        
            }       
            else        
            {           
                $rez = mysqli_query($conn, "SELECT * FROM users WHERE uid='".$_SESSION['uid']."'");             
                if (mysqli_num_rows($rez) == 1)         
                {       
                    $row = mysqli_fetch_assoc($rez);               
                    setcookie ("login", $row['login'], time()+50000, '/');              
                    setcookie ("password", md5($row['login'].$row['password']), time() + 50000, '/'); 
                    $uid = $_SESSION['uid'];
                    lastAct($uid,1); 
                    return true;            
                } 
                else return false;      
            }   
        }   
        else     
        {       
            if(isset($_COOKIE['login']) && isset($_COOKIE['password']))      
            {           
                $rez = mysqli_query($conn,"SELECT * FROM users WHERE login='{$_COOKIE['login']}'");            
                @$row = mysqli_fetch_assoc($rez);            
                
                if(@mysqli_num_rows($rez) == 1 && md5($row['login'].$row['password']) == $_COOKIE['password'])          
                {               
                    $_SESSION['uid'] = $row['uid'];   
                    $_SESSION['login'] = $row['login']; 
                    $_SESSION['role'] = $row['role']; 
                    $uid = $_SESSION['uid'];              
                    
                    lastAct($uid, 1);               
                return true;            
                }           
                else            
                {               
                    SetCookie("login", "", time() - 360000, '/');               
                    
                    SetCookie("password", "", time() - 360000, '/');                    
                    return false;           
                }       
            }       
            else     
            {           
                return false;       
            }   
        } 

    function lastAct($uid, $status)
    {           
        include "php/db/connect.php";
        $tm = date("Y-m-d H:i:s");   
        mysqli_query($conn, "UPDATE users SET status='".$status."', data_login='".$tm."' WHERE uid='".$uid."'"); 
    }

  
    