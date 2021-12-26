<?php
include '../db/connect.php';

mysqli_query($conn,"UPDATE users SET status=0 WHERE uid='".$_POST['uid']."'"); 

