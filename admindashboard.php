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
	
	<div>
		<div class="row">
		  <div class="col-sm-6">
		    <div class="card">
		      <div class="card-body">
		        <h4 class="card-title">Add Students or Instructors</h4>
		        <p class="card-text">Use this feature to create new students or instructors on this platform.</p>
		        <a href="adduser.php" class="btn btn-light">Add</a>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-6">
		    <div class="card">
		      <div class="card-body">
		        <h4 class="card-title">Change Quiz Instructors</h4>
		        <p class="card-text">Use this feature to assign quiz to intructors. </p>
		        <a href="chginstr.php" class="btn btn-light">Change</a>
		      </div>
		    </div>
		  </div>
		</div>
		<div class="row">
		<div class="col-sm-6">
		    <div class="card">
		      <div class="card-body">
		        <h4 class="card-title">Add Courses</h4>
		        <p class="card-text">Use this add courses on this platform.</p>
		        <a href="addcourse.php" class="btn btn-light">Add</a>
		      </div>
		    </div>
		  </div>
		 <div class="col-sm-6">
		    <div class="card">
		      <div class="card-body">
		        <h4 class="card-title">Set Semester</h4>
		        <p class="card-text">Set semester to current semester.</p>
		        <a href="setsmster.php" class="btn btn-light">Set</a>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</body>

</html>
