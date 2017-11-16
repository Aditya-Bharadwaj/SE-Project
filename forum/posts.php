<?php
	$host = "localhost" ;
$user = "root";
$db = "codeManch";
$pass = "" ;

ini_set('max_execution_time',300);



$conn = mysqli_connect($host, $user, $pass) ;
//echo "lol" ;

$db_selected = mysqli_select_db($conn, $db);
$conn=mysqli_connect($host, $user, $pass, $db) ;	

	if(isset($_POST['message']))
	{
		extract($_POST);
		//echo $topic_title."\n";
		//echo $message;
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		$sql = "INSERT ignore into `forum_posts` (`topic_title`, `post_text`,`post_create_time`, `post_owner`) values ('$topic_title','$message','$date','$logged_in');  ";
		$res_2 = mysqli_query($conn,$sql) ;
		if($res_2)
		{
			//echo "Post Added";
		}
		else
		{
			die("Query Failed!".mysqli_error($conn)) ;
		}
		unset($_POST);
	}
	else if(isset($_GET['topic_title']))
	{
		extract($_GET);
	}


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
      <li><a href="../index.php">Home</a></li>
      <li><a href="../compete.html">compete</a></li>
      <li><a href="../practice.html" >practice</a></li>
      <li class = "active"><a href="disc.php" >Discussion</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
      
      <li><a href="../Login/login.html"><span class="glyphicon glyphicon-log-in"></span> Login/SignUp</a></li>
	</ul>
	  </div>
	</nav>
	<div class = "container-fluid">
		<div class="col-xs-8 col-md-offset-2" id="forum">
			<?php
					$sql = "SELECT `post_text`,`post_create_time`,`post_owner` from `forum_posts` where `topic_title`='$topic_title';";
					$result = mysqli_query($conn,$sql) ;
					if($result)
					{
						if ($result->num_rows > 0) 
						{
					    // output data of each row
						    while($row = $result->fetch_assoc()) 
						    {
						        $str = "<div class='well'><b>".$row["post_owner"]."</b> :: ".$row["post_create_time"]."<br>".$row["post_text"]."</div>";
						        echo $str;
						    }
						} 
						else 
						{
						    echo "0 results";
						}
					}
					else
					{
						die("Query Failed!".mysqli_error($conn)) ;
					}
				
			?>

			<?php echo "<a href='addPost.php?topic_title=".$topic_title."' value='Add a new Post Here'>Add a new post here</a>"; ?>
		</div>
	</div>
  </body>
</html>  

	
