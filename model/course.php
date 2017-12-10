<?php
	class Courses{
		protected $bq_courses = "bq_courses";
		protected $bq_users = "bq_users";
		protected $bq_quiz_settings = "bq_quiz_settings";
		protected $semester = "semester";
		protected $quizstudstat = "quizstudstat";
		
		//creates a course
		public function createCourse($ccode,$instr){
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sqlcrscheck = "SELECT code FROM $this->bq_courses WHERE code = '$ccode'";
			$resultcrscheck = mysqli_query($conn,$sqlcrscheck);
			$status = 'Locked';
			if (mysqli_num_rows($resultcrscheck) == 1){
				echo '<div class="text-center wave alert alert-danger" role="alert">Course Already Exists!</div>';
			}
			else{
				$sql = "INSERT INTO $this->bq_courses (code,instr,status) VALUES('$ccode','$instr','$status')";
				$result = mysqli_query($conn,$sql);	
				echo '<div class="text-center wave alert alert-success" role="alert"> "Record Saved Successfully" </div>';	
			}	
		}
		
		public function listCourseInstr(){
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT bq_courses.id,bq_courses.code,bq_users.fName,bq_users.lName FROM $this->bq_courses INNER JOIN $this->bq_users on instr=uName ORDER BY code";
			$query = mysqli_query($conn,$sql);
			echo 
				"<table class='table table-sm table-striped table-bordered table-condensed'>
  					<tr>
  						<th>Course</th>
				  		<th>Instructor</th>
				  		<th>Action</th>
    				</tr>";
			while ($result = mysqli_fetch_assoc($query)){
				echo "<tr>
					<td>".$result['code']."</td>
					<td>".$result['lName']." ".$result['fName']."</td> 
					<td>
						<button class='button btn-default clickable editinstr' crsid='".$result['id']."' crs='".$result['code']."' style='color:grey;'>Change</button>
					</td>
					</tr>";
			}
			echo "</table>";
		}
		
		public function liststudcrs(){
			$thisstud = $_SESSION["logged_in_stud_id"];
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT quizstudstat.id,quizstudstat.quizid,quizstudstat.score,bq_courses.code FROM $this->quizstudstat INNER JOIN $this->bq_courses on quizstudstat.quizid=bq_courses.id WHERE quizstudstat.studentid='$thisstud' ORDER BY quizstudstat.id";
			$query = mysqli_query($conn,$sql);
			echo 
			"<form method='POST'><table class='table table-sm table-striped table-bordered table-condensed'>
  				<tr>
  					<th>Course</th>
  					<th>Score</th>
				  	<th>Action</th>
    			</tr>";
			while ($result = mysqli_fetch_assoc($query)){
				$thiscrs = $result['code'];
				$thisscore=$result['score'];
				$thisqzid = $result["quizid"];
				echo 
				"<tr>
					<td>$thiscrs</td> 
					<td>$thisscore</td> 
					<td>";
					$sqlcheckcrs = "SELECT status FROM $this->bq_courses WHERE code='$thiscrs'";
					$querycheckcrs = mysqli_query($conn,$sqlcheckcrs);
					while ($resultcheckcrs = mysqli_fetch_assoc($querycheckcrs)){
						$crsstatus = $resultcheckcrs['status'];
						if ($crsstatus == 'Unlocked' && $thisscore == 'NA'){
							echo"<input type='submit' class='button btn-default' name='strtqz' style='color:grey;' value='Take Quiz'/>";
						}
						elseif ($crsstatus == 'Unlocked' && $thisscore!='NA'){
							echo"<p>Quiz already submitted</p>";
						}
						else{
							echo"<p>Quiz is currently unavailable.</p>";
						}
						
				}
						
			echo"</td>
				</tr>";
			}
			echo "</table></form>";
			
			
			$createCourse = new Courses;
	
			if (isset($_POST["strtqz"])){
				$_SESSION["quiztotake_id"] = $thisqzid;
				header("Location:quiztime.php");
			} 
		}
		
		public function listCourseforInstr(){
			$si_uName = $_SESSION["logged_in_instr_email"];
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT id,code,status FROM $this->bq_courses WHERE instr = '$si_uName' ORDER BY code";
			$query = mysqli_query($conn,$sql);
			echo "<table class='table table-sm table-striped table-bordered table-condensed mx-auto' style='width: 600px'>
  					<tr>
  						<th>Course</th>
				  		<th>Action</th>
    				</tr>";
			while ($result = mysqli_fetch_assoc($query)){
				$status = $result['status'];
				echo "<tr>
					<td>".$result['code']."</td> 
					<td>";
					if ($status == 'editing' || $status == 'Unlocked'){
						echo "<button class='button btn-default clickable' crsid='".$result['id']."' style='color:grey;'>Continue Setup</button>";
					}
					else{
						echo "<button class='button btn-default clickable setquiz' crssetid='".$result['id']."' crsset='".$result['code']."' style='color:grey;'>Set Quiz</button>";
					}
					if ($status == 'Locked' || $status == 'editing'){
						$btnname = 'Unlock';
					}
					else{
						$btnname = 'Lock';
					}
					echo "<button class='button btn-default clickable setlockerbtn' lckid='".$result['id']."' style='color:grey;'>$btnname</button>
					</td>
					</tr>";
			}
			echo "</table>";
		}
		
		
		public function listCourseforstudreg(){
			$si_uName = $_SESSION["logged_in_instr_email"];
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT id,code,status FROM $this->bq_courses WHERE instr = '$si_uName' ORDER BY code";
			$query = mysqli_query($conn,$sql);
			echo "
			<label>Select Course: </label>
			<select class='custom-select' name='coursetoreg' required>
			<option value=''>Select Course</option>'";
			
			while ($result = mysqli_fetch_assoc($query)){
				echo'<option value='.$result['id'].'>'.$result['code'].'</option>';
			}
			echo "</select>";
		}
		
			//update course
		public function updateCrs($id,$instr){
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "UPDATE $this->bq_courses SET instr = '$instr' WHERE id = '$id'";
			$result = mysqli_query($conn,$sql);
			header("Refresh:0;chginstr.php");
		}
		
			//update status
		public function editcourseLock($courseid){
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT status FROM $this->bq_courses WHERE id = '$courseid'";
			$query = mysqli_query($conn,$sql);
			while ($result = mysqli_fetch_assoc($query)){
				$status = $result['status'];
				if ($status=='Locked' || $status=='editing'){
					$sqlupdunlock = "UPDATE $this->bq_courses SET status = 'Unlocked' WHERE id = '$courseid'";
					$resultupdunlock = mysqli_query($conn,$sqlupdunlock);		
				}
				else{
					$sqlupdlock = "UPDATE $this->bq_courses SET status = 'editing' WHERE id = '$courseid'";
					$resultupdlock = mysqli_query($conn,$sqlupdlock);
				}
			}
			header("Refresh:0;setquiz.php");
		}

}
?>
