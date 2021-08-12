<?php

session_start();
$pageTitle = 'Dashboard';
if(isset($_SESSION['Username'])){

  include 'init.php';


  
    ?>

    <div class="container home-stats text-center">
      
      <h1>Dashboard</h1>
      <div class="row">
        <div class="col-md-3">
          <div class="stat">Total Members
            <span><a href="members.php"><?php echo countItems('UserID','users');?></a></span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat">Pending Members
            <span><a href="members.php?do=Manage&page=Pending"><?php echo countItems('RegStatus','users');?></a></span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat">Totale Items
            <span><a href="members.php">200</a></span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat">Totale Comments
            <span><a href="members.php">200</a></span>
          </div>
        </div>
      </div>
    </div>
    <div class="container latest">
        <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header">
                 <i class="fa fa-users"></i>Latest Registerd Users
              </div>
              <div class="card-body">
                Test
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header">
                 <i class="fa fa-tag"></i>Latest Items
              </div>
              <div class="card-body">
                Test
              </div>
            </div>
          </div>
        </div>
    </div>


    <?php


  include $tpl . "footer.php";
}else{
  echo "Your Are Not Authorized To  view  This Page";
}




?>