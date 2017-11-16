<?php
	session_start();	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
	<nav class="navbar navbar-inverse">
	<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">HungryCoders</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="home.html">Home</a></li>
      <li><a href="compete.html">compete</a></li>
      <li class = "active"><a href="practice.html" >practice</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	</ul>
	  </div>
	</nav>
	<div class = "container-fluid">
	
	<?php
	extract($_POST);

	//echo "$code";
	$file = fopen("submitted.py","w+") or die("Unable to open file!");
	fwrite($file,$code);
	$fop = fopen("expectedProb1.txt","r");
	$correct = true;	

	$linecount = 0;
	$handle = fopen("expectedProb1.txt", "r");
	while(!feof($handle)){
	  $line = fgets($handle);
	  $linecount++;
	}

	fclose($handle);


	//exec("python submitted.py 2>&1",$res,$err);
	$python = 'python3';
	$pyscript = 'C:\\xampp\\htdocs\\SE-Project\\prob1\\subp.py';
	$cmd = "$python $pyscript";
	
	`$cmd`;
	
	$output_file_size = filesize("output.txt");
	$error_file_size = filesize("op2.txt");

	echo $output_file_size; echo "\n";
	echo $error_file_size;

	if($output_file_size == 0)
	{
		$res = fopen("op2.txt", "r");
		$res_str = file_get_contents("op2.txt");
	}
	else
	{
		$res = fopen("output.txt", "r");
		$res_str = file_get_contents("output.txt");
	}
	
	?>
	<div class="row">
		  <div class="col-md-2"></div>
		  <div class="col-md-8">
			<div class = "well well-lg"> <b>output</b> <br>
			<?php
				echo nl2br($res_str);
				$correct = true;
				for($i=0;$i<$linecount ;$i++)
				{
					$line = fgets($fop);
					$op_line = fgets($res);
					if((int)$line != (int)$op_line)
					{
						echo $line." ".$op_line;
						$correct = false;
					}
				}
				echo "<br>";
			?>
			</div> 
			<div class = "well well-lg"> 
			<?php
				if($correct == true)
				{
					echo "CORRECT";

					//connect to database when user is correct
					$file_data = "User1 "."Correct";
					$host = "localhost" ;
					$user = "root";
					$db = "codemanch";
					$pass = "" ;



					$conn = mysqli_connect($host, $user, $pass) ;
					//echo "lol" ;
					$db_selected = mysqli_select_db($conn, $db);
					$customerId = $_SESSION['customerId'];
					$challengeId = $_SESSION['challengeId'];

					//insert his submission record
					$submitted_sql = "INSERT INTO submissions(HID, CID, Lang) VALUES ('$customerId', '$challengeId', 'Python')";
					$submitted_res = mysqli_query($conn, $submitted_sql);
					$file_data .= file_get_contents('submissions.txt');
					file_put_contents('submissions.txt', $file_data);

				}
				else
				{
					echo "FAIL";
				}
			?>
			</div>
		  </div>
		  <div class="col-md-2"></div>
	</div>	
	</div>
  </body>
</html>  

	
