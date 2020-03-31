<?php
	$con = mysqli_connect('localhost', 'agrosensor', 'agro!ar');
	
	if (!$con) {
		echo "Not connected to Server" . " " . mysqli_connect_error();
		exit();
	}
	
	if (!mysqli_select_db($con, 'videos')) { // This sets the database to videos and outputs the error message if it doesn't connect
		echo "Database not selected" . " " . mysqli_connect_error();
		exit();
	}
	

	$query = "SELECT * FROM vids"; // Query that selects everything from the vids table
    $execute = mysqli_query($con, $query); // MySQL query says to execute query. MySQL_fetch_assoc assigns variable to output of query meaning you can now parse it
	
	chdir("/");

	while ($video = mysqli_fetch_assoc($execute)) 
	{
		$location = $video['location']; //Equal to location value of query
		
		$extension = $video['extension'];
		
		$duration = shell_exec('ffmpeg -i var/www/html/"' . $location . '" 2>&1 | grep Duration | sed s/[.].*//');

		echo "<h1>You are watching: " . $video['name'];
		echo "<h1>" . $duration . "</h1>";
		echo "<video width='400' controls><source src='$location' type='$extension'>Your browser does not support the video tag</video>";
			
	} 
	
	
 ?>