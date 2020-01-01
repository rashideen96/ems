<?php 
session_start();

include('includes/db.php');
if (!$_SESSION['user']) {
	header('Location: index.php');
}

$empID = isset($_GET['id']) ? $_GET['id'] : '';

$db_query = $conn->query("SELECT * FROM employees WHERE id=$empID");
if ($db_query) $db_row = $db_query->fetch_assoc();
else die($conn->error);


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
  	<br>
  	<br>
    <div class="container">
    	<div class="row">
    		<div class="col-lg-4">
    			<h2>Employee Detail</h2>
    		</div>
    		<div class="col-lg-8">
    			<form action="" method="POST" id="add_employee" enctype="multipart/form-data">
    				<div class="form-group">
						<img src="img/<?= $db_row['img'] ?>" alt="image" class="img_preview thumbnail shadow rounded-circle">
					</div>
	    			<div class="form-group">
	    				<input type="hidden" name="id" id="empid" value="<?= $db_row['id']  ?>"> 
	    				<label>Fullname</label>
	    				<input type="text" name="fullname" class="form-control form-control-sm rounded-0" value="<?= $db_row['fullname'] ?>" disabled>
	    			</div>
	    			<div class="form-group">
	    				<label>IC No</label>
	    				<input type="number" name="ic_no" class="form-control form-control-sm rounded-0" value="<?= $db_row['ic_no'] ?>" disabled>
	    			</div>
	    			<div class="form-group">
	    				<label>Date of Birth</label>
	    				<input type="text" name="dob" class="form-control form-control-sm rounded-0" value="<?= $db_row['dob'] ?>" disabled>
	    			</div>
	    			<div class="form-group">
	    				<label>Joined Date</label>
	    				<input type="text" name="joined_date" class="form-control form-control-sm rounded-0" value="<?= $db_row['joined_date'] ?>" disabled>
	    			</div>
	    			<div class="form-group">
	    				<label>Email</label>
	    				<input type="email" name="email" class="form-control form-control-sm rounded-0" value="<?= $db_row['email'] ?>" disabled>
	    			</div>
	    			<div class="form-group">
	    				<label>Phone No</label>
	    				<input type="text" name="phone_no" class="form-control form-control-sm rounded-0" value="<?= $db_row['phone_no'] ?>" disabled>
	    			</div>
	    			<hr>
	    			<div class="form-group">
	    				<label>Gender</label>
	    				<input type="text" name="gender" class="form-control form-control-sm rounded-0" value="<?= $db_row['gender'] ?>" disabled>
	    			</div>
	    			<div class="form-group">
	    				<label>Status</label>
	    				<input type="text" name="status" class="form-control form-control-sm rounded-0" value="<?= $db_row['status'] ?>" disabled>
	    			</div>
					<div class="form-group">
						<label>Address 1</label>
						<textarea class="form-control form-control-sm rounded-0" name="address1" rows="5" disabled><?= $db_row['address1'] ?></textarea>
					</div>
					<div class="form-group">
						<label>Address 2</label>
						<textarea class="form-control form-control-sm rounded-0" name="address2" rows="5" disabled><?= $db_row['address2'] ?></textarea>
					</div>
					<div class="form-group">
						<!-- <input type="submit" name="add" class="btn btn-primary rounded-pill" value="Add Employee"> -->
						<button class="btn btn-primary rounded-pill" onclick="edit();">Edit</button>
						<button class="btn btn-primary rounded-pill" onclick="goBack()">Go Back</button>
					</div>
				</form>
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
    
  </body>
  <script>
	function goBack() {
	  		window.history.back();
	  	}
  	function edit() {
  		var id = document.getElementById('empid').value;
  		window.location.href = "edit_employee.php?id="+id;
  	}
  	 function readURL(input, imageSelector) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(imageSelector).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

    }

    function removeImg(input, selector) {
        input.src = 'https://wolper.com.au/wp-content/uploads/2017/10/image-placeholder.jpg';
        $(selector).val('');
    }

    $(document).ready(function(){

    	$("#add_employee").validate({
			rules: {
				fullname: {
					required: true, 
					minlength: 5
				}, 
				ic_no: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				phone_no: {
					required: true,
					minlength: 7
				},
				gender: {
					required: true,
				},
				status: {
					required: true
				},
				address1: {
					required: true,
					minlength: 10,
				},
				address2: {
					required: false
				},
				img1: {
					required: true
				}
			}, 
			submitHandler: function(form) {

				var formData = new FormData($('#add_employee')[0]);
		        $.ajax({
	              url: "ajax/add_employee.php",
	              type: "POST",
	              data: formData,
	              processData: false,  // tell jQuery not to process the data
	              contentType: false,   // tell jQuery not to set contentType
	              success: function(data) {
	                // clearForm();
	               $('#add_employee')[0].reset();
	                Swal.fire({
	                      icon: 'success',
	                      title: 'success',
	                      text: data
	                    });

	                 // console.log("PHP Output:");
	                 //    console.log( data );
	                 // $('#complaintForm')[0].reset();

	              },
	              error: function(err) {
	                console.log(err);
	              }
	           
	            });
		    }
		});

    	// $('#add_employee').submit(function(e) {
    	// 	e.preventDefault();

    	// 	var formData = new FormData($('#add_employee')[0]);
     //        $.ajax({
     //          url: "ajax/add_employee.php",
     //          type: "POST",
     //          data: formData,
     //          processData: false,  // tell jQuery not to process the data
     //          contentType: false,   // tell jQuery not to set contentType
     //          success: function(data) {
     //            // clearForm();
     //           $('#add_employee')[0].reset();
     //            Swal.fire({
     //                  icon: 'success',
     //                  title: 'success',
     //                  text: data
     //                });

     //             // console.log("PHP Output:");
     //             //    console.log( data );
     //             // $('#complaintForm')[0].reset();

     //          },
     //          error: function(err) {
     //            console.log(err);
     //          }
           
     //        });
    	// });
    		
    })
  </script>
</html>