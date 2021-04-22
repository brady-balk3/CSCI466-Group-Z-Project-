<?php
	//Brady Balk, Joshoua Bosse
	//Z1905404, Z1878186
	//CSCI466 Group Project
	
	
	//results after search
	
	include ('dblogincreds.php');
	
	function table_print($rows) {
		if (!$rows) {echo "ERROR: Invalid Entry"; die();}
		echo "<table border=1 cellpadding=10>";
		echo "<tr>";
		foreach ($rows[0] as $key => $value)
		{
			if ($key != "FileID")
				echo "<th>$key</th>";
		}
		echo "</tr>";
			
		foreach($rows as $row)
		{
			echo "<tr>";
			foreach($row as $key => $value)
			{
				if ($key != "FileID")
				{
					echo "<td>";
					if ($key == "Title")
					{// add option to select a song
						echo "<form method='POST' action='submit.php'>";
						echo "<button type='submit' name='FileID' value='$row[FileID]'>Select</button>";
						echo "</form>";
					}
					echo "$value</td>";
				}
			}
			echo "</tr>";
		}
		echo "</table>";
	}

		try //connects to database
	{
		$dsn = "mysql:host=courses;dbname=$username";
		$pdo = new PDO($dsn, $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
		// get sql statement 
		if ($_POST['searchOPT'] == "title")
		{
			echo "Showing songs titled: $_POST[search]";
			$sql = "SELECT FileID, Title.Name'Title', Artist.Name'Artist', Version
						FROM KaraokeFile, Title, Artist
						WHERE KaraokeFile.TitleID = Title.TitleID
						AND KaraokeFile.ArtistID = Artist.ArtistID
						AND Title.Name = '$_POST[search]';";
		}
		else if ($_POST['searchOPT'] == "artist")
		{
			echo "Showing songs by: $_POST[search]";
			$sql = "SELECT FileID, Title.Name'Title', Artist.Name'Artist', Version
						FROM KaraokeFile, Title, Artist
						WHERE KaraokeFile.TitleID = Title.TitleID
						AND KaraokeFile.ArtistID = Artist.ArtistID
						AND Artist.Name = '$_POST[search]';";
		}
		else if ($_POST['searchOPT'] == "contributor")
		{
			echo "Showing songs with a contribution from: $_POST[search]";
			$sql = "SELECT KaraokeFile.FileID, Title.Name'Title', Artist.Name'Artist', Version
						FROM KaraokeFile, Title, Artist, Contributes, Contributor
						WHERE KaraokeFile.TitleID = Title.TitleID
						AND KaraokeFile.ArtistID = Artist.ArtistID
						AND KaraokeFile.FileID = Contributes.FileID 
						AND Contributes.ConID = Contributor.ConID
						AND Contributor.Name = '$_POST[search]';";
		}
	
		// run query
		$rs = $pdo->query($sql);
		$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
		
		//print results
		if (empty($rows)) 
			echo "<br>No results found";
		else
			table_print($rows);
	}
	catch(PDOexception $e) //handles error exception
	{
		echo "Connection to database failed: " . $e->getMessage();
	}
?>
