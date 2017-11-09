<?php

	$f1 = fopen("submissions.txt","r") ;
	while($line=fgets($f1)) {
		echo $line ;
		echo "<br/>" ;
	}
?>