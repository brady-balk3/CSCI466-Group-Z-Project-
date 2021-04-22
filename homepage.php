<?php
	//Brady Balk, Joshoua Bosse
	//Z1905404, Z1878186
	//CSCI466 Group Project
	
	
	//homepage with search box
	
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
			<br></br>
			<input type="radio" id="title" name="searchOPT" value="title" checked="checked"/>
			<label for="title">Song Title</label>
			<input type="radio" id="artist" name="searchOPT" value="artist"/>
			<label for="title">Artist</label>
			<input type="radio" id="contributor" name="searchOPT" value="contributor"/>
			<label for="title">Contributor</label>
			<p>Please select an option: Song Title, Artist, or Contributor before search!</p>
			<p>Or a blank search will return all songs and their respective versions!</p>
			<p>A list of song data will be provided below</p>
			<p>Some songs may have more than one version, so pay attention!</p>
			<input type="text" name="search" placeholder="Search for songs!">
			<button type="submit">
		</form>
	</div>
	<h2>List Of Song Data To Choose From:</h2>
		<p>
1. Title: Montero (Call Me By Your Name)
		Artist: Lil Nas X
		Contribs: Montero Hill, Denzel Baptiste, David Biral, Omer Fedi, and Rosario Lenzo (Writers) Omer Fedi, Take A Daytrip, Rosario Lenzo(Producers)
		<br></br>
2. Title: Drivers License
		Artist: Olivia Rodrigo
		Contribs: Daniel Nigro and Olivia Rodrigo (Writers) Daniel Nigro (Producer)
		<br></br>
3. Title: Levitating 
		Artist: Dua Lipa ft DaBaby
		Contribs: DaBaby(vocals) Clarence Bernard Coffee, Sarah Theresa Hudson, Stephen Noel Kozmeniuk, and Dua Lipa (Writers) KOZ, Stuart Price(Producers)
		<br></br>
4. Title: Blinding Lights
		Artist: The Weeknd
		Contribs: Max Martin, The Weeknd, Jason Quenneville, Oscar Holter, and Ahmad Balshe (Writers) Max Martin, Oscar Holter, The Weeknd(Producers)
		<br></br>
5. Title: Astronaut in the Ocean
		Artist: Masked Wolf
		Contribs: Harry Michael, Tyron Hapi(Writers) Tyron Hapi(Producers)
		<br></br>
6. Title: What You Know Bout Love
		Artist: Pop Smoke
		Contribs: Bashar Jackson, Elgin Lumpkin, Tashim Zene, Troy Oliver (Writers) IamTash(Producer)
		<br></br>
7. Title: Mood
		Artist: 24kGoldn feat iann dior
		Contribs: iann dior(vocals) Blake Slatkin, Omer Fedi, Golden Landis Von Jones, Keegan Bach, Michael Olmo(Writers) KBeaZy, Blake Slatkin, Omer Fedi(Producers)
		<br></br>
8. Title: What's Next
		Artist: Drake
		Contribs: Drake, Jonathan Demario Priester, Maneesh Bidaye(W) Supah Mario, Maneesh(P)
		<br></br>
9. Title: Without You
		Artist: The Kid LAROI
		Contribs: Billy Walsh, Blake Slatkin, Omer Fedi, Charlton Howard(W) Omer Fedi, Blake Slatkin(P)
		<br></br>
10. Title: Track Star
		Artist: Mooski
		Contribs: Darien Hinton, Levi de Jong(W) Woodpecker(P)
		<br></br>
11. Title: Goosebumps
		Artist: Travis Scott
		Contribs: Kevin Gomringer, Tim Gomringer, Brock Korsan, Daveon Jackson, Jacques Webster, Kendrick Duckworth, Ronald LaTour(W) Cardo, CuBeatz, YeX(P)
		<br></br>
12. Title: Whoopty
		Artist: CJ
		Contribs: Charalambos Antoniou, Christopher Daniel Soriano, Mithoon(W) Pxcoyo(P)
		<br></br>
