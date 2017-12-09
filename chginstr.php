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
	
	

	<div class="text-center">
		<div class="border border-dark">
			<form class="m-2" method="POST">	
			<div class="form-row">
		    	<div class="form-group col-md-12">
					<?php
						$listinstr = new Courses();
						$listinstr->listCourseInstr();
					?>  
				</div>
			</div>
				
			<?php
				$updateCrsInstr = new Courses;
					if (isset($_POST["changecrsinstr"])){
						$id = $_POST["crsid"];
						$instr = $_POST["instrSelect"];
						$updateCrsInstr->updateCrs($id,$instr);
					} 
			?>
				
				
			<!-- Modal -->
			<div class="modal fade" id="chginstrModal" tabindex="-1" role="dialog" aria-labelledby="chginstrModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Set New Instructor</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        	<span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      	<form method="POST">
			        	<div class="form-group">
			          		<textarea  style="display: none" name="crsid" id="crsid-display"></textarea>		
			            	<label>Course: <span><label name="coursename" id="crsname-display"></label></span></label>			
			          	</div>
			          	<div class="form-group">
				            <?php
								$usertype = "instructor";
								$showinstr = new Users();
								$showinstr->getInstr($usertype);
							?>
			          	</div>
			          
			          	<div class="modal-footer">
			        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        		<button type="submit" class="btn btn-success" name="changecrsinstr" id="changecrsinstr">Change</button>
			      		</div>
			        </form>
			      </div>
			    </div>
			  </div>
			 </div>
			 <!-- End Modal -->
			</form>
		</div>
	</div>
		

</body>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script src="js/application.js"></script>
</html>
