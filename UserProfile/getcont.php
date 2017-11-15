<?php
	$userid = "1";
	$res = "";
	if(isset($_SESSION['userid'])){
		$userid = $_SESSION['userid'];
	}
	
	$conn = $conn = mysqli_connect("localhost", "root", "", "codemanch");
	
	
	if(!$conn){
		
	}
	else{
		$query = "SELECT sub_domain,count(*)  from dummy where hid = '$userid'";
		
		$result = mysqli_query($conn, $query);
		
		while($row = mysqli_fetch_assoc($result)) {
		
			$res = $res . $row['sub_domain']. " ".$row["count(*)"] . ";" ; nb
		
		}
		 
	}
	echo $res;
?>
