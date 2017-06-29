<?php

require("Conn.php");
require("MySQLDao.php");
$email = htmlentities($_POST["email"]);

$email = preg_replace("/&#?[a-z0-9]{2,8};/i","",$email);
$password = htmlentities($_POST["password"]);
$password = preg_replace("/&#?[a-z0-9]{2,8};/i","",$password);
$returnValue = array();

if(empty($email) || empty($password))
{
$returnValue["status"] = "error";
$returnValue["message"] = "Missing required field";
echo json_encode($returnValue);
return;
}

//$secure_password = md5($password);

$dao = new MySQLDao();
$dao->openConnection();
$userDetails = $dao->getUserDetailsWithPassword($email,$password);
//$userDetails = $dao->getUserDetails($email);
//$returnValue["userDetail"] = $userDetails;


if(!empty($userDetails))
{
$returnValue["status"] = "Success";
$returnValue["message"] = "User logged in";
//$returnValue["userDetail"] = $userDetails;
//$returnValue["userDetail"] = $userDetails;
echo json_encode($returnValue);
return;
}
else {
$returnValue["userDetail"] = $userDetails;
$returnValue["status"] = "error";
//$returnValue["message"] = "User is not found";
//$returnValue["email"]=$email;
//$returnValue["password"] = $password;
//$returnValue["spassword"] = $secure_password;
echo json_encode($returnValue);
}

$dao->closeConnection();

?>

