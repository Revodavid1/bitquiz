<?php require "init/loader.php"?>
<?php
if(!isset($_SESSION["logged_in_stud_id"])){
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
	<?php require "layout/studnav.php" ?>	
	<div class="jumbotron mt-1" style="background-image: url('bq main.PNG');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;opacity: 0.8;">
  		<h1 class="display-3 text-white">BitQuiz</h1>
  		<p class="lead text-white">#1 choice for classroom quiz.</p>
	</div>
	
	<div>
		<div class="border border-dark mb-3">
			<form class="m-2" method="POST">	
			<div class="form-row">
				<div class="form-group col-md-12">
					<?php
						if (!isset($_SESSION["quiztotake_id"]) ){
							echo 'No selected quiz or quiz has been submitted';
						}
						else{
							$qzid = $_SESSION["quiztotake_id"];
							$getQuiz = new Quiz;
							$getQuiz->getQuiz($qzid);
						}
					?>  
				</div>
			</div>	
			</form>
		</div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script src="js/cdt.js"></script>
</html>
