<?php
if(isset($_GET['hash']) && isset($_GET['email'])){
  $email = $_GET['email'];
  $hash = $_GET['hash'];
  if($getHash = mysqli_prepare($connection, "SELECT * FROM UserSecurity as US, User as U WHERE U.userID = US.userID AND US.verificationHash = ? AND U.email = ?")){
    mysqli_stmt_bind_param($getHash, 'ss', $hash, $email);
    mysqli_stmt_execute($getHash);
    $numRows = prepared_num_rows($getHash);
    if($numRows > 0){
      if($changeStatus = mysqli_prepare($connection, "UPDATE UserSecurity SET accountStatus= 'activated' WHERE userID = (SELECT userID from User where email = ?)")){
        mysqli_stmt_bind_param($changeStatus, 's' ,$email);
        mysqli_stmt_execute($changeStatus);
        echo "Uw account is nu geactiveerd. U kunt nu inloggen.";
      }
      else{
        echo "Er was een probleem, neem contact op met een administrator.";
      }
    }
    else{
      echo "De combinatie van uw email en de verificatie code is incorrect.";
    }
  }
  else{
    echo "Er was een probleem, neem contact op met een administrator.";
  }
}
?>
