<?php
include '../db/connect.php';

mysqli_query($conn,"UPDATE users SET role=".$_POST['role']." WHERE uid='".$_POST['uid']."'"); 
