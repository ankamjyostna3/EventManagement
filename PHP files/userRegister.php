 <?php 


require("Conn.php");
require("MySQLDao.php");
//$email = htmlentities($_POST["email"]);
//$password = htmlentities($_POST["password"]);



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

$dao = new MySQLDao();
$dao->openConnection();
$userDetails = $dao->getUserDetails($email);

if(!empty($userDetails))
{
$returnValue["status"] = "error";
$returnValue["message"] = "User already exists";
echo json_encode($returnValue);
return;
}

//$secure_password = md5($password); // I do this, so that user password cannot be read even by me



$sql = "insert into users (user_email,user_password) values('" .$email."','".$password. "')";

$result = $dao->registerUser($email,$password);

if($result)
{
$returnValue["status"] = "Success";
$returnValue["message"] = "User is registered";

echo json_encode($returnValue);
return;
}





$dao->closeConnection();

?>
