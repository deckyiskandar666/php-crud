<!DOCTYPE HTML>
<html>
<head>
	<title>PDO - Create a Record - PHP CRUD Tutorial</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
	
	<!-- container -->
	<div class="container">
		<div class="page-header">
			<h1>Create Product</h1>
		</div>

		<!-- dynamic content would be here -->
		<!-- html form here where the product information will be entered -->
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<table class="table table-hover table-responsive table-bordered">
				<tr>
					<td>Name</td>
					<td><input type="text" name="name" class="form-control"></td>
				</tr>
				<tr>
					<td>Description</td>
					<td><input type="text" name="description" class="form-control"></td>
				</tr>
				<tr>
					<td>Price</td>
					<td><input type="text" name="price" class="form-control"></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="Submit" class="btn btn-primary">
						<a href="index.php" class="btn btn-danger">Back to read products</a>
					</td>
				</tr>
			</table>
		</form>

	</div>

	<?php 
		if($_POST) {

			// include database connection
			include 'config/database.php';

			try {

				// insert query
				$query = "INSERT INTO products SET name=:name, description=:description, price=:price, created=:created";

				// prepare for the query execution
				$stmt = $con->prepare($query);

				// posted values
				$name = htmlspecialchars(strip_tags($_POST['name']));
				$description = htmlspecialchars(strip_tags($_POST['description']));
				$price = htmlspecialchars(strip_tags($_POST['price']));

				// bind the parameters
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':description', $description);
				$stmt->bindParam(':price', $price);

				// specify when this record was inserted to the database
				$created = date('Y-m-d H:i:s');
				$stmt->bindParam(':created', $created);

				// Execute query
				if($stmt->execute()) {
					echo "<div class='alert alert-success'>Record was saved.</div>";
				} else {
					echo "<div class='alert alert-danger'>Unable to save record.</div>";
				}
			} catch(PDOException $exception) {
				die('ERROR: ' . $exception->getMessage());
			}
		}
	?>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>