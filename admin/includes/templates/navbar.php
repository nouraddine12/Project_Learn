<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">


    <a class="navbar-brand" href="#"><?php echo lang("ADMIN")?></a>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>



    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#"><?php echo lang("HOME")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php"><?php echo lang("DASHBOARD")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("GATEGORY")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="members.php"><?php echo lang("MEMBERS")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("STATISTICS")?></a>
        </li>
 		<li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("ITEMS")?></a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
      	<li class="dropdown">
      		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      			<?php echo lang("ADMIN")?>
      		</a>
      		<ul class="dropdown-menu" aria-labelledby="navbarDropdown">

      			<li>
      				<a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']?>"><?php echo lang("EDIT PROFILE")?></a>
      			</li>
      			
      			<li>
      				<a href="" class="dropdown-item"><?php echo lang("SETTINGS")?></a>
      			</li>

      			<li>
      				<a href="logout.php" class="dropdown-item"><?php echo lang("LOUGOUT")?></a>
      			</li>

      		</ul>
      	</li>
      </ul>
    </div>


  </div>
</nav>