13. Title: The Box
		Artist: Roddy Ricch
		Contribs: Samuel Gloade, Adarius Moragne, Aqeel Qadir Tate, Khirye Anthony Tyler, Larrance Dopson, Rodrick Moore(W) 30 Roc, Datboisqueeze(P)
		<br></br>
14. Title: Say So
		Artist: Doja Cat
		Contribs: Amala Zandile Dlamini, Lukasz Gottwald, Lydia Asrat(W) TYSON  TRAX(P)
		<br></br>
15. Title: Heartless
		Artist: Kanye West
		Contribs: Jeff Bhasker, Mr Hudson, Kanye West, Malik Yusef Jones, No I.D, Scott Mescudi(W) Kanye West, No I.D(P)
		<br></br>
16. Title: Riptide
		Artist: Vance Joy
		Contribs: Vancy Joy(W) Edwin White, James Keogh, John Castle(P)
		<br></br>
17. Title: Replay
		Artist: Iyaz
		Contribs: Jason Desrouleaux, Jonathan Rotem, K. Smith, Keidran Jones, Kisean Anderson, Theron Thomas, Timothy Thomas(W)
		<br></br>
18. Title: Dark Place
		Artist: Logic
		Contribs: Arkae Tuazon, Chazwick Bundick, Dexter Wansel, Garry Marshall Shider, George Bernard Worrell, Jr.George Clinton Jr. Sir Robert Bryson Hall II (W) Kajo, Logic, Toro y Moi(P)
		<br></br>
19. Title: Soundtrack 2 My Life
		Artist: Kid Cudi
		Contribs: Scott Mescudi(W) Emile Haynie(P)
		<br></br>
20. Title: All Girls Are The Same
		Artist: Juice WRLD
		Contribs: Jarad Higgins, Nick Mira(W) Nick Mira(P)
		<br></br>
21. Title: No Role Modelz
		Artist: J. Cole
		Contribs: Brandt Jones, Danell Stevens, Darius Barnes, Earl Stevens, J. Cole, Jordan Houston, Marvin Whitemon, Paul Beauregard, Tenina Stevens(W) J. Cole, Darius Barnes(P)
		<br></br>
22. Title: Nikki
		Artist: Logic
		Contribs: Arjun Ivatury, Narada Michael Walden, Sir Robert Bryson Hall II(W) Logic, 6ix(P)
		<br></br>
23. Title: 3005
		Artist: Childish Gambino
		Contribs: Ludwig Goransson, Donald Glover (W)
		<br></br>
24. Title: Fire Squad
		Artist: J. Cole
		Contribs: Brion Unger, J. Cole, Manzel Bush, Mark Farner(W) J. Cole, Vinylz(P)
		<br></br>
25. Title: Neighbors
		Artist: J. Cole
		Contribs: Anthony Parrino, J. Cole, Ronnie Foster(W) J.Cole(P)
		<br></br>
26. Title: Under Pressure
		Artist: Logic
		Contribs: Abrim Tilmon, André Romell Young, Bernie Worrell, Claire Courchene, Eric Wright, George Clinton, Guy Wood, Kevin Randolph, Lorenzo Patterson, Rob Kinelski, Robert Bryson Hall, Robert Mellin, Steve Wyreman, William Collins(W) Logic, Steve Wyreman, Rob Kinelski(P)
		<br></br>
27. Title: Crossing Field
		Artist: LiSA
		Contribs: Sho Watanbe(W and P)
		<br></br>
28. Title: Unravel
		Artist: TK
		Contribs: Toru Kitajima(W and P)
		<br></br>
29. Title: Black Rover
		Artist: Vickeblanka
		Contribs: Vickeblanka(W and P)
		<br></br>
30. Title: Shinzou wo Sasageyo
		Artist: Linked Horizon
		Contribs: REVO(W and P)
		<br></br>
	</p>
	<br></br>
	</head>
	
	<br><a href="djview.php">DJ VIEW</a>
</html>