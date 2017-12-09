<?php require "init/loader.php"?>
<?php
if(!isset($_SESSION["logged_in_admin_email"])){
	header("Location: adminlogin.php");  
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

	
	<?php require "layout/adminnav.php" ?>
	
	<div class="jumbotron mt-1" style="background-image: url('bq main.PNG');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;opacity: 0.8;">
  			<h1 class="display-3 text-white">BitQuiz</h1>
  			<p class="lead text-white">#1 choice for classroom quiz.</p>
	</div>
	
	<?php
	$createCourse = new Courses;
	
	if (isset($_POST["submitcrs"])){
		$ccode = $_POST["courseText"];
		$instr = $_POST["instrSelect"];
		$createCourse->createCourse($ccode,$instr);
	} 
	?>

	<div class="text-center">
		<div class="border border-dark">
			<form class="m-2" method="POST">	
				<div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="courseText">Course Code</label>
			      <input class="form-control" name="courseText" type="text" placeholder="e.g. COMP851" required>
			    </div>
			    <div class="form-group col-md-6">
			    	 
						<?php
						$usertype = "instructor";
						$showinstr = new Users();
						$showinstr->getInstr($usertype);
						?>
	
			    </div>
			  </div>
			  
			  <input type="submit" class="btn btn-primary mt-1" name="submitcrs" value="Submit"/>
			</form>
		</div>
	</div>
</body>

</html>
