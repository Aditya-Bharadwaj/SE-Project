<?php
	$userid = "1";
	$res = "";
	if(isset($_SESSION['userid'])){
		$userid = $_SESSION['userid'];
	}
	
	$conn = $conn = mysqli_connect("localhost", "root", "", "se");
	
	
	if(!$conn){
		
	}
	else{
		$query = "SELECT Domain,Solved  from dummy where hackerid = '$userid'";
		
		$result = mysqli_query($conn, $query);
		
		while($row = mysqli_fetch_assoc($result)) {
		
			$res = $res . $row['Domain']. " ".$row["Solved"] . ";" ;
		
		}
		 
	}
	echo $res;
?>
