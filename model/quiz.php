<?php

	class Quiz{
		protected $bq_quiz_settings = "bq_quiz_settings";
		protected $bq_courses = "bq_courses";
		protected $quiz = "quiz";
		protected $quizstudstat = "quizstudstat";
		protected $bq_users = "bq_users";
		
		
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
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sqlcheck = "SELECT quizstudstat.studentid,quizstudstat.quizid,bq_users.fName,bq_users.lName FROM $this->quizstudstat INNER JOIN $this->bq_users on quizstudstat.studentid=bq_users.id WHERE studentid = '$sid' AND quizid = '$cid'";
			$querycheck = mysqli_query($conn,$sqlcheck);
			if (mysqli_num_rows($querycheck) >= 1){
				while ($resultcheck = mysqli_fetch_assoc($querycheck)){
				echo '<div class="text-center wave alert alert-danger" role="alert">'.$resultcheck['lName'].' '.$resultcheck['fName'].' Already Registered!</div>';
				}
			}
			else{
			$sql = "INSERT INTO $this->quizstudstat (studentid,quizid) VALUES('$sid','$cid')";
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
				$sql = "INSERT INTO $this->quiz (crs_id,question,quizno,A,B,C,D,c_answer) VALUES('$crsid','$quizno','$question','$qa','$qb','$qc', '$qd','$ans')";
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
			
} 
	
?>
