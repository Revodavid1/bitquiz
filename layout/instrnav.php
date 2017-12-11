<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="#">
    <img src="img/bq main.png" width="30" height="30" class="d-inline-block align-top" alt="">
    BitQuiz
  	</a>
  
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  	</button>

  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
    	<ul class="navbar-nav mr-auto">
      		<li class="nav-item">
        		<a class="nav-link" href="instrdash.php">Home <span class="sr-only">(current)</span></a>
      		</li>
      		<li class="nav-item">
        		<a class="nav-link" href="setquiz.php">Manage Quiz</a>
      		</li>
      		<li class="nav-item">
        		<a class="nav-link" href="regstudent.php">Register Students</a>
      		</li>
      		<li class="nav-item">
        		<a class="nav-link" href="viewgrades.php">View Grades</a>
      		</li>
      		<?php
      		$si_fName = $_SESSION["logged_in_instr_fName"];
			$si_lName =	$_SESSION["logged_in_instr_lName"];
			echo "
				<li class='nav-item'>
        			<h5 class='nav-link'>$si_fName $si_lName</h5>
      			</li>";
			?>
      		<form class="form-inline my-2 my-lg-0">
		      <a href="index.php" class="btn btn-outline-success my-2 my-sm-0">Logout</a>
		    </form>
    	</ul>
  </div>
  
</nav>
