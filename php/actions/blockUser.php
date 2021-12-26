<?php
include '../db/connect.php';

mysqli_query($conn,"UPDATE users SET status=2 WHERE uid='".$_POST['uid']."'"); 
