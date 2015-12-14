<!DOCTYPE html>
<html>
<head> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<title>Game of Thrones - View Affiliation</title>
<body>
<?php
/*include files*/
include_once 'header.php';
require_once 'login.php';

/*Create connection*/
$conn = new mysqli($hn, $un, $pw, $db);
/*Check connection*/
if ($conn->connect_error) die($conn->connect_error);

/*Get house*/
if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);

/*Database quety*/
	$query = "SELECT * FROM houses WHERE houseID=".$id;
	$result = $conn->query($query);
	if (!$result) die ("Invalid house id.");
	$rows = $result->num_rows;
	
/*Is ID valid?*/
	if ($rows == 0) {
		echo "No house found with id of $id<br>";
	} else {
		
/*Query result is displayed*/
		while ($row = $result->fetch_assoc()) {
			echo "<table><tr><th>ID</th><th>Affiliation Name</th><th>Type</th><th>Sigil</th><th>Saying</th></tr>";
			echo '<tr>';
			echo "<td>".$row["houseID"]."</td><td>".$row["houseName"]."</td><td>".$row["type"]."</td><td>".$row["sigil"]."</td><td>".$row["saying"]."</td>";		
			echo '</tr>';
			echo "</table>";
		}
	}
	echo "<p><a href=\"suppinfo.php\">Return to supplemental information</a></p>";
} else {
	echo "No house id passed";
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