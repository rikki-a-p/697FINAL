<!DOCTYPE html>
<html>
<head> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<title>Game of Thrones - Supplemental Information</title>
<body>
<?php
/*include files*/
include_once 'header.php';
require_once 'login.php';
/*The purpose of this page is to provide information to supplement some of the details 
found on the home page. The “Supplemental Information” page will display the data from 
the origins, noble houses, and religions tables.*/

/*Create connection*/
$conn = new mysqli($hn, $un, $pw, $db);
/*Check connection*/
if ($conn->connect_error) die($conn->connect_error);

echo "<p>The following tables provide supplemental character information for: origins, religions, and affiliation. 
Click on IDS for individual listings.</p>";

echo "<img src=origin.jpg alt=King's Landing height=300 width=500 align=middle class=center>";
/*Database query*/
$query = "SELECT * FROM origins";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

/*Origins Table*/
echo "<table><tr><th>ID</th><th>Origin Name</th><th>Type</th><th>Location</th><th>Religion</th><th>Ruler</th></tr>";
while ($row = $result->fetch_assoc()) {
	echo '<tr>';
	echo "<td>"."<a href=\"vieworigin.php?id=".$row["originID"]."\">".$row["originID"]."</a>"."</td>";
	echo "<td>".$row["originName"]."</td><td>".$row["originType"]."</td><td>".$row["location"]."</td>";
	echo "<td>"."<a href=\"viewreligion.php?id=".$row["religionID"]."\">".$row["religionID"]."</a>"."</td>";
	echo "<td>".$row["ruler"]."</td>";		
	echo '</tr>';
}

/*Database query*/
$query = "SELECT * FROM religions";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

/*Religions Table*/
echo "<table><tr><th>ID</th><th>Religion Name</th><th>Conception</th><th>Clergy</th><th>Additional Notes</th></tr>";
while ($row = $result->fetch_assoc()) {
	echo '<tr>';
	echo "<td>"."<a href=\"viewreligion.php?id=".$row["religionID"]."\">".$row["religionID"]."</a>"."</td>";
	echo "<td>".$row["religionName"]."</td><td>".$row["conception"]."</td><td>".$row["clergy"]."</td><td>".$row["notes"]."</td>";		
	echo '</tr>';
}

/*Database query*/
$query = "SELECT * FROM houses";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

/*Houses table*/
echo "<table><tr><th>ID</th><th>Affiliation Name</th><th>Type</th><th>Sigil</th><th>Saying</th></tr>";
while ($row = $result->fetch_assoc()) {
	echo '<tr>';
	echo "<td>"."<a href=\"viewhouse.php?id=".$row["houseID"]."\">".$row["houseID"]."</a>"."</td>";
	echo  "<td>".$row["houseName"]."</td><td>".$row["type"]."</td><td>".$row["sigil"]."</td><td>".$row["saying"]."</td>";		
	echo '</tr>';
}

/*Disconnect from MySQL*/
$result->close();
$conn->close();

?>
</body>
</html>