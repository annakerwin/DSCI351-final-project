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


$sql_character = "SELECT * FROM characters;";
$results_character = $mysqli->query($sql_character);
if(!$results_character) {
	echo $mysql->error;
	exit();
}

$sql_category = "SELECT category FROM categories;";
$results_category = $mysqli->query($sql_category);
if(!$results_category) {
	echo $mysql->error;
	exit();
}

$sql_seasons = "SELECT season FROM quotes GROUP BY season;";
$results_seasons = $mysqli->query($sql_seasons);
if(!$results_seasons) {
	echo $mysql->error;
	exit();
}


$sql = "SELECT * 
FROM quotes
JOIN characters
ON quotes.character_id = characters.character_id 
WHERE 1=1";


// // Append extra clause to WHERE statment if character is given

if( isset($_GET["character"]) && !empty($_GET["character"]) ) {
	$sql = $sql . " AND characters.character_id =" . $_GET["character"]; }


    // // Append extra clause to WHERE statment if character is given

if( isset($_GET["season"]) && !empty($_GET["season"]) ) {
	$sql = $sql . " AND quotes.season =" . $_GET["season"]; }


    $sql = $sql . ";";

// Submit the query 
$results = $mysqli->query($sql);


if(!$results) {
	echo $mysqli->error;
	exit();
}

// Close connection
$mysqli->close();


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Browse Quotes</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<form action="browse.php" method="GET">
		
	
			<div class="form-group row">
				<label for="charcater-id" class="col-sm-3 col-form-label text-sm-right">Character:</label>
				<div class="col-sm-9">
					<select name="character" id="genre-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- Genre dropdown options here -->
						<?php while($row = $results_character->fetch_assoc()) : ?>
							<option value="<?php echo $row["character_id"]?>">
								<?php echo $row["character"]; ?>
							</option>
						<?php endwhile;?>

					</select>
				</div>
			</div> <!-- .form-group -->
			
			<div class="form-group row">
				<label for="season-id" class="col-sm-3 col-form-label text-sm-right">Season:</label>
				<div class="col-sm-9">
					<select name="season" id="season-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- Label dropdown options here -->
						<?php while($row = $results_seasons->fetch_assoc()) : ?>
							<option value="<?php echo $row["season"]?>">
								<?php echo $row["season"]; ?>
							</option>
						<?php endwhile;?>

					</select>
				</div>
			</div> <!-- .form-group -->

		
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->


    <div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Quote</th>
							<th>Character</th>
							<th>Season</th>
							<th>Episode</th>
						</tr>
					</thead>
					<tbody>
					<?php while($row = $results->fetch_assoc() ) :?>
						<tr>
							<td>
							<?php echo $row["quote"];?> 
							</td>
							<td><?php echo $row["character"];?> </td>
							<td><?php echo $row["season"];?> </td>
							<td><?php echo $row["episode"];?> </td>
						</tr>
						<?php endwhile; ?>

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->






</body>
</html>
