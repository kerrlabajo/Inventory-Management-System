<?php

?>
<!DOCTYPE html>
<html>
	<head>
		<title> User Registration</title>
		<link rel="stylesheet" type = "text/css" href="css/bootstrap.min.css">
	</head>
	<body>

<div>
	<?php 
	
		$con = mysqli_connect("localhost","root", "","inventory_system");
		$result = $con->query("SELECT Rolenames FROM roles");
		if(isset($_POST['create'])){
			$username 	= $_POST['username'];
			$firstname 	= $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname 	= $_POST['lastname'];
			$password 	= $_POST['password'];
			$roles      = $_POST['roles'];
			
			
			$errors = array();

			$u = "SELECT userName FROM account WHERE userName = '$username'";
			$uu = mysqli_query($con,$u);
			

			if(empty($username)){
				$errors['u'] = "Username Required";
				
			}else if(mysqli_num_rows($uu) > 0)
				$errors['u'] = "Username Exists";
			

			
			
			if(count($errors)==0){
				
				$query = "INSERT INTO account(userName,firstName,middleName,lastName,passWord,role) VALUES('$username','$firstname','$middlename','$lastname','$password','$roles')";
				$result = mysqli_query($con,$query);

				if($result){
					echo "Registered";
				}
				else{
					echo "Not Registered";
				}
			}

		}
	?>
</div>

<div>
	<form action ="Register.php" method="post">
		<div class="container">

		<div class="row">
			<div class="col-sm-3">
			<h1>Registration</h1>
			<p>Please Fill up</p>
			<hr class="mb-3"> 
				<label for="username"><b>Username</b></label>
				<input class="form-control" type = "text" name = "username" required>
				<p class="text-danger">	<?php if(isset($errors['u'])) echo $errors['u'];?>	</p>

				<label for="firstname"><b>First Name</b></label>
				<input class="form-control" type = "text" name = "firstname" requiredv>

				<label for="middlename"><b>Middle Name</b></label>
				<input class="form-control" type = "text" name = "middlename" required>

				<label for="lastname"><b>Last Name</b></label>
				<input class="form-control" type = "text" name = "lastname" required>

				<label for="password"><b>Password</b></label>
				<input class="form-control" type = "password" name = "password" required><br>

				<label for="roles"><b>Roles</b></label><br>

				<select name ="roles" id = "roles">
				<option value = "0" selected = "selected">Please select your role</option>
				<option value = "Staff">Staff</option>
				<option value = "Supplier">Supplier</option>
				</select>
					
				</select>
				<hr class="mb-3">
				<input class="btn btn-primary "type="submit" name="create" value="Register">
			</div>
		</div>
		</div>
	</form>
</div>


</body>
</html>

