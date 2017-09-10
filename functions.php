<?php
//This file is used to declare function to be used in the future.
//It mentions what they do and what arguments they take.


//This function is used to compare the users password with the inserted password using the email as their key.
//It takes a password and email as it's arguments.
function checkPassword($password, $email){
  session_start();
  $wachtwoord = $password;
  require("db_connect.php");
  if($getPassword = mysqli_prepare($connection, "SELECT US.passwordHash, U.userID, U.name from UserSecurity as US, User as U WHERE U.userID = US.userID and U.email = ?")){
    mysqli_stmt_bind_param($getPassword, "s", $email);
    mysqli_stmt_execute($getPassword);
    mysqli_stmt_bind_result($getPassword, $passwordHash, $userID, $firstname);
    while(mysqli_stmt_fetch($getPassword)){
      if($wachtwoord == $passwordHash){
        if(isset($_SESSION['cartProducts'])){
          foreach($_SESSION['cartProducts'] as $cartProduct){
            $query = "SELECT I.itemID FROM Item as I, Product as P, CartItems as CA WHERE CA.itemID != I.itemID AND P.productID = {$cartProduct} AND P.productID = I.productID Limit {$_SESSION['cart'][$cartProduct]}";
            $result = mysqli_query($connection, $query);
            foreach($result as $row){
              $query = "UPDATE Item SET status='usable' WHERE itemID = {$row['itemID']}";
              $result = mysqli_query($connection, $query);
            }
          }
          $_SESSION['cartProducts'] = "";
          $_SESSION['cart'] = "";
        }
        $_SESSION['userinfo']['name'] = $firstname;  //Sets name of the user in the session.
        $_SESSION['userinfo']['userID'] = $userID;   //Sets the userID of the user in the session.
        $_SESSION['userinfo']['email'] = $email;     //Sets the email of the user in the session.
        $query = "SELECT * FROM UserRoles WHERE userID = {$userID}";
        $result = mysqli_query($connection, $query);
        $count = 0;
        foreach($result as $row){
          $_SESSION['userinfo']['role'][$count] = $row['role'];
          $count++;
        }
        return true;
      }
      else{
        return false;
      }
    }
  }
}
//EndFunction

//This function shortens the mysqli_stmt_num_rows function built into php.
//It takes a query as it's argument.
//Only to be used to set a variable value. example: $numRows = prepared_num_rows($query);
function prepared_num_rows($query){
  mysqli_stmt_store_result($query);
  return mysqli_stmt_num_rows($query);
}
//EndFunction

//This function is used to check if a given user has a specific role to give them permissions.
//It takes a string as an argument, this string has to be a previously known role else it will return false by default.
function hasRole($role){
  // session_start();
  require("db_connect.php");
  if($getRole = mysqli_prepare($connection, "SELECT * FROM UserRoles WHERE role = ? AND userID = ?")){
    mysqli_stmt_bind_param($getRole, 'si', $role, $_SESSION['userinfo']['userID']);
    mysqli_stmt_execute($getRole);
    $numRows = prepared_num_rows($getRole);
    if($numRows > 0){
      return true;
    }
    else{
      return false;
    }
  }
}
//EndFunction

function roundedNumbers($target){
  $stringLength  = strlen(strrchr($target, '.')) -1;
  if($stringLength > 0){
    return $target;
  }
  else{
    return $target.",-";
  }
}
?>
