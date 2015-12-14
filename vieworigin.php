<!DOCTYPE html>
<html>
<head> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<title>Game of Thrones - View Origin</title>
<body>
<?php
/*include files*/
include_once 'header.php';
require_once 'login.php';

/*Create connection*/
$conn = new mysqli($hn, $un, $pw, $db);
/*Check connection*/
if ($conn->connect_error) die($conn->connect_error);

/*Get origin*/
if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);
	
/*Database query*/	
	$query = "SELECT * FROM origins WHERE originID=".$id;
	$result = $conn->query($query);
	if (!$result) die ("Invalid origin id.");
	$rows = $result->num_rows;

/*Is ID valid?*/
	if ($rows == 0) {
		echo "No origin found with id of $id<br>";
	} else {
		
/*Query result is displayed*/
		while ($row = $result->fetch_assoc()) {
			echo "<table><tr><th>ID</th><th>Origin Name</th><th>Type</th><th>Location</th><th>Religion</th><th>Ruler</th></tr>";
			echo '<tr>';
			echo "<td>".$row["originID"]."</td><td>".$row["originName"]."</td><td>".$row["originType"]."</td><td>".$row["location"]."</td><td>".$row["religionID"]."</td><td>".$row["ruler"]."</td><td>";
			echo '</tr>';
			echo "</table>";
		}
	}
	echo "<p><a href=\"suppinfo.php\">Return to supplemental information</a></p>";
} else {
	echo "No origin id passed";
}

function sanitizeString($var)
{
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}
function sanitizeMySQL($connection, $var)
{
	$var = $connection->real_escape_string($var);
	$var = sanitizeString($var);
	return $var;
}

/*Disconnect from MySQL*/
$result->close();
$conn->close();
?>
</body>
</html>