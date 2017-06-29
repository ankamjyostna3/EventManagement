<?php
 
// Create connection
$con=mysqli_connect("courses","id","pass","schema");
 
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = htmlentities($_POST["sql"]);
$sql = preg_replace("/&#?[a-z0-9]{2,8};/i","",$sql);
 
// This SQL statement selects ALL from the table 'Locations'
//$sql = "SELECT user_email FROM users";
 
// Check if there are results
if ($result = mysqli_query($con, $sql))
{
	// If so, then create a results array and a temporary one
	// to hold the data
	$resultArray = array();
	$tempArray = array();
	$final = array();	 
	// Loop through each row in the result set
	while($row = $result->fetch_object())
	{
		// Add each row into our results array
		$tempArray = $row;
	    array_push($resultArray, $tempArray);
	}
 $final["result"]= $resultArray;
//$final["sql"] = $sql;
	// Finally, encode the array to JSON and output the results
	echo json_encode($final);
}
 
// Close connections
mysqli_close($con);
?>
