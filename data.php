<?php
 
// STEP 1: Establish a database connection
$host = "303.itpwebdev.com";
$user = "akerwin_db_user";
$password = "USCitp2021";
$db = "akerwin_newgirl_db";

$mysqli = new mysqli($host, $user, $password, $db);

if( $mysqli->connect_error ) {
	echo $mysqli->connect_error;
	// exit() exits the program here. No subsequent code is run.
	exit();
}

$mysqli->set_charset("utf8");



$sql_characters= "SELECT characters.character, count(*) 
FROM quotes
JOIN characters
ON characters.character_id = quotes.character_id
GROUP BY quotes.character_id";

// Submit the query 
$results_characters = $mysqli->query($sql_characters);

$php_data_array = Array(); // create PHP array
  echo "<table>
<tr> <th>Character</th><th>Number Quotes</th></tr>";
while ($row = $results_characters->fetch_row()) {
   echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
   $php_data_array[] = $row; // Adding to array
   }

    echo "</table>";
    

if(!$results_characters) {
	echo $mysqli->error;
	exit();
}

$sql_seasons = "SELECT season, count(*) 
FROM quotes
GROUP BY season";

// Submit the query 
$results_seasons = $mysqli->query($sql_seasons);

$php_seasons_array = Array(); // create PHP array
  echo "<table>
<tr> <th>Season</th><th>Number Quotes</th></tr>";
while ($row = $results_seasons->fetch_row()) {
   echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
   $php_seasons_array[] = $row; // Adding to array
   }
    echo "</table>";





 
// Close connection
$mysqli->close();

?>

<!DOCTYPE HTML>
<html>
<head>

<!-- <script>

    
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Quotes per character"
	},
	subtitles: [{
		text: ""
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($php_data_array, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script> -->
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
