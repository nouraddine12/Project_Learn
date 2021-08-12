<?php

/*


=================================
==Manage Members Page
*/

session_start();
$pageTitle = 'Members';
if(isset($_SESSION['Username'])){
	include 'init.php';
	

	$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

	if($do == 'Manage'){

		$query = '';

		if(isset($_GET['page']) && $_GET['page'] == 'Pending'){
			$query = 'AND RegStatus = 0';
		}





		$stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query");
		$stmt -> execute();
		$rows = $stmt->fetchAll();

		?>
		<h1 class="text-center">Members</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="table table-bordered main-table text-center">
					<tr>
						<td>#ID</td>
						<td>Username</td>
						<td>Email</td>
						<td>Full Name</td>
						<td>Registred Date</td>
						<td>Control</td>
					</tr>

					<?php 

						foreach($rows as $row){
							echo "<tr>";
							echo "<td>" . $row['UserID'] . "</td>";
							echo "<td>" . $row['Username'] . "</td>";
							echo "<td>" . $row['Email'] . "</td>";
							echo "<td>" . $row['FullName'] . "</td>";
							echo "<td>" . $row['Date'] . "</td>";

							echo "<td>
							 <a href='members.php?do=Edit&userid=" . $row['UserID'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
							 <a href='members.php?do=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>";
							 if($row['RegStatus'] == 0){
							 	echo "<a href='members.php?do=Activate&userid=" . $row['UserID'] . "' class='btn btn-info activate'><i class='fa fa-close'></i> Approve</a>";	
							 };

							echo "</td>";
							echo "</tr>";


						}
					?>
				</table>
			</div>
			<a href="?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Members</a>
		</div>
		


		<?php
	}elseif($do == 'Edit'){

		$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
			$stmt = $con->prepare("SELECT * FROM users WHERE UserID=?");
			$stmt->execute(array($userid));
			$row = $stmt-> fetch();
			$count = $stmt->rowCount();

			if($stmt->rowCount() > 0){
				

		?>

		<h1 class="text-center">Edit Member</h1>
		<div class="container form-edit">
			
			<form action="?do=Update" method="POST">
				<input type="hidden" name="userid" value="<?php echo $userid?>">
				<div class="row mb-3">
					<label class="col-sm-2 col-form-label"><?php echo lang('USERNAME')?>:</label>
					<div class="col-sm-10 col-md-6">
						<input type="text" name="username" class="form-control" value="<?php echo $row['Username']?>" required="required"/>
					</div>
				</div>

				<div class="row mb-3">
					<label class="col-sm-2 col-form-label"><?php echo lang('PASSWORD')?>:</label>
					<div class="col-sm-10 col-md-6">
						<input type="hidden" name="oldpassword" value="<?php echo $row['Password']?>" />
						<input type="password" name="newpassword" class="form-control" placeholder="Leave Blank if You Dont To Change" />
					</div>
				</div>


				<div class="row mb-3">
					<label class="col-sm-2 col-form-label"><?php echo lang('EMAIL')?>:</label>
					<div class="col-sm-10 col-md-6">
						<input type="email" name="email" class="form-control" value="<?php echo $row['Email']?>" required="required"/>
					</div>
				</div>


				<div class="row mb-3">
					<label class="col-sm-2 col-form-label"><?php echo lang('FULL NAME')?>:</label>
					<div class="col-sm-10 col-md-6">
						<input type="text" name="full" class="form-control" value="<?php echo $row['FullName']?>" required="required"/>
					</div>
				</div>


				<div class="row mb-3">
					<div class="offset-sm-2 col-sm-10">
						<input type="submit" value="<?php echo lang('UPDATE_')?>" class="btn btn-primary"/>
					</div>
				</div>

			</form>
		</div>


		<?php

					}else{
				$theMsg =  "<div class='alert alert-danger'>not exist this  Userid</div>";
				redirectHome($theMsg);
			}

	}elseif($do == 'Update'){

		echo '<h1 class="text-center">Update Member</h1>';
		echo "<div class='container'>";

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$id = $_POST['userid'];
			$user = $_POST['username'];
			$email = $_POST['email'];
			$name = $_POST['full'];


			$pass = '';
			if(empty($_POST['newpassword'])){
				$pass = $_POST['oldpassword'];
			}else{
				$pass = sha1($_POST['newpassword']);
			}

			// Validation The Form
			$formErrors = array();

			if(strlen($user) < 4){
				$formErrors[] ='<div class="alert alert-danger">Username Cant Be Less Than 4 Character</div>'; 
			}
			if(strlen($name) > 20){
				$formErrors[] ='<div class="alert alert-danger">Name Cant Be Less Than 20 Character</div>'; 
			}
			if(empty($user)){
				$formErrors[] ='<div class="alert alert-danger">Username Cant Be Empty</div>'; 
			}
			if(empty($name)){
				$formErrors[] ='<div class="alert alert-danger">Name Cant Be Empty</div>'; 
			}
			if(empty($email)){
				$formErrors[] ='<div class="alert alert-danger">Email Cant Be Empty</div>'; 
			}

			foreach ($formErrors as $error) {
				echo $error;
			}


			if(empty($formErrors)){
			$stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ? WHERE UserID = ?");
			$stmt->execute(array($user, $email, $name, $pass, $id));

			$theMsg = "<div class='alert alert-primary'>" . $stmt->rowCount(). ' Record Updates</div>';
			redirectHome($theMsg, 'back');
			}
		}else{

			$theMsg = '<div class="alert alert-danger">Sorry You Cant Browser this page Directly</div>';
			redirectHome($theMsg, 3);
		}

	}elseif($do == 'Add'){
		 // Add Members Page
		?>

		<h1 class="text-center">Add New Member</h1>
		<div class="container form-edit">
			
			<form action="?do=Instert" method="POST">
				<div class="row mb-3">
					<label class="col-sm-2 col-form-label"><?php echo lang('USERNAME')?>:</label>
					<div class="col-sm-10 col-md-6">
						<input type="text" name="username" class="form-control" required="required" placeholder="Your Username" />
					</div>
				</div>

				<div class="row mb-3">
					<label class="col-sm-2 col-form-label"><?php echo lang('PASSWORD')?>:</label>
					<div class="col-sm-10 col-md-6">
						<input type="password" name="password" class="form-control password" placeholder="Your Password" required="required" />
						<i class="show-pass fa fa-eye fa-2x"></i>
					</div>
				</div>


				<div class="row mb-3">
					<label class="col-sm-2 col-form-label"><?php echo lang('EMAIL')?>:</label>
					<div class="col-sm-10 col-md-6">
						<input type="email" name="email" class="form-control" required="required" placeholder="Your Email"/>
					</div>
				</div>


				<div class="row mb-3">
					<label class="col-sm-2 col-form-label"><?php echo lang('FULL NAME')?>:</label>
					<div class="col-sm-10 col-md-6">
						<input type="text" name="full" class="form-control" required="required" placeholder="Your Full Name"/>
					</div>
				</div>


				<div class="row mb-3">
					<div class="offset-sm-2 col-sm-10">
						<input type="submit" value="<?php echo lang('ADD_')?>" class="btn btn-primary"/>
					</div>
				</div>

			</form>
		</div>




		<?php


	}elseif($do == 'Instert'){


		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			echo '<h1 class="text-center">Update Member</h1>';
			echo "<div class='container'>";
			$user = $_POST['username'];
			$pass = $_POST['password'];
			$email = $_POST['email'];
			$name = $_POST['full'];


			$hashPass = sha1($pass);

			// Validation The Form
			$formErrors = array();

			if(strlen($user) < 4){
				$formErrors[] ='<div class="alert alert-danger">Username Cant Be Less Than 4 Character</div>'; 
			}
			if(strlen($name) > 20){
				$formErrors[] ='<div class="alert alert-danger">Name Cant Be Less Than 20 Character</div>'; 
			}
			if(empty($user)){
				$formErrors[] ='<div class="alert alert-danger">Username Cant Be Empty</div>'; 
			}
			if(empty($pass)){
				$formErrors[] ='<div class="alert alert-danger">Password Cant Be Empty</div>'; 
			}
			if(empty($name)){
				$formErrors[] ='<div class="alert alert-danger">Name Cant Be Empty</div>'; 
			}
			if(empty($email)){
				$formErrors[] ='<div class="alert alert-danger">Email Cant Be Empty</div>'; 
			}

			foreach ($formErrors as $error) {
				echo $error;
			}


			if(empty($formErrors)){

				$check = checkItem("Username", "users", $user);

				if($check == 1){


					$theMsg =  '<div class="alert alert-danger">Sorry This User Is Exist</div>';
					redirectHome($theMsg);
				}else{



				$stmt = $con->prepare("INSERT INTO 
											users(Username,Password,Email,FullName,RegStatus,Date)
										VALUES(:zuser,:zpass,:zemail,:zname, 1,now())");
				$stmt->execute(array(

					'zuser' => $user,
					'zpass' => $hashPass,
					'zemail' => $email,
					'zname' => $name

				));


			$theMsg =  "<div class='alert alert-primary'>" . $stmt->rowCount(). ' Record Insert</div>';
			redirectHome($theMsg, 'back');
			}
			}
		}else{

			$theMsg = '<div class="alert alert-danger">Sorry You Cant Browser this page Directly</div>';
			redirectHome($theMsg, 'back');
		}




	}elseif($do == 'Delete'){

		echo "<h1 class='text-center'>Delete Member</h1>";
		echo "<div class='container'>";

			$userid =  isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

			$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");

			$stmt -> execute(array($userid));

			$count = $stmt->rowCount();

			if($count > 0){
				$stmt = $con->prepare('DELETE FROM users WHERE UserID = :zuser');
				$stmt->bindParam(":zuser", $userid);
				$stmt->execute();

				$theMsg =  "<div class='alert alert-primary'>" . $stmt->rowCount(). ' Record Deleted</div>';
				redirectHome($theMsg, 'back');

			}else{
				$theMsg = "<div class='alert alert-danger'>This ID is Not Exist</div>";
				redirectHome($theMsg, 'back');
			}

			echo "</div>";

	}elseif($do == 'Activate'){

		echo "<h1 class='text-center'>Activate Member</h1>";
		echo "<div class='container'>";

			$userid =  isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

			$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");

			$stmt -> execute(array($userid));

			$count = $stmt->rowCount();

			if($count > 0){
				$stmt = $con->prepare('UPDATE users SET RegStatus = 1 WHERE UserID = ?');
				$stmt->execute(array($userid));

				$theMsg =  "<div class='alert alert-primary'>" . $stmt->rowCount(). ' Record Activated</div>';
				redirectHome($theMsg, 'back');

			}else{
				$theMsg = "<div class='alert alert-danger'>  ID is Not Exist</div>";
				redirectHome($theMsg, 'back');
			}

			echo "</div>";

	}else{
		$theMsg =  "<div class='alert alert-danger'>Error No Page With This Name</div>";
		redirectHome($theMsg);
	}


	echo "</div>";
	include $tpl . 'footer.php';

}else{
	header('Location: index.php');
	exit();
}
?>