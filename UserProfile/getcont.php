<?php
	session_start();
	$userid = "08eab423d5774531";
	$res = "";
	if(isset($_SESSION['customerId'])){
		$userid = $_SESSION['customerId'];
	}
	//print_r ($_SESSION);
	$conn = $conn = mysqli_connect("localhost", "root", "", "codemanch");
	
	
	if(!$conn){
		
	}
	else{
		$query = "SELECT domain,SUM(count) as count from dummy where domain is not null and HID = '$userid' group by domain";
		
		$result = mysqli_query($conn, $query);
		
		while($row = mysqli_fetch_assoc($result)) {
		
			$res = $res . $row['domain']. " ".$row["count"] . ";" ;
		
		}
		 
	}
	echo $res;
?>
