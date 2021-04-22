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
		echo "<th>Confirm</th>";

		foreach ($rows[0] as $key => $value)
		{
			if ($key != "FileID")
				// sort songs by title
				echo "<th>$key";
				if ($key == "Title")
				{
					// check if sorted, then alternate value
					if (isset($_POST['sort']))
					{
						
						if ($_POST['sort'] == "ASC")
						{
							echo " (Ascending Order)";
							$sort = "DESC";
						}
						else
						{
							echo " (Descending Order)";
							$sort = "ASC";
						}
					}
					else
						$sort = "ASC";
						
					// form to re-run query in order
					echo "<form method='POST' action='resultspage.php'>";
						echo "<input type='hidden' name='search' value='$_POST[search]'/>";
						echo "<input type='hidden' name='searchOPT' value='$_POST[searchOPT]'/>";
						echo "<button type='submit' name='sort' value='$sort'>Sort</button>";
					echo "</form>";
				}
				echo "</th>";
		}
		echo "</tr>";
			
		foreach($rows as $row)
		{
			echo "<tr>";
			foreach($row as $key => $value)
			{
				if ($key != "FileID")
				{
					if ($key == "Title")
					{// add option to select a song
						echo "<td> <form method='POST' action='submit.php'>";
							echo "<button type='submit' name='FileID' value='$row[FileID]'>Select</button>";
						echo "</form></td>";
					}
					echo "<td>$value</td>";
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
		
		// set order to print query
		if (isset($_POST['sort']))
			$order = "ORDER BY Title $_POST[sort]";
		else $order = "";
			
		//check for empty search
		if ($_POST['search'] == "")
		{
			$sql = "SELECT KaraokeFile.FileID, Title.Name'Title', Artist.Name'Artist', Version
						FROM KaraokeFile, Title, Artist, Contributes, Contributor
							WHERE KaraokeFile.TitleID = Title.TitleID
							AND KaraokeFile.ArtistID = Artist.ArtistID
							GROUP BY KaraokeFile.FileID
							$order;";
		}		
		else if ($_POST['searchOPT'] == "title") // get sql statement
		{
			echo "Showing songs titled: $_POST[search]";
			$sql = "SELECT FileID, Title.Name'Title', Artist.Name'Artist', Version
						FROM KaraokeFile, Title, Artist
						WHERE KaraokeFile.TitleID = Title.TitleID
						AND KaraokeFile.ArtistID = Artist.ArtistID
						AND Title.Name = '$_POST[search]'
						$order;";
		}
		else if ($_POST['searchOPT'] == "artist")
		{
			echo "Showing songs by: $_POST[search]";
			$sql = "SELECT FileID, Title.Name'Title', Artist.Name'Artist', Version
						FROM KaraokeFile, Title, Artist
						WHERE KaraokeFile.TitleID = Title.TitleID
						AND KaraokeFile.ArtistID = Artist.ArtistID
						AND Artist.Name = '$_POST[search]'
						$order;";
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
						AND Contributor.Name = '$_POST[search]'
						$order;";
		}
	
		// run query
		$rs = $pdo->query($sql);
		$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
		
		//print results
		if (empty($rows)) 
		{
			echo "<br>No results found";
			echo "<br>Make sure to select one of the three options before conducting the search!";
			echo "<br></br>";
		}
		else
		{
			table_print($rows);
		}
	}
	catch(PDOexception $e) //handles error exception
	{
		echo "Connection to database failed: " . $e->getMessage();
	}
?>
