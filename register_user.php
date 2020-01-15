<?php 
ob_start();
session_start();

include('includes/db.php');

$msg = '';
if (isset($_POST['login'])) {
  $username = $conn->real_escape_string($_POST['username']);
  $password = $conn->real_escape_string($_POST['password']);

  $db_query = $conn->query("SELECT * FROM users WHERE username = '$username'");
  if ($db_query->num_rows == 0) $msg = "Username not exists";
  else {
    $db_row = $db_query->fetch_assoc();
    if (password_verify($password, $db_row['password'])) {
            // echo 'Valid Password'; 
            $_SESSION['user'] = $db_row;
            $_SESSION['admin'] = true;
            header('Location: dashboard.php');
        } else $msg = 'Wrong Password.';
  }
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

    <link rel="stylesheet" href="css/style.css">

    <title>Registration</title>
  </head>
  <body>
  	<div class="sidenav">
         <div class="login-main-text">
            <h2>Register User</h2>
            <p>Registration Form</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form action="" method="POST" id="registerForm">

                  <div class="form-group">
                     <label>User Name</label>
                     <input name="username" type="text" class="form-control rounded-0" placeholder="User Name" required>
                  </div>
                  <div class="form-group">
                     <label>Email</label>
                     <input name="email" type="email" class="form-control rounded-0" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input name="password" type="password" class="form-control rounded-0" placeholder="Password" required>
                  </div>
                  <button name="register" type="submit" class="btn btn-black rounded-0">Register</button>

               </form>
            </div>
         </div>
      </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
    	$(document).ready(function(){
    		$('#registerForm').on('submit', function(e) {
    			e.preventDefault();
	    		       $.ajax({
			              url: "ajax/register_user.php",
			              type: "POST",
			              data: $('#registerForm').serialize(),
			              success: function(data) {

			               $('#registerForm')[0].reset();
			                

			                 console.log("PHP Output:");
			                    console.log( data );

			              },
			              error: function(err) {
			                console.log(err);
			              }
			           
			            });

    		})


    		
    		
    	});
    </script>
  </body>
</html>