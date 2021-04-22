<?php
	//Brady Balk, Joshoua Bosse, Samuel Wells
	//Z1905404, Z1878186, Z1860087
	//CSCI466 Group Project Group Z
	
	
	//order complete page
	
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

echo "<html>";
	echo "<head>";
		echo "<title>Order Complete</title>";
	echo "</head>";
	echo "<head>";
		echo "<h1 style='text-align:center'>Song Order Complete</h1>";
		echo "<h3 style='text-align:center'>Your Submission Is Now In The Respective Queue</h3>";
	echo "</head>";
	
	//add to paid queue based on submission from results.
	if((isset($_POST['PaidQueue']) ? $_POST['PaidQueue']:null))
	{
		//insert user name into user table
		$sql = "INSERT INTO User(Name) VALUES(:Name);";
		$prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$success = $prepared->execute(array(':Name' => $_POST['Name']));
		
		$pqname = $_POST['Name'];
		
		$pquid = "SELECT UserID FROM User WHERE Name = '$pqname';";
		$result = $pdo->query($pquid);
		$rs = $result->fetch(PDO::FETCH_BOTH);
		
		$newpid = $rs[0];
		
		
		//insert into paid queue 
		$t = time();
		$sql = "INSERT INTO PQ(UserID, FileID, Time, Playing, Price) VALUES(:UserID, :FileID, :Time, FALSE, :Price);";
		$prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$success = $prepared->execute(array('UserID' => $newpid,':FileID' => $_POST['KaraokeFile'], ':Time' => $t, ':Price' => $_POST['PaidQueue']));
		echo "<br></br>";
		echo "<p>Your song has succesfully been added to the paid queue, or PQ!</p";
	}
	if((isset($_POST['FreeQueue']) ? $_POST['FreeQueue']:null))
	{
		//insert user name into user table
		$sql = "INSERT INTO User(Name) VALUES(:Name);";
		$prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$success = $prepared->execute(array(':Name' => $_POST['FreeQueue']));
	
		$fqname = $_POST['FreeQueue'];
		
		$fquid = "SELECT UserID FROM User WHERE Name = '$fqname';";
		$result = $pdo->query($fquid);
		$rs = $result->fetch(PDO::FETCH_BOTH);
		
		$newfid = $rs[0];
		
		//insert into free queue 
		$t = time();
		$sql = "INSERT INTO FQ(UserID, FileID, Time, Playing) VALUES(:UserID, :FileID, :Time, FALSE);";
		$prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$success = $prepared->execute(array(':UserID' => $newfid, ':FileID' => $_POST['KaraokeFile'], ':Time' => $t));
		echo "<br></br>";
		echo "<p>Your song has succesfully been added to the free queue, or FQ!</p";
	}
	
echo "<br></br>";



echo "<br><a href='djview.php'>DJ VIEW</a>";
echo "<br><a href='homepage.php'>Search For More Songs!</a>";


echo "</html>";
	
?>