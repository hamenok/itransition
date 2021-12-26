<?php
 include '../db/connect.php';
 session_start();
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 $result=mysqli_query($conn,"SELECT * FROM users");
 $role=mysqli_query($conn, "SELECT * FROM role");
 $block = '<img id="Blockimg" src="/style/icons/lock.png" title="Block" alt="Block">';
 $unblock = '<img id="Unblockimg" src="/style/icons/unlock.png" title="Unblock" alt="Unblock">';
 $delete = '<img id="Deleteimg" src="/style/icons/delete.png" title="Delete" alt="Delete">';
 echo '<div id="users">';
 if ($_SESSION['role']==2) {
    echo '<div class="btn-group" role="group" aria-label="Basic example">';
    echo '<button type="button" class="btn btn-light" id="blockBtn">'.$block.'</button>';
    echo '<button type="button" class="btn btn-light" id="unblovkBtn">'.$unblock.'</button>';
    echo '<button type="button" class="btn btn-light" id="deleteBtn">'.$delete.'</button>';
    echo '<button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Change role
   </button>
   <ul class="dropdown-menu">';
   while($row = mysqli_fetch_assoc($role)){
       echo '<li><a class="dropdown-item" data-id="'.$row['id'].'" href="#">'.$row['role'].'</a></li>';
   }
   echo '</ul>';
    echo '</div>';
 }
 
 echo '<div id="usersTable">';
 echo '<table class="table table-hover">';
 echo "<thead>";
 echo "<tr>";
   echo '<th scope="col">
            <div class="form-check" id="checkAll">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">All</label>
            </div>
        </th>';
   echo '<th scope="col">UID</th>';
   echo '<th scope="col">LOGIN</th>';
   echo '<th scope="col">EMAIL</th>';
   echo '<th scope="col">DATA REGISTRATION</th>';
   echo '<th scope="col">LAST ACTIVITY</th>';
   echo '<th scope="col">STATUS</th>';
 echo "</tr>";
echo "</thead>";
echo "<tbody>";
$online_status = '<img class="status" src="/style/icons/online.png" title="Online" alt="Online">';
$offline_status= '<img class="status" src="/style/icons/offline.png" title="Offline" alt="Offline">';
$blocked_status= '<img id="statusBlock" src="/style/icons/lock.png" title="Blocked" alt="Blocked">';
 while($row = mysqli_fetch_assoc($result)){


   echo "<tr>";
            echo '<td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" data-uid="'.$row['uid'].'" data-status="'.$row['status'].'" >
                    </div>
                </td>';
            echo "<td>".$row['uid']."</td>";
            echo "<td>".$row['login']."</td>";
            echo "<td>".$row['mail']."</td>";
            echo "<td>".$row['data_reg']."</td>";
            echo "<td>".$row['data_login']."</td>";
            echo "<td>";
            if ($row['status']==0) {
                echo "<div>".$offline_status."</div>";
            }
            if ($row['status']==1) {
                echo "<div>".$online_status."</div>";
            }
            if ($row['status']==2) {
                echo "<div>".$blocked_status."</div>";
            }
            echo "</td>";
            echo '<td><button type="button" data-uid="'.$row['uid'].'" data-login="'.$_SESSION['login'].'" class="btn btn-primary">Send message</button></td>';
            echo "</tr>";
   }

echo "</tbody>";
   echo '</table>';
   echo '</div>';
   echo '<div class="input-group mb-3">
  <span class="input-group-text">Enter your message </span>
  <textarea class="form-control" id="textMessage" aria-label="With textarea"></textarea>
</div>';
echo '</div>';  
?>