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
    <link rel="stylesheet" href="css/dataTables.min.css">



    <style type="text/css">
        .img_preview {
            height: 200px;
            width: 200px;
        }
    </style>

    <title>Add Employee</title>
  </head>
  <body>
  	<?php include('includes/nav.php') ?>
  	<?php 


  	 ?>
  	<br>
  	<br>
    <div class="container">
    	<h2>View all employee</h2><hr>
    	<div class="row">
	    		<div class="col-lg-12">
	    			<table class="table table-sm table-bordered table-hovered" id="myTable">
	    				<thead>
	    					<tr>
	    						<th>ID</th>
	    						<th>Fullname</th>
	    						<th>Ic no</th>
	    						<th>Email</th>
	    						<th>Phone no</th>
	    						<th>Gender</th>
	    						<th>Status</th>
	    						<th>Address1</th>
	    						<th>Address2</th>
	    						<th>Photo</th>
	    						<th>Action</th>
	    					</tr>
	    				</thead>
	    				<tbody>

	    					<?php 

	    					$db_query = $conn->query("SELECT * FROM employees");
	    					if ($db_query) {

	    						while ($db_row = $db_query->fetch_assoc()) {
	    							?>

	    						<tr>
		    						<td><?= $db_row['id']; ?></td>
		    						<td><?= $db_row['fullname']; ?></td>
		    						<td><?= $db_row['ic_no']; ?></td>
		    						<td><?= $db_row['email']; ?></td>
		    						<td><?= $db_row['phone_no']; ?></td>
		    						<td><?= $db_row['gender']; ?></td>
		    						<td><?= $db_row['status']; ?></td>
		    						<td><?= $db_row['address1']; ?></td>
		    						<td><?= $db_row['address2']; ?></td>
		    						<td><img src="img/<?= $db_row['img']; ?>" class="thumbnail" width="100%" data-id="42" onclick="getSrc(this);"></td>
		    						<td>
		    							<a href="view_employee_detail.php?id=<?= $db_row['id'] ?>" ><i class="fa fa-eye"></i> View</a>
		    							<a href="edit_employee.php?id=<?= $db_row['id'] ?>" ><i class="fa fa-edit"></i> Edit</a>
		    							<a href="#" data-id="<?= $db_row['id']; ?>" onclick="confirmDelete(this)"><i class="fa fa-trash"></i> Delete</a>
		    						</td>
		    					</tr>
	    						<?php
	    						}
	    						
	    					}


	    					 ?>
	    					
	    				</tbody>
	    			</table>
	    		</div>
    	</div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>
    <script src="js/dataTables.min.js"></script>
    
    
  </body>
  <script>

  	$(document).ready(function() {
			$('#myTable').DataTable();
		});

  	function getSrc(input) {
		// alert($(input).attr("data-id"));
		Swal.fire({
          icon: 'success',
          title: 'success',
          text: $(input).attr("data-id")
        });

		window.location.href = "view_employee.php";
	}

	function confirmDelete(input) {

		var id = $(input).attr("data-id");

		Swal.fire({
			icon: 'warning',
          	title: 'Are you sure you want to delete?',
          	// text: $(input).attr("data-id"),
          	showCancelButton: true
		}).then(function(result) {

			if (result.value) {

				var id = $(input).attr("data-id");

					$.ajax({
						url: "ajax/delete_employee.php",
						type: "POST",
						data: {
							id: id
						},
						dataType: "text",
						success: function(data) {
							Swal.fire({
								icon: 'success',
					          	title: 'success',
					          	text: data
							}).then(function() {
									window.location.href = "view_employee.php";
							});
							// .then(function() {
							
							// });

						}
					});
				// Swal.fire(
				// 	'Deleted',
				// 	'Your file has been deleted!',
				// 	'success'
				// )
			}
				
		})

		

		

		// , function(isConfirm) {
		// 	if (!isConfirm) return;

		// 		$.ajax({
		// 			url: "ajax/delete_employee.php",
		// 			type: "POST",
		// 			data: $(input).attr("data-id"),
		// 			dataType: "text",
		// 			success: function(data) {
		// 				Swal.fire({
		// 					icon: 'success',
		// 		          	title: 'success',
		// 		          	text: data
		// 				}, function() {

		// 				})
		// 				// .then(function() {
		// 				// 	window.location.href = "view_employee.php";
		// 				// });

		// 			}
		// 		});

		// }) ;

		// {

			
		// 	if (isConfirm) {
		// 		$.ajax({
		// 			url: "ajax/delete_employee.php",
		// 			type: "POST",
		// 			data: $(input).attr("data-id"),
		// 			dataType: "text",
		// 			success: function(data) {
		// 				Swal.fire({
		// 					icon: 'success',
		// 		          	title: 'success',
		// 		          	text: data
		// 				})
		// 				.then(function() {
		// 					window.location.href = "view_employee.php";
		// 				});

		// 			}
		// 		});
		// 	} 
			
			
		// })

		// Swal({
		// 	title: "Are you sure?",
		// 	text: "You will not be able to recover this data",
		// 	icon: "warning",
		// 	buttons: [
		// 		'No, cancel it',
		// 		'Yes, im sure'
		// 	],
		// 	dangerMode: true
		// }).then(function(isConfirm) {
		// 	if (isConfirm) {
		// 		Swal({
		// 			title: "deleted!",
		// 			text: "data is deleted",
		// 			icon: "success"
		// 		}).then(function() {
		// 			window.location.href = "view_employee.php";
		// 		})
		// 	} else {
		// 		Swal("cancelled", "Data is not deleted", "error");
		// 	}
		// })
	}
  	// $(document).ready(function() {

  		
  	// });

   
  </script>
</html>