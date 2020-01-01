<?php 

session_start();

include('includes/db.php');
if (!$_SESSION['user']) {
	header('Location: index.php');
}
 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Dashboard</title>
  </head>
  <body>
  	<?php include('includes/nav.php') ?>
  	<br>
  	<br>
    <div class="container">
    	<div class="row">
    		<div class="col-lg-4">
    			<h2>Dashboard</h2>
    		</div>
    		<div class="col-lg-8">
    			<div class="row">
    				<div class="col-lg-4">
    					<div class="card shadow">
		    				<div class="card-body">
		    					<h5>Total Employee</h5>
		    					<h2 id="total_employee"><?php 

		    					echo $conn->query("SELECT * FROM employees")->num_rows;

		    					 ?></h2>
		    					<a href="view_employee.php" class="btn btn-primary rounded-0">View</a>
		    				</div>
		    			</div>
    				</div>
    				<div class="col-lg-4">
    					<div class="card shadow">
		    				<div class="card-body">
		    					<h5>Total Past Employee</h5>
		    					<h2><?= $conn->query("SELECT * FROM employees")->num_rows; ?></h2>
		    					<a href="view_past_employee.php" class="btn btn-primary rounded-0">View</a>
		    				</div>
		    			</div>
    				</div>
    			</div>
    			
    		</div>
    	</div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>
</html>