<?php require "init/loader.php"?>
<?php
if(!isset($_SESSION["logged_in_instr_id"])){
	header("Location: index.php");  
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
	<?php require "layout/instrnav.php" ?>
	
	<div class="jumbotron mt-1" style="background-image: url('bq main.PNG');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;opacity: 0.8;">
  			<h1 class="display-3 text-white">BitQuiz</h1>
  			<p class="lead text-white">#1 choice for classroom quiz.</p>
	</div>
	
	<div>
		<div class="row">
		  <div class="col-sm-6">
		    <div class="card">
		      <div class="card-body">
		        <h4 class="card-title">Manage Quiz</h4>
		        <p class="card-text">Create or Edit Quiz.</p>
		        <a href="setquiz.php" class="btn btn-light">Manage</a>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-6">
		    <div class="card">
		      <div class="card-body">
		        <h4 class="card-title">Register Students</h4>
		        <p class="card-text">Enroll Students to take quiz. </p>
		        <a href="regstudent.php" class="btn btn-light">Change</a>
		      </div>
		    </div>
		  </div>
		</div>
		<div class="row">
		<div class="col-sm-6">
		    <div class="card">
		      <div class="card-body">
		        <h4 class="card-title">View Grades</h4>
		        <p class="card-text">View Completed Quiz.</p>
		        <a href="viewgrades.php" class="btn btn-light">View</a>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</body>

</html>
