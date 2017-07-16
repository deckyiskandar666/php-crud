<!DOCTYPE HTML>
<html>
<head>
	<title>PDO - Read One Record - PHP CRUD Tutorial</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
	
	<!-- container -->
	<div class="container">
		<div class="page-header">
			<h1>Read Product</h1>
		</div>

		<?php 
			// get passed parameter value, in this case, the record ID
			// isset() is a PHP function used to verify if value is there or not
			$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record id not found.');

			// include database connection
			include 'config/database.php';

			// read current's record data
			try {
				// prepare select query
				$query = "SELECT id, name, description, price FROM products WHERE id = ? LIMIT 0,1";
				$stmt = $con->prepare($query);

				// this is the first question mark
				$stmt->bindParam(1, $id);

				// execute our query
				$stmt->execute();

				// store retrieved row to a variable
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				// values to fill up our form
				$name = $row['name'];
				$description = $row['description'];
				$price = $row['price'];
			} catch (PDOException $exception) {
				echo "ERROR: " . $exception->getMessage();
			}
		?>

		<!-- we have our html table here where new product information will be displayed -->
		<table class="table table-hover table-responsive table-bordered">
			<tr>
				<td>Name</td>
				<td><?=htmlspecialchars($name, ENT_QUOTES)?></td>
			</tr>
			<tr>
				<td>Description</td>
				<td><?=htmlspecialchars($description, ENT_QUOTES)?></td>
			</tr>
			<tr>
				<td>Price</td>
				<td><?=htmlspecialchars($price, ENT_QUOTES)?></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<a href="index.php" class="btn btn-danger">Back to read products</a>
				</td>
			</tr>
		</table>
	</div>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>