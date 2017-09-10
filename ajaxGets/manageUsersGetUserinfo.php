<?php
require('../db_connect.php');
require('../functions.php');
$query = "SELECT * FROM User as U, UserSecurity as US WHERE U.userID = {$_POST['user']} AND U.userID = US.userID";
$result = mysqli_query($connection, $query);
foreach($result as $row){
  $paymentMethod = $row['paymentMethod'];
  $bank = $row['bank'];
  $email = $row['email'];
  $accountStatus = $row['accountStatus'];

  ?>
  <table>
   <tr>
     <th>Naam</th>
   </tr>
   <tr>
     <td><input type='text' value='<?=$row['name']?>' id='nameInput'></td>
   </tr>
   <tr>
     <th>Betaalmethode</th> <?php if($paymentMethod == "ideal"){echo'<th>Bank</th>';}?>
   </tr>
   <tr>
     <td>
       <select class='paymentMethod'>
         <option value='bank' <?php if($paymentMethod == "bank"){ echo " selected='selected'"; } ?>>Bank</option>
         <option value='ideal'<?php if($paymentMethod == "ideal"){ echo " selected='selected'"; } ?>>iDeal</option>
         <option value='paypal'<?php if($paymentMethod == "paypal"){ echo " selected='selected'"; } ?>>Paypal</option>
         <option value='cash'<?php if($paymentMethod == "cash"){ echo " selected='selected'"; } ?>>Cash</option>
       </select>
     </td>
     <?php
     if($paymentMethod == "ideal"){
     ?>
     <td>
       <select class='selectedBank'>
         <option value='ING'<?php if($bank == "ING"){ echo " selected='selected'"; } ?>>ING Bank</option>
         <option value='ABN_AMRO'<?php if($bank == "ABN_AMRO"){ echo " selected='selected'"; } ?>>ABN AMRO</option>
         <option value='SNS'<?php if($bank == "SNS"){ echo " selected='selected'"; } ?>>SNS Bank</option>
         <option value='RABO'<?php if($bank == "RABO"){ echo " selected='selected'"; } ?>>Rabo Bank</option>
       </select>
     </td>
     <?php
    } ?>
   </tr>
   <tr>
     <th>Wachtwoord</th><th>Email</th>
   </tr>
   <tr>
     <td>
       <input type='password' id='passwordInput' email='passwordInput' placeholder='Nieuw Wachtwoord'>
     </td>
     <td>
       <input type='email' id='emailInput' name='emailInput' placeholder='email' value='<?=$email?>'>
     </td>
   </tr>
   <tr>
     <th>Account Status</th>
   </tr>
   <tr>
     <td>
       <select class='accountStatus'>
         <option value='activated' <?php if($accountStatus == "activated"){ echo " selected='selected'"; } ?>>Geactiveerd</option>
         <option value='not activated' <?php if($accountStatus == "not activated"){ echo " selected='selected'"; } ?>>Niet Geactiveerd</option>
         <option value='banned' <?php if($accountStatus == "banned"){ echo " selected='selected'"; } ?>>Verbannen</option>
       </select>
     </td>
   </tr>
   <tr>
     <th>Gebruiker Rollen</th>
   </tr>
   <?php
   $query = "SELECT role FROM UserRoles WHERE userID = {$_POST['user']}";
   $result = mysqli_query($connection, $query);
   echo '
   <tbody class="roles"
     <tbody class="roleList">';
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
     echo '
     </tbody>
   </tbody>'
   ?>
   <tr><th>Bewaar je veranderingen</th></tr>
   <tr><td><button class='saveChanges'>Submit</button></td></tr>
   <tr><td><p id='feedbackText'></p></td></tr>
  </table>
  <?php
}
 ?>
 <script>
 $(document).on('click','.removeable', function(){
   var info = {};
   info.user = $(this).attr('user');
   info.role = $(this).attr('role');
   info.action = 'removeRole';
   function onComplete(data){
     var info2 = {};
     info2.user = info.user;
     function onComplete(data){
       $('.roles').html(data.responseText);
     }
     parseAjaxReturn(info2, onComplete, 'ajaxGets/manageUsersGetRoles.php')
   }
   parseAjax(info, onComplete)
 });
 </script>
