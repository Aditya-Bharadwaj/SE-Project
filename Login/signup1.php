<?php

$host = "localhost" ;
$user = "root";
$db = "coders";
$pass = "" ;



$conn = mysqli_connect($host, $user, $pass) ;
echo "lol" ;

$db_selected = mysqli_select_db($conn, $db);

if (!$db_selected)
{
	$db_sql = 'CREATE DATABASE coders';
	echo "Entering";
	$res_1 = mysqli_query($conn, $db_sql) ;
	if($res_1)
	{
		echo "Successfully created database" ;
	}
	else
	{
		die("Query Failed!".mysqli_error($conn)) ;
	}

	$tbl_sql = 'CREATE TABLE `Users` (
    
    `FName` varchar(20),
    `LName` varchar(20),
    `Email` varchar(20),
    `Psswd` varchar(20),
    `Prob1_Score` integer,
    `Prob2_Score` integer
    
    
    );';

	$conn=mysqli_connect($host, $user, $pass, $db) ;

	$res_2 = mysqli_query($conn,$tbl_sql) ;
	if($res_2)
	{
		echo "Successfully created table" ;
	}
	else
	{
		die("Query Failed!".mysqli_error($conn)) ;
	}


}


if(isset($_POST['submit1']))
{
		$f = $_POST['FName'] ;
		$l = $_POST['LName'] ;
		$p = $_POST['Password'] ;
		$e = $_POST['email'] ;
		echo $e ;
		
		
		if(empty($f) || empty($l) || empty($p) || empty($e))
		{
			echo "Sorry can't leave these fields blank, return to previous page" ;
			exit() ;
		}
		
		else{
			$sql = "INSERT INTO `users`(`FName`, `LName`, `Email`, `Psswd`, `Prob1_Score`, `Prob2_Score`) VALUES ('$f','$l','$e','$p',0,0)" ;
			$res = mysqli_query($conn,$sql) ;
			if($res)
			{
				//echo "Successfully inserted data" ;
				//echo '<script type="text/javascript">window.location.href="http://localhost:8081/miniProj/Login/login.html";</script>'; 
				header("Location:../index.html")
			}
			else
			{
				die("Query Failed!".mysqli_error($conn)) ;
			}
			
		}
}


?>
