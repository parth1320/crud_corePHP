<?php  

session_start();



$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
// $id = 0
$update = false;
$name = '';
$location = '';




if (isset($_POST['save'])) {
	$name=$_POST['name'];
	$location=$_POST['location'];

	$mysqli->query("INSERT INTO data (name,location) VALUES('$name','$location') ") or die($mysqli->error());


	$_SESSION['message'] = "Record has been saved!";
	$_SESSION['msg_type'] = "success";

	header("location: index.php");


}

if (isset($_GET['delete'])){
	$id=$_GET['delete'];
	$mysqli->query("DELETE FROM DATA WHERE id=$id") or die($mysqli->error());


	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";

	header("location: index.php");

}

if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = 'true';
	$sql = "SELECT * FROM data WHERE id=$id";
	$result = $mysqli->query($sql) or die($mysqli->error());


	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
		$name = $row['name'];
		$location = $row['location'];
    }
} else {
    echo "0 results";
}

	 

}

if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$location = $_POST['location'];

	$mysqli->query("UPDATE data SET name='$name',location='$location' WHERE id=$id" ) or die($mysqli->error());

	$_SESSION['message'] = "Record has been updated!";
	$_SESSION['msg_type'] = "warning";

	header("location: index.php");
}






?>