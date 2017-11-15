<?php
	$host = "localhost" ;
$user = "root";
$db = "codeManch";
$pass = "" ;

ini_set('max_execution_time',300);

$conn = mysqli_connect($host, $user, $pass) ;
//echo "lol" ;

$db_selected = mysqli_select_db($conn, $db);

if (!$db_selected)
{
	$db_sql = 'CREATE DATABASE '.$db;
	//echo "In DataBase";
	$res_1 = mysqli_query($conn, $db_sql) ;
	if($res_1)
	{
		//echo "Successfully created database" ;
	}
	else
	{
		die("Query Failed!".mysqli_error($conn)) ;
	}
	$conn=mysqli_connect($host, $user, $pass, $db) ;

		$tbl_sql = 'CREATE TABLE `Users`(
		`HID` varchar(20),
		`FName` varchar(20),
		`LName` varchar(20),
		`Email` varchar(20),
		`Psswd` varchar(20),
		primary key (`HID`)
		);
		
		';
		$res_2 = mysqli_query($conn,$tbl_sql) ;
		if($res_2)
		{
			//echo "Successfully created table" ;
		}
		else
		{
			die("Query Failed!".mysqli_error($conn)) ;
		}
		$tbl_sql = 'CREATE TABLE `Submissions`(
		`HID` varchar(20),
		`CID` varchar(20),
		`Lang` varchar(20),
		primary key (`HID`,`CID`)		
		);
		
		';
		$res_2 = mysqli_query($conn,$tbl_sql) ;
		if($res_2)
		{
			//echo "Successfully created table" ;
		}
		else
		{
			die("Query Failed!".mysqli_error($conn)) ;
		}
		$tbl_sql = 'CREATE TABLE `Challenges`(
		`CID` varchar(20),
		`domain` varchar(20),
		`sub_domain` varchar(20),
		primary key (`CID`)
		);
		
		';
		$res_2 = mysqli_query($conn,$tbl_sql) ;
		if($res_2)
		{
			//echo "Successfully created table" ;
		}
		else
		{
			die("Query Failed!".mysqli_error($conn)) ;
		}
		$tbl_sql = 'CREATE TABLE `forum_topics` (
		    `topic_title` varchar (150) primary key,
		    `topic_create_time` varchar(30),
		    `topic_owner` varchar (150)
		    );
			';
			$res_2 = mysqli_query($conn,$tbl_sql) ;
			if($res_2)
			{
				//echo "Successfully created table" ;
			}
			else
			{
				die("Query Failed!".mysqli_error($conn)) ;
			}
		$tbl_sql = 'CREATE TABLE `forum_posts` (
		    `topic_title` varchar (15),
		    `post_text` varchar(500),
		    `post_create_time` varchar(30),
		    `post_owner` varchar (150),
		    primary key(`topic_title`,`post_text`,`post_owner`)
		    );
			';
			$res_2 = mysqli_query($conn,$tbl_sql) ;
			if($res_2)
			{
				//echo "Successfully created table" ;
			}
			else
			{
				die("Query Failed!".mysqli_error($conn)) ;
			}

		
	//primary key in submissions(put time or count unsolved attempts if unsolved attempts is actually gonna be used), foreign keys,
	
	//echo "blah";
	$handle = fopen("recommender/datasets/challenges_sample.csv","r");
	if($handle)
	{
		$i = 1;
		while(($line = fgets($handle)) !== false)
		{
			if($i == 1) { $i = 0; continue; }
			$line = explode(",",$line);
					$sql = "insert ignore into `Challenges` values ('$line[0]','$line[2]','$line[3]');";
					$res_2 = mysqli_query($conn,$sql) ;
					if($res_2)
					{
						//echo "Challenges" ;
					}
					else
					{
						die("Query Failed!".mysqli_error($conn)) ;
					}
		}
		fclose($handle);
	}
	else {echo "Unable to open file";};
	

	$handle = fopen("recommender/datasets/submissions_sample.csv","r");
	if($handle)
	{
		$i = 1;
		$count = 0;
		while(($line = fgets($handle)) !== false)
		{
			if($i == 1) { $i = 0; continue; }
			$line = explode(",",$line);
				if($line[4]=='1')
				{
					$sql = "insert ignore into `Submissions` values ('$line[0]','$line[2]','$line[3]');";
					$res_2 = mysqli_query($conn,$sql) ;
					if($res_2)
					{
						//echo "Submissions" ;
					}
					else
					{
						die("Query Failed!".mysqli_error($conn)) ;
					}
				}
				$fnames = array("Mary","Kelly","Andy","Dany","Jenny","Eva","Kobe","Arnold","Leonard","Tim");
				$lnames = array("Bryant","James","Rose","George","Westbrooke","Adams","Anthony","Minkowski","Hardwood");
				$findex = array_rand($fnames,1);
				$lindex = array_rand($lnames,1);
				$count = $count + 1;
				$mail = "mail".strval($count)."@mailmaadi.com";
				//echo $mail;
				$sql = "insert ignore into `Users` values ('$line[0]','$fnames[$findex]','$lnames[$lindex]','$mail','pass');";
				$res_2 = mysqli_query($conn,$sql) ;
				if($res_2)
				{
					//echo "Users" ;
				}
				else
				{
					die("Query Failed!".mysqli_error($conn)) ;
				}
			
		}
		fclose($handle);
	}
	else {echo "Unable to open file";}
	
	

	$sql = "create view dummy as select submissions.HID,challenges.domain,challenges.sub_domain,count(*) from submissions left join challenges on submissions.CID=challenges.CID group by submissions.HID,challenges.domain,challenges.sub_domain
	";
	$res_2 = mysqli_query($conn,$sql) ;
	if($res_2)
	{
		//echo "View created" ;
	}
	else
	{
		die("Query Failed!".mysqli_error($conn)) ;
	}

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CodeManch</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CodeManch</a>
    </div>
    <ul class="nav navbar-nav">
      <li class = "active"><a href="index.html">Home</a></li>
      <li><a href="compete.html">compete</a></li>
      <li><a href="practice.html" >practice</a></li>
      <li><a href="forum/Disc.php" >Discussion</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
      
      <li><a href="Login/login.html"><span class="glyphicon glyphicon-log-in"></span> Login/SignUp</a></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
      
      <li><a href="recommend.php"><span class="glyphicon glyphicon-log-in"></span> Recommended problems</a></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
      
      <li><a href="UserProfile/userprofile.html"><span class="glyphicon glyphicon-log-in"></span> Profile</a></li>
	  
	</ul>
	  </div>
