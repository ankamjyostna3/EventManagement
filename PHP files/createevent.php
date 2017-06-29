<?php
 
// Create connection
$con=mysqli_connect("courses","z1789593","id","password");
 
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = htmlentities($_POST["sql"]);

$sql = preg_replace("/&#?[a-z0-9]{2,8};/i","",$sql);
$returnValue = array();

if ($con->query($sql) === TRUE) {
	$returnValue["status"] = "Success";
	$returnValue["message"] = "Data Inserted";
	$returnValue["sql"] = $sql;
	echo json_encode($returnValue);
	return;

} else {

	$returnValue["status"] = "Failed";
	$returnValue["message"] = "Couldnot do";
	$returnValue["sql"]=$sql;
	$returnValue["error"]=$con->error;
	echo json_encode($returnValue);
	return;
    //echo "Error: " . $sql . "<br>" . $con->error;
}
 
 
 
// Close connections
mysqli_close($con);
?>
