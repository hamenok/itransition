<?php
 include '../db/connect.php';
 session_start();

 $result=mysqli_query($conn,"SELECT * FROM message where uid='".$_SESSION['uid']."'");
 echo '<div id="message">';
 while($row = mysqli_fetch_assoc($result)){
    
    echo '<div class="card" style="width: 30rem;">';
    echo '<div class="card-header">From: <b>'.$row['from_login'].'</b></div>';
    echo '<div class="card-body">';
    echo '<h6 class="card-subtitle mb-2 text-muted"><span class="badge bg-info text-dark">'.$row['date_message'].'</span></h6>';
    echo '<p class="card-text">'.$row['message'].'</p>';

    echo '</div>';
    echo '</div><br>';
};
echo '</div>';
?>