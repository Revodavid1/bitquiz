<?php

	class Quiz{
		protected $bq_quiz_settings = "bq_quiz_settings";
		protected $bq_courses = "bq_courses";
		protected $quiz = "quiz";
		protected $quizstudstat = "quizstudstat";
		protected $bq_users = "bq_users";
		protected $bq_quiz_taken = "bq_quiz_taken";
		
		
		public function addquizSettings($crsid,$crsem,$qzqty,$qztime,$instrid){
			$status = 'editing';
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "INSERT INTO $this->bq_quiz_settings (crsid,crsemester,qzqty,time,instructorid) VALUES('$crsid','$crsem','$qzqty','$qztime', '$instrid')";
			$result = mysqli_query($conn,$sql);	
			$sqlb = "UPDATE $this->bq_courses SET status = '$status' WHERE id = '$crsid'";
			$resultb = mysqli_query($conn,$sqlb);	
			header("Location:quizedit.php");
		}
		
		public function regStudsforquiz($sid,$cid){
			$curr_sem = $_SESSION["curr_sem"];
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sqlcheck = "SELECT quizstudstat.studentid,quizstudstat.quizid,bq_users.fName,bq_users.lName FROM $this->quizstudstat INNER JOIN $this->bq_users on quizstudstat.studentid=bq_users.id WHERE studentid = '$sid' AND quizid = '$cid' AND semester='$curr_sem'";
			$querycheck = mysqli_query($conn,$sqlcheck);
			if (mysqli_num_rows($querycheck) >= 1){
				while ($resultcheck = mysqli_fetch_assoc($querycheck)){
				echo '<div class="text-center wave alert alert-danger" role="alert">'.$resultcheck['lName'].' '.$resultcheck['fName'].' Already Registered!</div>';
				}
			}
			else{
			$sql = "INSERT INTO $this->quizstudstat (studentid,quizid,score,semester) VALUES('$sid','$cid','NA','$curr_sem')";
			$result = mysqli_query($conn,$sql);	
			echo '<div class="text-center wave alert alert-success" role="alert"> "One or More Student Saved Successfully" </div>';	
			}
		}
		
		public function enterQAs(){
			$crsid = $_SESSION["current_crsid"];
			$crsem = $_SESSION["current_crsem"];
			
			
			if (isset($_POST["sbQs"])){
				$getcount = $_SESSION["current_qzqty"];
				for ($i = 1; $i <= $getcount;$i++){
				$quizno = $i;
				$question = $_POST["Question$i"];
				$qa = $_POST["a$i"];
				$qb = $_POST["b$i"];
				$qc = $_POST["c$i"];
				$qd = $_POST["d$i"];
				$ans = $_POST["ans$i"];
				$conn = new mysqli("localhost", "root", "", "bqdb");
				$sql = "INSERT INTO $this->quiz (crs_id,question,quizno,A,B,C,D,c_answer) VALUES('$crsid','$question','$quizno','$qa','$qb','$qc', '$qd','$ans')";
				$result = mysqli_query($conn,$sql);	
				unset($_SESSION["current_crsid"]);
				header("Location:setquiz.php");	
			}
			} 
			
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT bq_quiz_settings.id,bq_quiz_settings.crsemester,bq_quiz_settings.time,bq_quiz_settings.qzqty,bq_courses.code FROM $this->bq_quiz_settings INNER JOIN $this->bq_courses on crsid=bq_courses.id WHERE crsid='$crsid' AND crsemester='$crsem' LIMIT 1";
			$query = mysqli_query($conn,$sql);
			
			echo "<form method='POST'><table class='table table-xs table-striped table-bordered table-condensed'>
					<tr>
  						<th>Course</th>
				  		<th>Semester</th>
				  		<th>Quiz Time</th>
    				</tr>";
			while ($result = mysqli_fetch_assoc($query)){
				echo "<tr>
					<td>".$result['code']."</td>
					<td>".$result['crsemester']."</td>
					<td>".$result['time']." minutes</td> 
					</tr>";
					
				echo "</table>";
				for ($i = 1; $i <= $result['qzqty'];$i++){
					echo"<div class='card'>
						<div class='card-body'>
					    <h4 class='card-title'>Question .$i.</h4>
					    <textarea class='form-control'  rows='2' name='Question$i' required></textarea></td>
					    <input class='form-control' type='text' name='a$i' placeholder='Option A' required>
					    <input class='form-control' type='text' name='b$i' placeholder='Option B' required>
					    <input class='form-control' type='text' name='c$i' placeholder='Option C' required>
					    <input class='form-control' type='text' name='d$i' placeholder='Option D' required>
					    <label>Correct Answer: <span><select class='form-control form-control-sm' name='ans$i' required>
							<option value=''>--</option>
							<option value='A'>A</option>
							<option value='B'>B</option>
							<option value='C'>C</option>
							<option value='D'>D</option>
						</select></span></label>
					    </div>
						</div>";
				}	
				
			}
			
			echo "<button type='submit' class='btn btn-success mt-1' name='sbQs' id='sbQs'>Submit</button>";
			echo"</form>";
		}
		
		
		public function getQuiz($qzid){
			$thisstud = $_SESSION["logged_in_stud_id"];
			$curr_sem = $_SESSION["curr_sem"];
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT bq_courses.code,bq_quiz_settings.time,bq_quiz_settings.qzqty FROM $this->bq_courses INNER JOIN $this->bq_quiz_settings on bq_courses.id=bq_quiz_settings.crsid WHERE bq_courses.id = '$qzid'";
			$query = mysqli_query($conn,$sql);
			while ($result = mysqli_fetch_assoc($query)){
				$qzqty = $result['qzqty'];
				echo"<h6>Course: ".$result['code']."</h6>
				<h6>Time: ".$result['time']." mins</h6>
				<h6>No of Questions: ".$result['qzqty']."</h6>";
				
			}
			$sqlqz = "SELECT * FROM $this->quiz WHERE crs_id = '$qzid'";
			$queryqz = mysqli_query($conn,$sqlqz);
			$i = 1;
			echo"<form method='POST' class='mb-2'>";
			
			
			if (isset($_POST["subqz"])){
				for($i=1;$i<=$qzqty;$i++){
					if(isset($_POST["question$i"])){
						$thisanswer = $_POST["question$i"];
					}
					else{
						$thisanswer = 'blank';
					}
					$conn = new mysqli("localhost", "root", "", "bqdb");
					$sqlsaveans = "INSERT INTO $this->bq_quiz_taken (qzid,studid,qzno,answer,semester) VALUES('$qzid','$thisstud','$i','$thisanswer','$curr_sem')";
					$resultsaveans = mysqli_query($conn,$sqlsaveans);
				}
			$_SESSION["quiztoshowscoreid"] = $qzid;
			unset($_SESSION["quiztotake_id"]);
			header("Location:showscore.php");
			}
			
			
			while ($resultqz = mysqli_fetch_assoc($queryqz)){
				echo 
				"<div class='card'>
					<div class='card-body'>
				    	<h4 class='card-title'>Question $i: ".$resultqz['question']."</h4>
				    	
				    	<div class='form-check'>
				    		<label class='form-check-label'>
						    <input class='form-check-input' type='radio' name='question$i' id='AA' value='A'>
						    ".$resultqz['A']."
						  	</label>
						</div>
						<div class='form-check'>
				    		<label class='form-check-label'>
						    <input class='form-check-input' type='radio' name='question$i' id='check$i' value='B'>
						    ".$resultqz['B']."
						  	</label>
						</div>
						<div class='form-check'>
				    		<label class='form-check-label'>
						    <input class='form-check-input' type='radio' name='question$i' id='check$i' value='C'>
						    ".$resultqz['C']."
						  	</label>
						</div>
						<div class='form-check'>
				    		<label class='form-check-label'>
						    <input class='form-check-input' type='radio' name='question$i' id='check$i' value='D'>
						    ".$resultqz['D']."
						  	</label>
						</div>
				  	</div>
				</div>";
			$i++;
			}
			echo "<button type='submit' class='btn btn-success mt-1' name='subqz'>Submit</button>";
			echo"</form>";
		}

		public function showScore($qzid,$studid,$cursem){
			$score = 0;
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT * FROM $this->bq_quiz_taken WHERE qzid = '$qzid' AND studid = '$studid' AND semester = '$cursem'";
			$query = mysqli_query($conn,$sql);
			while ($result = mysqli_fetch_assoc($query)){
				$thisqzno = $result['qzno'];
				$studans = $result['answer'];
				$sqlcrossans = "SELECT * FROM $this->quiz WHERE crs_id = '$qzid' AND quizno = '$thisqzno'";
				$querycrossans = mysqli_query($conn,$sqlcrossans);
				while ($resultcrossans = mysqli_fetch_assoc($querycrossans)){
					$correctanswer = $resultcrossans['c_answer'];
					if ($studans == $correctanswer){
						$score++;
					}
				}
			}
			echo "<div class='card'>
  				<div class='card-body'>
    				<h4>Your Final Score is</h4>
    				<h3>$score</h3>
  				</div>
				</div>";
			
			$sqlupdscore = "UPDATE $this->quizstudstat SET score='$score' WHERE studentid='$studid' AND quizid='$qzid'";
			$resultupdscore = mysqli_query($conn,$sqlupdscore);
		}
		
		
		public function listgradeperinstr(){
			$curr_sem = $_SESSION["curr_sem"];
			$si_id = $_SESSION["logged_in_instr_id"];
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT bq_quiz_settings.crsid,bq_quiz_settings.qzqty,quizstudstat.studentid,quizstudstat.score FROM $this->bq_quiz_settings INNER JOIN $this->quizstudstat on bq_quiz_settings.crsid=quizstudstat.quizid WHERE bq_quiz_settings.instructorid = '$si_id' AND crsemester='$curr_sem'";
			$query = mysqli_query($conn,$sql);
			
			echo"
				<table class='table table-sm'>
				  <thead>
				    <tr>
				      <th scope='col'>Course</th>
				      <th scope='col'># of Questions</th>
				      <th scope='col'>Student Name & Score</th>
				    </tr>
				  </thead>
				  <tbody>
			";
			while ($result = mysqli_fetch_assoc($query)){
				$crs = $result['crsid'];
				$qty = $result['qzqty'];
				$sid = $result['studentid'];
				$score = $result['score'];
				echo"
			    	<tr>";
			    	$conn = new mysqli("localhost", "root", "", "bqdb");
					$sqlgetcode = "SELECT code FROM $this->bq_courses WHERE id = '$crs'";
					$querygetcode = mysqli_query($conn,$sqlgetcode);
					while ($resultquerygetcode = mysqli_fetch_assoc($querygetcode)){
						$thiscode=$resultquerygetcode['code'];
						echo"<td>$thiscode</td>";
					}
					
					$conn = new mysqli("localhost", "root", "", "bqdb");
					$sqlgetname = "SELECT fName,lName FROM $this->bq_users WHERE id = '$sid'";
					$querygetname = mysqli_query($conn,$sqlgetname);
					while ($resultquerygetname = mysqli_fetch_assoc($querygetname)){
						$fName = $resultquerygetname['fName'];
						$lName=$resultquerygetname['lName'];
						$scorezone = $qty / 2;
						echo"<td>$qty</td>
				      	<td>$fName $lName";
				      		if ($score == 'NA'){
								echo "<span class='badge badge-warning badge-pill ml-1'>$score</span>";
							}
				      		elseif ($score >= $scorezone ){
								echo "<span class='badge badge-success badge-pill ml-1'>$score</span>";
							}
							else{
								echo "<span class='badge badge-danger badge-pill ml-1'>$score</span>";
							}
   						 	
   					   	echo"</td>";
					}
					
						
				    echo"</tr> 
			    ";
			}
		echo"</tbody>
			</table>";
		}
		
			
} 
	
?>
