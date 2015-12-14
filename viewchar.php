<!DOCTYPE html>
<html>
<head> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<title>Game of Thrones - View Character</title>
<body>
<?php
/*include files*/
include_once 'header.php';
require_once 'login.php';

/*Create connection*/
$conn = new mysqli($hn, $un, $pw, $db);
/*Check connection*/
if ($conn->connect_error) die($conn->connect_error);

/*Get character*/
if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);
	
/*Database query*/
	$query = "SELECT * FROM characters WHERE characterID=".$id;
	$result = $conn->query($query);
	if (!$result) die ("Invalid character id.");
	$rows = $result->num_rows;
	
/*Is ID valid?*/
	if ($rows == 0) {
		echo "No character found with id of $id<br>";
	} else {
		while ($row = $result->fetch_assoc()) {
			
/*Query result is displayed*/
			echo "<table><tr><th>ID</th><th>Frist Name</th><th>Last Name</th><th>Also known as</th><th>Origin</th><th>Affiliation</th><th>Role</th></tr>";
			echo '<tr>';
			echo "<td>".$row["characterID"]."</td><td>".$row["firstName"]."</td><td>".$row["lastName"]."</td><td>".$row["altName"]."</td><td>".$row["originID"]."</td><td>".$row["houseID"]."</td><td>".$row["role"];		
			echo '</tr>';
			echo "</table>";
		}
	}
	echo "<p><a href=\"index.php\">Return to homepage</a></p>";
} else {
	echo "No character id passed";
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