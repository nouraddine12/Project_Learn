<?php

session_start();
$nonavbar = '';
$pageTitle = 'Login';
if(isset($_SESSION['Username'])){
  header('Location: dashboard.php');
}
include "init.php";

 // Check if user Coming HTTP POST Request
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $username = $_POST['user'];
  $password = $_POST['pass'];
  $hashedPass = sha1($password);



  // check if user Exist in Database

  $stmt = $con->prepare("SELECT 
                              UserID,Username,Password 
                        FROM 
                              users 
                        WHERE 
                              Username= ? AND Password = ? AND GroupID = 1 LIMIT 1");
  $stmt->execute(array($username, $hashedPass));
  $row = $stmt->fetch();
  $count = $stmt->rowCount();

  // If Count > 0 this Mean the database contain information about this Username
  if($count > 0){

    $_SESSION['Username'] = $username;
    $_SESSION['ID'] = $row['UserID'];
      header('Location: dashboard.php');
      exit();
  }

}
?>
<div class="flex-login">
<form class="login"  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
  <h4><?php echo lang("ADMIN AREA")?></h4>
  <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off">
  <input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password">
  <input class="btn btn-primary" type="submit" name="login" value="<?php echo lang("LOGS")?>">

</form>

</div>


<?php

include $tpl . "footer.php";

 ?>