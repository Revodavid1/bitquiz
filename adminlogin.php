<?php require "init/loader.php"?>
<?php	
	//Logout
	if(isset($_SESSION["logged_in_admin_email"])){
		unset($_SESSION["logged_in_admin_email"]);
		session_destroy();
		//redirect to index
		header("Location: adminlogin.php");
		exit();
	}
?>
<html>

<head>
	<title>BitQuiz</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="icon" type="image" href="img/bq main.PNG"/>
</head>


<body class="container">
	
	<?php
	$adminlogin = new Users;
	
	if (isset($_POST["adminlogin"])){	
		if ($_POST["inputUsername"] === "" || $_POST["studentPassword"] === ""){
			echo '<div class="text-center wave alert alert-danger" role="alert">Fill In All Fields</div>';
		}
		else{
			$inputUsername = $_POST["inputUsername"];
			$studentPassword = $_POST["studentPassword"];
			$adminlogin->adminLogin($inputUsername,$studentPassword);		
		}
	}
	?>

	<div class="text-center" style="margin-top: 40px">
		<div class="card bg-light mb-3">
  			<div class="card-header text-center">Admin Login</div>
			<div class="card-body">
				<div class="container">
					<h4 class="card-title text-left">Log into your account</h4>
				</div>
			
		    	<form class="container" method="POST">
					<div class="form-group container text-left">
				    	<label for="studentUsername">Username</label>
				    <input type="username" class="form-control" id="inputUsername" name="inputUsername" placeholder="Enter Username">
					</div>
					<div class="form-group container text-left">
						<label for="studentPassword">Password</label>
				    	<input type="password" class="form-control" id="studentPassword" name="studentPassword" placeholder="Enter Password">
					</div>
			 		 <div class="container text-left">
			  			<button type="submit" class="btn btn-primary" name="adminlogin">Submit</button>
			  		</div>
				</form>
			</div>
		</div>
	</div>
	
		
</body>

</html>
