<!DOCTYPE html>
<html>
<head> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<title>Game of Thrones - Home</title>
<body>

<?php
/*include files*/
include_once 'header.php';
require_once 'login.php';

/*The purpose of this page is to be the landing page of the site. 
This page will display the data from the characters table.*/

echo "<p>Welcome to the home page! The following table has information pertaining to all of the main characters in <i>Game of Thrones</i> seasons 1-5. 
Click on a characters ID number to view their individual listing or their Origin/Affiliation ID to learn more about where they are from 
or to whom they hold allegiance to.</p>"; 

echo "<img src=title.jpg alt=Title Sequence height=270 width=500 align=middle class=center>";

/*Create connection*/
$conn = new mysqli($hn, $un, $pw, $db);
/*Check connection*/
if ($conn->connect_error) die($conn->connect_error);

/*Database query*/
$query = "SELECT * FROM characters";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

/*Characters table*/
echo "<table><tr><th>ID</th><th>Frist Name</th><th>Last Name</th><th>Also known as</th><th>Origin</th><th>Affiliation</th><th>Role</th></tr>";
while ($row = $result->fetch_assoc()) {
	echo '<tr>';
	echo "<td>"."<a href=\"viewchar.php?id=".$row["characterID"]."\">".$row["characterID"]."</a>"."</td>";
	echo "<td>".$row["firstName"]."</td><td>".$row["lastName"]."</td><td>".$row["altName"]."</td>";
	echo "<td>"."<a href=\"vieworigin.php?id=".$row["originID"]."\">".$row["originID"]."</a>"."</td>";
	echo "<td>"."<a href=\"viewhouse.php?id=".$row["houseID"]."\">".$row["houseID"]."</a>"."</td>";
	echo "<td>".$row["role"]."</td>";		
	echo '</tr>';
}

/*Disconnect from MySQL*/
$result->close();
$conn->close();

?>
</body>
</html>