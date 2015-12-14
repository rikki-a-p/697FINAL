<!DOCTYPE html>
<html>
<head> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<title>Game of Thrones - Romances</title>
<body>
<?php
/*include files*/
include_once 'header.php';
require_once 'login.php';
/*The purpose of this page is to display character relationships to users. 
The “Character Relationships” page will display the data from the romances table.*/

echo "<p>This table Displays character romances. Click on the Character Id to see who the other Partner is in the Relationship.</p>"; 
echo "<img src=ned.png alt=Ned Stark height=300 width=500 align=middle class=center>";

/*Create connection*/
$conn = new mysqli($hn, $un, $pw, $db);
/*Check connection*/
if ($conn->connect_error) die($conn->connect_error);

/*Database query*/
$query = "SELECT * FROM romances";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

/*Romances table*/
echo "<table><tr><th>ID</th><th>Partner</th><th>Relationship Type</th><th>Status</th></tr>";
while ($row = $result->fetch_assoc()) {
	echo '<tr>';
	echo "<td>"."<a href=\"viewchar.php?id=".$row["characterID"]."\">".$row["characterID"]."</a>"."</td>";
	echo "<td>".$row["partner"]."</td><td>".$row["romType"]."</td><td>".$row["status"]."</td>";		
	echo '</tr>';
}

/*Disconnect from MySQL*/
$result->close();
$conn->close();

?>
</body>
</html>