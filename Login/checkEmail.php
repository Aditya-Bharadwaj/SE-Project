<?php

	extract($_GET) ;
	//echo $email;
	$host="localhost";
	$user="root" ;
	$db="coders" ;
	$pass="" ;
	$tbl="users" ;
	$conn=mysqli_connect($host,$user,$pass) ;
	mysqli_select_db($conn,$db); 

	$sql = "SELECT Email FROM users WHERE Email='".$email."'"; 
    echo $sql;
    $res = mysqli_query($conn,$sql) ;
	$num = mysqli_num_rows($res);
	echo $num;
	printf("Result set has %d rows.\n",$num);

	if ($num=='1'){
		echo "<script>parent.iframe_ret('Email address already taken');</script>" ;
	}
	else{
		echo "<script>parent.iframe_ret('Email address already taken);</script>" ;
	}
	
?>