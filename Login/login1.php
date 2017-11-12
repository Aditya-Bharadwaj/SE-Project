<?php
	ob_start();
	session_start();
	$host="localhost";
	$user="root" ;
	$db="codemanch" ;
	$pass="" ;
	$tbl="users" ;
	$conn=mysqli_connect($host,$user,$pass) ;
	mysqli_select_db($conn,$db); 
	//echo $_POST['email'];
	if(isset($_POST['email']))
	{
		//echo "lol";
		$username = $_POST['email'];
		$password = $_POST['Password'] ;
		$sql = "SELECT HID FROM $tbl WHERE Email='".$username."' AND Psswd='".$password."' LIMIT 1" ;
		$res = mysqli_query($conn,$sql) ;
		if(mysqli_num_rows($res)==1)
			{
				$res = mysqli_fetch_row($res);
				//echo "You have successfully logged in" ;
				//ob_flush() ;
				//print_r($res);
				$_SESSION["customerId"] = $res[0];
				
				//echo $_SESSION['customerId'];
				header("Location:../recommend.php") ;
				//
				
			}
					else
					{
						//echo "Invalid login information ,Please login again" ;
						header('Location: login.html') ;
						#exit() ;
					}
			}
?>