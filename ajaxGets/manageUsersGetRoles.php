<?php
require('../db_connect.php');
require('../functions.php');
 ?>
<tbody class="roleList">
  <?php

  $query = "SELECT role FROM UserRoles WHERE userID = {$_POST['user']}";
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
foreach($result as $row){
  ++$rolCount;
  if($row['role'] != 'user'){
    $removeable = '<td><button class="removeable" role="'.$row['role'].'" user="'.$_POST['user'].'">Remove</button></td>';
  }
  else{
    $removeable = '';
  }
  echo '
  <tr>
    <td>'.$row['role'].'</td>
    '.$removeable.'
  </tr>';
}
echo '</tbody>
<tbody class="addRoles">';

if($rolCount != 3){
  echo '<tr><th>Geef Een Rol</th></tr>';
  echo '
  <tr>
   <td>
     <select class="selectedRole">';
       $roles = ['admin', 'medewerker'];
       foreach($roles as $role){
         $query = "SELECT `role`, `userID` FROM `UserRoles` WHERE role = '{$role}' AND userID = '{$_POST['user']}'";
         $result = mysqli_query($connection, $query);
         if(mysqli_num_rows($result) == 0){
             echo '<option value="'.$role.'" class="roleOption">'.$role.'</option>';
         }
       }
       echo'
     </select>
   </td>
   <td><button class="addRole">Voeg Toe</button></td>
  </tr>
  <tr><td class="addRoleFeedback"></td></tr>';

}
?>
</tbody>
