<?php
	ob_start();
	$host="localhost";
	$user="root" ;
	$db="coders" ;
	$pass="" ;
	$tbl="users" ;
	$conn=mysqli_connect($host,$user,$pass) ;
	mysqli_select_db($conn,$db); 
	//echo $_POST['email'];
	if(isset($_POST['email']))
	{
		$username = $_POST['email'];
		$password = $_POST['Password'] ;
		$sql = "SELECT *FROM $tbl WHERE Email='".$username."' AND Psswd='".$password."' LIMIT 1" ;
		$res = mysqli_query($conn,$sql) ;
		if(mysqli_num_rows($res)==1)
			{
				echo "You have successfully logged in" ;
				//ob_flush() ;
				header("Location:http://localhost:8081/miniProj/") ;
				//
				$_SESSION["customerMail"] = $username;
			}
					else
					{
						echo "Invalid login information ,Please login again" ;
						//header('Location : http://localhost:8081/miniProj/') ;
						#exit() ;
					}
			}
?>