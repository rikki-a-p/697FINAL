<!DOCTYPE html>
<html>
<head> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<title>Game of Thrones - View Religion</title>
<body>
<?php
/*include files*/
include_once 'header.php';
require_once 'login.php';

/*Create connection*/
$conn = new mysqli($hn, $un, $pw, $db);
/*Check connection*/
if ($conn->connect_error) die($conn->connect_error);

/*Get religion*/
if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);
	
/*Database query*/
	$query = "SELECT * FROM religions WHERE religionID=".$id;
	$result = $conn->query($query);
	if (!$result) die ("Invalid religion id.");
	$rows = $result->num_rows;
	
/*Is ID valid?*/
	if ($rows == 0) {
		echo "No religion found with id of $id<br>";
	} else {
		
/*Query result is displayed*/
		while ($row = $result->fetch_assoc()) {
			echo "<table><tr><th>ID</th><th>Religion Name</th><th>Conception</th><th>Clergy</th><th>Additional Notes</th></tr>";
			echo '<tr>';
			echo "<td>".$row["religionID"]."</td><td>".$row["religionName"]."</td><td>".$row["conception"]."</td><td>".$row["clergy"]."</td><td>".$row["notes"];		
			echo '</tr>';
			echo "</table>";
		}
	}
	echo "<p><a href=\"suppinfo.php\">Return to supplemental information</a></p>";
} else {
	echo "No religion id passed";
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