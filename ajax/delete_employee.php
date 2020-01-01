<?php 

include('../includes/db.php');
// print_r($_POST);
// echo $_POST['id'];
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	// $filename = '../img/to/file.txt';
	// 	if (file_exists($filename)) {
	// 	$success = unlink($filename);
	// 	if (!$success) {
	// 	throw new Exception("Cannot delete $filename"); 
	// 	} 

	// }

	// $retFile = $conn->query("SELECT * FROM employees WHERE id=$id");
	// if ($retFile->num_rows == 1) {
	// 	$fileInfo = $retFile->fetch_assoc();

	// 	$filename = '../img/'.$fileInfo['img'];
	// }

	
	$db_query = $conn->query("DELETE FROM employees WHERE id=$id");
	if ($db_query) echo "Successfully Deleted!";
	else {
		die($conn->connect_error);
		exit();
	}
}


 ?>