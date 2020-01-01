<?php 

include('../includes/db.php');

if (isset($_POST['id'])) {

	$id = $_POST['id'];

	// Array ( [fullname] => wwwwwwwwwwwwwww [ic_no] => 2222222222222222222 [email] => funstudy10@gmail.com [phone_no] => 0122236788 [gender] => male [status] => single [address1] => qwwwqwqwqw [address2] => qwqwqwqw [add] => Add Employee )

	// Array ( [img1] => Array ( [name] => 9izokrL9T.gif [type] => image/gif [tmp_name] => C:\xampp\tmp\phpF2AB.tmp [error] => 0 [size] => 19616 ) )

	$fullname = $_POST['fullname'];
	$ic_no = $_POST['ic_no'];
	$dob   = $_POST['dob'];
	$joined_date = $_POST['joined_date'];
	$email = $_POST['email'];
	$phone_no = $_POST['phone_no'];
	$gender = $_POST['gender'];
	$status = $_POST['status'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];

	// 
	// ensure there isn't an error
	if ($_FILES["img1"]["error"] == UPLOAD_ERR_OK) {
		$folderLocation = "../img"; 
		if (!file_exists($folderLocation)) mkdir($folderLocation);
		// move the file into the folder
		if (move_uploaded_file($_FILES["img1"]["tmp_name"], "$folderLocation/" .
		basename($_FILES["img1"]["name"]))) {

			$file_name = basename($_FILES['img1']['name']);
			$db_query = $conn->query("UPDATE employees SET fullname='$fullname', ic_no='$ic_no', dob='$dob', joined_date='$joined_date',email='$email', phone_no='$phone_no', gender='$gender', status='$status', address1='$address1', address2='$address2', img='$file_name' WHERE id=$id");

			if (!$db_query) {
				// die($conn->connect_error);
				// exit();
				echo "Failed!".$conn->error;
			} else {
				echo "Data is updated!";
			}
		}

	}
	// print_r($_POST);
	// print_r($_FILES);
}


 ?>