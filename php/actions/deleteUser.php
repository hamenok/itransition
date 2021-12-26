<?php
include '../db/connect.php';

mysqli_query($conn,"DELETE FROM users WHERE uid='".$_POST['uid']."'"); 

