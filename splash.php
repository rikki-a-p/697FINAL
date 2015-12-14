<!DOCTYPE html>
<html>
<head> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<title>Game of Thrones</title>
<body>
<?php
include_once 'header.php';
require_once 'login.php';
?>
<form action="index.php" method="GET">
<input type="hidden" name="form_submitted" value="1">
<p> This is a database-driven website that stores data about the television series <i>Game of Thrones</i>, an adaptation of the 
<i>A Song of Ice and Fire</i> series by George R. R. Martin. This site is <b>NOT</b> spoiler free and has been created to reflect the most up to date
information, congruent with Season 5 the most recently completed series. This site can be used to learn more about the show and be used as a source for 
basic Game of Thrones information.
</p>
<img src="jon.jpg" alt="Jon Season 6 Promo" height="240" width="500" align="middle" class="center">
<p>Do you wish to proceed?<p>
<input type="submit" value="YES">
</form> 
</body> 
</html>
