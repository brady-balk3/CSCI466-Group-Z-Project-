<?php
	//Brady Balk, Joshoua Bosse
	//Z1905404, Z1878186
	//CSCI466 Group Project
	
	
	//submit page
	
	include ('dblogincreds.php');
	
		try //connects to database
	{
		$dsn = "mysql:host=courses;dbname=$username";
		$pdo = new PDO($dsn, $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
		// selection info
		$sql = "SELECT Title.Name'Title', Artist.Name'Artist', Version
					FROM KaraokeFile, Title, Artist
					WHERE KaraokeFile.TitleID = Title.TitleID
					AND KaraokeFile.ArtistID = Artist.ArtistID
					AND KaraokeFile.FileID = '$_POST[FileID]';";
		// run query
		$rs = $pdo->query($sql);
		$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
		
		$row = $rows[0];
			
		echo "You've selected: $row[Title], by $row[Artist]. Version $row[Version]<br>";
		
		// get contibutor list
		$sql = "SELECT Name, Position
					FROM KaraokeFile, Contributes, Contributor
					WHERE KaraokeFile.FileID = Contributes.FileID
					AND Contributes.ConID = Contributor.ConID
					AND KaraokeFile.FileID = '$_POST[FileID]';";
		
		$rs = $pdo->query($sql);
		$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
		
		// print contributors
		echo "<ol>With contributions from:";
		foreach ($rows as $row)
		{
			echo "<li>$row[Name], $row[Position]</li>";
		}
		echo "</ol>";
		
		// user entry form
	echo 	"<form method='POST' action='orderfinished.php'>
				<input type='hidden' name='KaraokeFile' value='$_POST[FileID]'/>
				<input type='text' name='Name' placeholder='Please enter your name' required='required'/>
				<input type='number' name='PaidQueue'  min='0' step='0.01' placeholder='Priority Payment (Optional)'/>
				<button type='submit'>Submit</button>
			</form>";
	}
	catch(PDOexception $e) //handles error exception
	{
		echo "Connection to database failed: " . $e->getMessage();
	}
?>
