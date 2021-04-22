<?php
	//Brady Balk, Joshoua Bosse
	//Z1905404, Z1878186
	//CSCI466 Group Project
	
	
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
		$pqname = 
		$sql = "INSERT INTO User(Name) VALUES(:Name);";
		$prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$success = $prepared->execute(array(':Name' => $_POST['Name']));
		
		
		$pquid = "SELECT MAX(UserID) FROM User;";
		$result = $pdo->query($pquid);
		$rs = $result->fetch(PDO::FETCH_BOTH);
		
		$newpid = $rs[0];
		
		print $newpid;
		
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
		$success = $prepared->execute(array(':Name' => $_POST['Name']));
		$newfid = $success->fetch(PDO::FETCH_BOTH);
		if($newfid)
		{
			$fid = $newfid[UserID];
		}
		
		//insert into paid queue 
		$t = time();
		$sql = "INSERT INTO FQ(UserID, FileID, Time, Playing) VALUES(:UserID, :FileID, :Time, FALSE);";
		$prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$success = $prepared->execute(array(':UserID' => $fid, ':FileID' => $_POST['KaraokeFile'], ':Time' => $t));
		echo "<br></br>";
		echo "<p>Your song has succesfully been added to the free queue, or FQ!</p";
	}




echo "<br><a href='djview.php'>DJ VIEW</a>";
echo "<br><a href='homepage.php'>Search For More Songs!</a>";


echo "</html>";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>
