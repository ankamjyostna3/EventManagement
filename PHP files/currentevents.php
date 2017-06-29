<?php
 
// Create connection
$con=mysqli_connect("courses","id","password$","schema");
 
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
// This SQL statement selects ALL from the table 'Locations'
$sql = "SELECT * FROM events";
 
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
	// Finally, encode the array to JSON and output the results
//	echo json_encode($resultArray);
echo json_encode($final);
}
 
// Close connections
mysqli_close($con);
?>