</nav>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="Images/img4.jpg" alt="Image" height="100px">
        <div class="carousel-caption">
          <h3>Practice coding</h3>
          <p>Code Code.</p>
        </div>      
      </div>

      <div class="item">
        <img src="Images/img5.jpg" alt="Image">
        <div class="carousel-caption">
          <h3>Compete..find jobs</h3>
          <p>code code.</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">    
  <h3>Practice coding. Compete. Find jobs.</h3><br>
  <div class="row">
    <div class="col-sm-4">
	  <a href = "practice.html">
      <img src="Images/img6.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>Practice Coding</p>
	  </a>
    </div>
    <div class="col-sm-4"> 
	  <a href = "compete.html">
      <br><br>
      <img src="Images/img8.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>Competitions</p>    
	  </a>
    </div>
    <div class="col-sm-4">
      <div class="well">
       <p>"I'm late to the party, but @CodeManch is addictive. Spent four hours in a row solving problems yesterday. #tired #coding #fun"</p>
      </div>
      <div class="well">
       <p>This has allowed us to reach a wider, more diverse population of talent, as well as enhancing and streamlining our screening process.</p>
      </div>
    </div>
  </div>
</div><br>

<footer class="container-fluid text-center">
  <p>CodeManch</p>
</footer>

</body>
</html>