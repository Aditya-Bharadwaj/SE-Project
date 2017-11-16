<?php

$host = "localhost" ;
$user = "root";
$db = "codemanch";
$pass = "" ;



$conn = mysqli_connect($host, $user, $pass) ;
//echo "lol" ;

$db_selected = mysqli_select_db($conn, $db);


if(isset($_POST['submit1']))
{
		$f = $_POST['FName'] ;
		$l = $_POST['LName'] ;
		$p = $_POST['Password'] ;
		$e = $_POST['email'] ;
		//echo $e ;
		
		
		if(empty($f) || empty($l) || empty($p) || empty($e))
		{
			echo "Sorry can't leave these fields blank, return to previous page" ;
			exit() ;
		}
		
		else{
			$uid = rand(10000000,999999999);
			$sql = "INSERT INTO `users`(`HID`,`FName`, `LName`, `Email`, `Psswd`) VALUES ('$uid','$f','$l','$e','$p')" ;
			$res = mysqli_query($conn,$sql) ;
			if($res)
			{
				//echo "Successfully inserted data" ;
				//echo '<script type="text/javascript">window.location.href="http://localhost:8081/SE-Project/Login/login.html";</script>'; 
				header("Location:../index.html");
			}
			else
			{
				die("Query Failed!".mysqli_error($conn)) ;
			}
			
		}
}


?>
