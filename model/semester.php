<?php
	class Semester{
		protected $semester = "semester";
		
		public function chkSmster(){
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "SELECT semester FROM $this->semester LIMIT 1";
			$query = mysqli_query($conn,$sql);
			while ($result = mysqli_fetch_assoc($query)){
				echo $result['semester'];
			}
		}
		
		public function updSmster($smster){
			$conn = new mysqli("localhost", "root", "", "bqdb");
			$sql = "UPDATE $this->semester SET semester = '$smster' WHERE id = 1";
			$result = mysqli_query($conn,$sql);
		
	}
}
?>
