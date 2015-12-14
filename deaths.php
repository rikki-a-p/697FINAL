<!DOCTYPE html>
<html>
<head> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<title>Game of Thrones - Deaths</title>
<body>
<?php
/*include files*/
include_once 'header.php';
require_once 'login.php';
/*Probably some of the most pertinent information from Game of Thrones are the character 
deaths, which his page will support. The “Deaths” page will display the data from the deaths 
table.*/

echo "<p>This table displays Main character deaths that have occurred thus far in Game of thrones. 
Click the character ID to reveal who the information pertains to.</p>";

echo "<img src=dany.gif alt=Fire cannot kill a dragon height=300 width=500 align=middle class=center>";

/*Create connection*/
$conn = new mysqli($hn, $un, $pw, $db);
/*Check connection*/
if ($conn->connect_error) die($conn->connect_error);

/*Database query*/
$query = "SELECT * FROM deaths";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

/*Deaths table*/
echo "<table><th>Character</th><th>Season Death</th><th>Episode Death</th><th>Cause of death</th></tr>";
while ($row = $result->fetch_assoc()) {
	echo '<tr>';
	echo "<td>"."<a href=\"viewchar.php?id=".$row["characterID"]."\">".$row["characterID"]."</a>"."</td>";
	echo "<td>".$row["seasonDeath"]."</td><td>".$row["episodeDeath"]."</td><td>".$row["cause"]."</td>";		
	echo '</tr>';
}

/*Disconnect from MySQL*/
$result->close();
$conn->close();

?>
</body>
</html>