<?php require "init/loader.php"?>
<?php	
	//Logout
	if(isset($_SESSION["logged_in_instr_id"])){
		unset($_SESSION["logged_in_instr_id"]);
		session_destroy();
		//redirect to index
		header("Location: index.php");
		exit();
	}
	if(isset($_SESSION["logged_in_stud_id"])){
		unset($_SESSION["logged_in_stud_id"]);
		session_destroy();
		//redirect to index
		header("Location: index.php");
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
	<div class="jumbotron" style="background-image: url('bq main.PNG');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;opacity: 0.8;">
  		<h1 class="display-3 text-white">BitQuiz</h1>
  		<p class="lead text-white">#1 choice for classroom quiz.</p>
	</div>
		
	<?php
		$silogin = new Users;
		if (isset($_POST["sisubmit"])){	
			$Username = $_POST["InputEmail1"];
			$studentPassword = $_POST["studentPassword"];
			$silogin->instrstudLogin($Username,$studentPassword);		
		}
	?>
	
	<div class="card bg-light mb-3">
  		<div class="card-header">Instructor or Student Login</div>
		<div class="card-body">
			<div class="container">
				<h4 class="card-title">Log into your account</h4>
			</div>
			
		    <form class="container" method="POST">
				<div class="form-group container">
				    <label for="studentEmail">Email address</label>
				    <input type="email" class="form-control" id="InputEmail1" name="InputEmail1" aria-describedby="emailHelp" placeholder="Enter e-mail" required>
				</div>
				<div class="form-group container">
					<label for="studentPassword">Password</label>
				    <input type="password" class="form-control" id="studentPassword" name="studentPassword" placeholder="Enter Password" required>
				</div>
			  
			  	<div class="container">
			  		<button type="submit" name="sisubmit" class="btn btn-primary">Submit</button>
			  	</div>
			</form>
		</div>
	</div>
		
</body>

</html>
