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
	
	<?php
	$addStudentstoquiz = new Quiz;
	if (isset($_POST["submitstdreg"])){
		$coursetotest=$_POST['coursetoreg'];
		foreach ($_POST['studsreg'] as $regstud)
	    {
	    $addStudentstoquiz->regStudsforquiz($regstud,$coursetotest);
	    }
	} 
	?>

	<div class="text-center">
		<div class="border border-dark">
			<form class="m-2" method="POST" onsubmit="getallregstuds()">	
			<div class="form-row">
				<div class="form-group col-md-3 mb-3">
			    	<div class="form-group">
					    <?php
							$listcourse = new Courses();
							$listcourse->listCourseforstudreg();
						?>  
					</div>
			    </div>
				<div class="form-group col-md-3 mb-3">
			    	<div class="form-group">
						<select name="studstoreg" class="custom-select" id="studstoreg" multiple>
						  <?php
							$studtoreg = new Users();
							$studtoreg->getstds('student');
							?>  
						</select>
					</div>
			    </div>
			    
			    <div class="form-group col-md-3 mb-3">
			    	<div class="form-group">
			    		<div class="subject-info-arrows text-center">
				  			<input type="button" id="regRight" value="Add" class="btn btn-default" /><br />
				  			<input type="button" id="unregLeft" value="Remove" class="btn btn-default mt-1"/><br />
						</div>
					</div>
				</div>
			  
			   	<div class="form-group col-md-3 mb-3">
			    	<div class="form-group">
						<select name="studsreg[]" class="custom-select" id="studsreg" multiple>
						</select>
					</div>
			    </div>
			</div>
			 <input type="submit" class="btn btn-primary mt-1" id="submitstdreg" name="submitstdreg" value="Submit"/>
			</form>
		</div>
	</div>
	
	
	
</body>
<script type="text/javascript">
    function getallregstuds() 
    { 
        allregstuds = document.getElementById("studsreg");

        for (var i = 0; i < allregstuds.options.length; i++) 
        { 
             allregstuds.options[i].selected = true; 
        } 
    }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script src="js/application.js"></script>
</html>
