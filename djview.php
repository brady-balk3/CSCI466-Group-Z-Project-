<?php
	//Brady Balk,
	//Z1905404,
	//CSCI466 Group Project
	
	
	//dj view
	
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
		echo "<title>DJ VIEW</title>";
	echo "</head>";
	echo "<head>";
		echo "<h1 style='text-align:center'>DJ VIEW</h1>";
		
		//form to be able to submit paid queue selection
		echo "<form id='PQDJ' method='POST' action='djview.php'>";
		
		//table for paid queue
		echo "<h1 class='table-header'>Paid Queue</h1>";
		echo "<h2 class='table-header'>Sorted by price paid</h2>";
		echo "<h4 class='table-header'>Version = 1 indicates a solo performance and Version = 2 indicates a duet performance</h4>";
		echo "<thead>";
			echo "<tr>";
				echo"<th>Confirm | </th>";
				echo"<th>Title | </th>";
				echo"<th>Artist | </th>";
				echo"<th>User | </th>";
				echo"<th>Karaoke FileID | </th>";
				echo"<th>Version | </th>";
			echo"</tr>";
		echo"</thead>";
	echo"<tbody>";
	
	echo"<p>";
	echo"</p>";
	

//paid queue sql statement

$sql = "SELECT P.PQID, T.Name AS Title, A.Name as Artist, U.Name as User, K.FileID, K.Version FROM Title T, KaraokeFile K, Artist A, User U, PQ P WHERE K.FileID = P.FileID AND T.TitleID = K.TitleID AND A.ArtistID = K.ArtistID AND U.UserID = P.UserID AND P.Playing = 'FALSE' ORDER BY P.Price DESC;";
$result = $pdo->query($sql);
while ($rows = $result->fetch(pdo::FETCH_BOTH))
{
	echo "<tr class='item'>";
	echo "<td><label for='" . $rows['PQID'] . "'><input type='radio' name='PQ' value='" . $rows['PQID'] . "' id='" . $rows['PQID'] ."'></label></td>&emsp;";
	echo "<td><label for='" . $rows['PQID'] . "'>" . $rows['Title'] ."</label></td>&emsp;";
	echo "<td><label for='" . $rows['PQID'] . "'>" . $rows['Artist'] . "</label></td>&emsp;";
	echo "<td><label for='" . $rows['PQID'] . "'>" . $rows['User'] . "</label></td>&emsp;";
	echo "<td>" . $rows['FileID'] . "</td>&emsp;";
	echo "<td><label for='" . $rows['PQID'] . "'>" . $rows['Version'] . "</label></td>&emsp;</tr>";
	echo "<br></br>";
}

echo "</tbody>";
echo "</head>";
echo "</form>";

echo "<head>";
		//form to submit free queue selection
		echo "<form id='FQDJ' method='POST' action='djview.php'>";
		//table for free queue
		echo "<h1 class='table-header'>Free Queue</h1>";
		echo "<h2 class='table-header'>Sorted by FIFO</h2>";
		echo "<h4 class='table-header'>Version = 1 indicates a solo performance and Version = 2 indicates a duet performance</h4>";
		echo "<thead>";
			echo "<tr>";
				echo"<th>Confirm | </th>";
				echo"<th>Title | </th>";
				echo"<th>Artist | </th>";
				echo"<th>User | </th>";
				echo"<th>Karaoke FileID | </th>";
				echo"<th>Version  </th>";
			echo"</tr>";
		echo"</thead>";
	echo"<tbody>";
	
	echo"<p>";
	echo"</p>";

//free queue sql statement	
$sql = "SELECT F.FQID, T.Name AS Title, A.Name as Artist, U.Name as User, K.FileID, K.Version FROM Title T, KaraokeFile K, Artist A, User U, FQ F WHERE K.FileID = F.FileID AND T.TitleID = K.TitleID AND A.ArtistID = K.ArtistID AND U.UserID = F.UserID AND F.Playing = 'FALSE';";
$result = $pdo->query($sql);
while ($rows = $result->fetch(pdo::FETCH_BOTH))
{
	echo "<tr class='item'>";
	echo "<td><label for='" . $rows['FQID'] . "'><input type='radio' name='FQ' value='" . $rows['FQID'] . "' id='" . $rows['FQID'] ."'></label></td>&emsp;";
	echo "<td><label for='" . $rows['FQID'] . "'>" . $rows['Title'] ."</label></td>&emsp;";
	echo "<td><label for='" . $rows['FQID'] . "'>" . $rows['Artist'] . "</label></td>&emsp;";
	echo "<td><label for='" . $rows['FQID'] . "'>" . $rows['User'] . "</label></td>&emsp;";
	echo "<td>" . $rows['FileID'] . "</td>&emsp;";
	echo "<td><label for='" . $rows['FQID'] . "'>" . $rows['Version'] . "</label></td>&emsp;</tr>";
	echo "<br></br>";
}

	echo "</tbody>";
	echo "</head>";
	echo "</form>";
	
	echo "<input type='submit' id='ClearPQ' name='ClearPQ' value='ClearPQ Selection' form='PQDJ'/>&emsp;";
	echo "<input type='submit' id='ClearFQ' name='ClearFQ' value='ClearFQ Selection' form='FQDJ'/>";
	
		//update paid queue 
	if((isset($_POST['PQ']) ? $_POST['PQ'] : null))
	{
		$sql = "UPDATE PQ SET Playing='TRUE' WHERE PQID =" . $_POST['PQ'] . ";";
		$result = $pdo->exec($sql);
	}
	
	//update free queue
	if((isset($_POST['FQ']) ? $_POST['FQ'] : null))
	{
		$sql = "UPDATE FQ SET Playing='TRUE' WHERE FQID =" . $_POST['FQ'] . ";";
		$result = $pdo->exec($sql);
	}

echo "</html>";




?>	  					