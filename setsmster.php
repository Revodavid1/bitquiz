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
	$saveSemester = new Semester;
	
	if (isset($_POST["saveSmster"])){
		$smter = $_POST["semester"];
		$year = $_POST["smsYear"];
		$fullsemester = $smter.' '.$year;
		$saveSemester->updSmster($fullsemester);
	} 
	?>

	<div class="text-center">
		<div class="border border-dark">
			<form class="m-2" method="POST">	
				<div class="row">
			    <div class="col-md-12">
			      <label>Current Semester: 
			      <span> 
			      	<?php
			      		$chkSmster = new Semester();
			      		$chkSmster -> chkSmster();	
			      	?>
			      	</span> 
			      	</label>
			     </div>
			     </div>
			    <div class="row">
			    <div class="form-inline col-md-12">
			      <label class="col-md-4 form-group">Set Semester: </label> 
			      	<select class="col-md-4 form-control form-control-sm form-group" name="semester" required>
			      		<option value="">Select Semester</option>
			      		<option value="Fall">Fall</option>
			      		<option value="Spring">Spring</option>
			      		<option value="Summer">Summer</option>
			      	</select>
			      	
			      	<input type="text" class="col-md-4 ml-1 text-center form-control-sm" name="smsYear" placeholder="YEAR" value="<?php echo Date('Y');?>" required/>
			     </div>
			     </div>
			  
			  <input type="submit" class="btn btn-primary mt-1" name="saveSmster" value="Save"/>
			</form>
		</div>
	</div>
</body>

</html>