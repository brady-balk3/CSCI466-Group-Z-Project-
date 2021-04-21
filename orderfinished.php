<?php
	//Brady Balk,
	//Z1905404,
	//CSCI466 Group Project
	
	
	//order complete page
	
	include ('dblogincreds.php');
	
		try //connects to database
	{
		$dsn = "mysql:host=courses;dbname=z1905404";
		$pdo = new PDO($dsn, $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOexception $e) //handles error exception
	{
		echo "Connection to database failed: " . $e->getMessage();
	}

echo "<html>";
	echo "<head>";
		echo "<title>Order Complete</title>";
	echo "</head>";
	echo "<head>";
		echo "<h1 style='text-align:center'>Song Order Complete</h1>";
		echo "<h3 style='text-align:center'>Your Submission Is Now In The Respective Queue</h3>";
	echo "</head>";





echo "<br><a href='djview.php'>DJ VIEW</a>";
echo "<br><a href='homepage.php'>Search For More Songs!</a>";


echo "</html>";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>