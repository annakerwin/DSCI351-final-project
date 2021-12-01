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

$sql = "SELECT * 
FROM quotes
JOIN characters
ON quotes.character_id = characters.character_id 
WHERE quote LIKE '%" . $_GET["quote"] . "%';";

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
			<h1 class="col-12 mt-4 mb-4">New Girl Quotes Database</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<form action="search.php" method="GET">
			<div class="form-group row">
				<label for="quote-id" class="col-sm-3 col-form-label text-sm-right">Quote Search:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="quote-id" name="quote">
				</div>
			</div> <!-- .form-group -->
		
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
		
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
