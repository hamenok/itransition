<?php
include '../db/connect.php';
$login = $_POST['login'];
$uid = $_POST['uid'];
$message = $_POST['msg'];

mysqli_query($conn,"INSERT INTO message SET uid='".$uid."', from_login='".$login."', message='".$message."', date_message='".date("Y-m-d H:i:s")."'");
