<?php
	//Brady Balk, Joshoua Bosse, Samuel Wells
	//Z1905404, Z1878186, Z1860087
	//CSCI466 Group Project Group Z
	
	
	//dj view
	
	include ('dblogincreds.php');
	
		try //connects to database
	{
		$dsn = "mysql:host=courses;dbname=$username";
		$pdo = new PDO($dsn, $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOexception $e) //handles error exception
	{
		echo "Connection to database failed: " . $e->getMessage();
	}
	
	// clear queue
	if (isset($_POST['PQ']))
	{
		
		$sql = "DELETE FROM PQ WHERE PQID = :PQID;";
		$prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$success = $prepared->execute(array(':PQID' => $_POST['PQ']));
	}
	else if (isset($_POST['FQ']))
	{
		$sql = "DELETE FROM FQ WHERE FQID = :FQID;";
		$prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$success = $prepared->execute(array(':FQID' => $_POST['FQ']));
	}

echo "<html>";
		echo "<head>";
		echo "<title>DJ VIEW</title>";
		echo "</head>";
		echo "<head>";
		echo "<h1 style='text-align:center'>DJ VIEW</h1>";
		
		//form to be able to submit paid queue selection
		echo "<form id='PQDJ' method='POST' action='djview.php'>";
		
		//table for paid queue
		echo "<h1>Paid Queue</h1>";
		echo "<h2>Sorted by price paid</h2>";
		echo "<h4>Version = 1 indicates a solo performance and Version = 2 indicates a duet performance</h4>";
			echo "<tr>";
			echo "<table border=1 cellpadding=10>";
				echo"<th>Confirm</th>";
				echo"<th>Title</th>";
				echo"<th>Artist</th>";
				echo"<th>User</th>";
				echo"<th>Karaoke FileID</th>";
				echo"<th>Version</th>";
			echo"</tr>";
		echo"<tbody>";
	

		//paid queue sql statement
		$sql = "SELECT P.PQID AS PQID, T.Name AS Title, A.Name as Artist, U.Name as User, K.FileID, K.Version FROM Title T, KaraokeFile K, Artist A, User U, PQ P WHERE K.FileID = P.FileID AND T.TitleID = K.TitleID AND A.ArtistID = K.ArtistID AND U.UserID = P.UserID AND P.Playing = 'FALSE' ORDER BY P.Price DESC;";
		$result = $pdo->query($sql);
		while ($rows = $result->fetch(pdo::FETCH_BOTH))//while there are rows still available to fetch
		{
		//build output with necesarry labels from the PQ sql table
		echo "<tr>";
		echo "<td><label ='".$rows['PQID']."'><input type='radio' name='PQ' value='".$rows['PQID']."' id='".$rows['PQID']."'></label></td>";
		echo "<td><label ='".$rows['PQID']."'>".$rows['Title']."</label></td>";
		echo "<td><label ='".$rows['PQID']."'>".$rows['Artist']."</label></td>";
		echo "<td><label ='".$rows['PQID']."'>".$rows['User']."</label></td>";
		echo "<td><label ='".$rows['PQID']."'>".$rows['FileID']."</label></td>";
		echo "<td><label ='".$rows['PQID']."'>".$rows['Version']."</label></td></tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</head>";
		echo "</form>";


		echo "<head>";
		//form to submit free queue selection
		echo "<form id='FQDJ' method='POST' action='djview.php'>";
		//table for free queue
		echo "<h1>Free Queue</h1>";
		echo "<h2>Sorted by FIFO</h2>";
		echo "<h4>Version = 1 indicates a solo performance and Version = 2 indicates a duet performance</h4>";
			echo "<tr>";
			echo "<table border=1 cellpadding=10>";
				echo"<th>Confirm</th>";
				echo"<th>Title</th>";
				echo"<th>Artist</th>";
				echo"<th>User</th>";
				echo"<th>Karaoke FileID</th>";
				echo"<th>Version</th>";
			echo"</tr>";
		echo"<tbody>";
	
		//free queue sql statement	
		$sql = "SELECT F.FQID AS FQID, T.Name AS Title, A.Name as Artist, U.Name as User, K.FileID, K.Version FROM Title T, KaraokeFile K, Artist A, User U, FQ F WHERE K.FileID = F.FileID AND T.TitleID = K.TitleID AND A.ArtistID = K.ArtistID AND U.UserID = F.UserID AND F.Playing = 'FALSE';";
		$result = $pdo->query($sql);
		while ($rows = $result->fetch(pdo::FETCH_BOTH)) //while there are rows available to fetch
		{
		//build output with necesarry labels from the FQ sql table
		echo "<tr>";
		echo "<td><label ='".$rows['FQID']."'><input type='radio' name='FQ' value='".$rows['FQID']."' id='".$rows['FQID']."'></label></td>";
		echo "<td><label ='".$rows['FQID']."'>".$rows['Title']."</label></td>";
		echo "<td><label ='".$rows['FQID']."'>".$rows['Artist']."</label></td>";
		echo "<td><label ='".$rows['FQID']."'>".$rows['User']."</label></td>";
		echo "<td><label ='".$rows['FQID']."'>".$rows['FileID']."</label></td>";
		echo "<td><label ='" . $rows['FQID']."'>".$rows['Version']."</label></td></tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</head>";
		echo "</form>";
	
		echo"<p>";
		echo"</p>";
		echo"<br></br>";
	
		//form that submits to dj page to clear current selected song if there was a mistake
		echo "<input type='submit' id='ClearPQ' name='ClearPQ' value='Clear PQ Selection' form='PQDJ'/>&emsp;";
		echo "<input type='submit' id='ClearFQ' name='ClearFQ' value='Clear FQ Selection' form='FQDJ'/>";
	
		echo"<p>";
		echo"</p>";
		echo"<br></br>";
	
		echo "<br><a href='homepage.php'>Go Back To Homepage</a>";
		echo "</html>";
?>	  					
