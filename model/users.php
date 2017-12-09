<?php

class Users{
		protected $bq_users = "bq_users";
		
		//admin login
		public function adminLogin($username,$pswd){
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT * FROM $this->bq_users WHERE uName = '$username' AND uPass = '$pswd'";
			$result = mysqli_query($conn,$sql);
			while($query = mysqli_fetch_assoc($result)){
			$a_email = $query['uName'];
			$_SESSION["logged_in_admin_email"] = $a_email;
			}
			//checks to see if user exists
			if (mysqli_num_rows($result) == 1){
				header("Location:admindashboard.php");
			}
			else{
				echo '<div class="text-center wave alert alert-danger" role="alert">Invalid Login Details</div>';
			}	
		}
		
		//instructor or student login
		public function instrstudLogin($username,$pswd){
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$hashpass = md5($pswd);
			$sql = "SELECT * FROM $this->bq_users WHERE uName = '$username' AND uPass = '$hashpass'";
			$result = mysqli_query($conn,$sql);
			while($query = mysqli_fetch_assoc($result)){
			$si_email = $query['uName'];
			$si_fName = $query['fName'];
			$si_lName = $query['lName'];
			$si_type = $query['uaccType'];
			$si_id = $query['id'];
			$_SESSION["logged_in_si_type"] = $si_type;
			}
			//checks to see if user exists
			if (mysqli_num_rows($result) == 1){
				if($si_type == 'student'){
					$_SESSION["logged_in_stud_id"] = $si_id;
					$_SESSION["logged_in_stud_fName"] = $si_fName;
					$_SESSION["logged_in_stud_lName"] = $si_lName;
					header("Location:studdash.php");
				}
				elseif($si_type == 'instructor'){
					$_SESSION["logged_in_instr_email"] = $si_email;
					$_SESSION["logged_in_instr_fName"] = $si_fName;
					$_SESSION["logged_in_instr_lName"] = $si_lName;
					$_SESSION["logged_in_instr_id"] = $si_id;
					header("Location:instrdash.php");	
					}
				}
			else{
				echo '<div class="text-center wave alert alert-danger" role="alert">Invalid Login Details</div>';
			}	
		}
		
		
		//creates users
		public function createUsers($fName,$lname,$uName,$uPass,$uaccType){
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$hashpass = md5($uPass);
			
			$sqlemailcheck = "SELECT uName FROM $this->bq_users WHERE uName = '$uName'";
			$resultemailcheck = mysqli_query($conn,$sqlemailcheck);
			if (mysqli_num_rows($resultemailcheck) == 1){
				echo '<div class="text-center wave alert alert-danger" role="alert">User Already Exists!</div>';
			}
			else{
				$sql = "INSERT INTO $this->bq_users (fName,lName,uName,uPass,uaccType) VALUES('$fName','$lname', '$uName','$hashpass','$uaccType')";
				$result = mysqli_query($conn,$sql);	
				echo '<div class="text-center wave alert alert-success" role="alert"> "Record Saved Successfully" </div>';	
			}	
		}
		
					
		//get instructors
		public function getInstr($usertype){
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT * FROM $this->bq_users WHERE uaccType = '$usertype' ORDER BY lName,fName";
			$query = mysqli_query($conn,$sql);
			echo '<label for="instrSelect">Select Instructor</label>
				<select class="form-control" name="instrSelect" required>
			    <option value="">Select Instructor</option>';
			while ($result = mysqli_fetch_assoc($query)){
  				echo'<option value='.$result['uName'].'>'.$result['lName'].'  '.$result['fName'].'</option>';
			}
			echo'</select>';
		}
		
					
		//get instructors
		public function getstds($usertype){
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT * FROM $this->bq_users WHERE uaccType = '$usertype' ORDER BY lName,fName";
			$query = mysqli_query($conn,$sql);
			while ($result = mysqli_fetch_assoc($query)){
  				echo'<option value='.$result['id'].'>'.$result['lName'].'  '.$result['fName'].'</option>';
			}
		}
}

?>
