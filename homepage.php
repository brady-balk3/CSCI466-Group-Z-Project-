<?php
	//Brady Balk,
	//Z1905404,
	//CSCI466 Group Project
	
	
	//homepage with search box
	
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

?>

<html>
	<head>
		<title>Karaoke Song Search</title>
		<meta charset="UTF-8">
	</head>
	<head>
	<div class="search">
		<h1 style="text-align:center">Karaoke Search</h1>
		<form method="POST" action="resultspage.php">
			<input type="radio" id="title" name="searchOPT" value="title"/>
			<label for="title">Song Title</label>
			<input type="radio" id="artist" name="searchOPT" value="artist"/>
			<label for="title">Artist</label>
			<input type="radio" id="contributor" name="searchOPT" value="contributor"/>
			<label for="title">Contributor</label><br><br>
			<input type="text" name="search" placeholder="Search for songs!">
			<button type="submit">
		</form>
	</div>
	</head>
</html>
