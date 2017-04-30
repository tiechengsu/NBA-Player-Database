<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NBA My Team</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php
require_once('secure_dbsetup/db_setup.php');

$sql = "USE tsu5;";
if($conn->query($sql)===TRUE){

}else{
	echo "Error using database: " . $conn->error;
}

if(isset($_POST['login_userID']) && isset($_POST['login_password'])){
	$login_userID = $_POST['login_userID'];
	$login_password = $_POST['login_password'];



	$sql = 
"SELECT hashingPassword FROM user 
WHERE customerID = "."'$login_userID'".";";
}
$result = $conn->query($sql);
if($result->num_rows > 0){
	$row = $result->fetch_assoc();

	if(password_verify($login_password,$row['hashingPassword'])){

	$link = "<script>window.location.href = 'players.php?customerID=". $login_userID ."'</script>";
	echo $link;}else{
		echo "<script type='text/javascript'>alert('Check your password and userID');</script>";
	}
}	

if(isset($_POST['userID']) && isset($_POST['name']) && isset($_POST['password'])){
	$userID = $_POST['userID'];
	$name = $_POST['name'];
	$password = $_POST['password'];

$hashPwd = password_hash($password,PASSWORD_BCRYPT);

//echo $hashPwd;

	$sql = <<<SQL

INSERT INTO 
user(customerID, name, hashingPassword) 
VALUES('{$userID}','{$name}','{$hashPwd}');
SQL;


	if($conn->query($sql)===True){
		echo "<script type='text/javascript'>alert('User created');</script>";
	}else{
		echo "<script type='text/javascript'>alert('userID already exist');</script>";
	}

}

$conn->close();



?>

	<div class="login-page">
		<div class="form">
				<form class="register-form" method="POST">
					<input type="text" name="userID" placeholder="userID"/>
					<input type="text" name="name" placeholder="name"/>
					<input type="password" name="password" placeholder="password"/>
					<input type="submit" value="create" class="login_submit">
					<p class="message">Already registered? <a href="#">Sign In</a></p>
				</form>
				<form class="login-form" method="POST">
					<input type="text" name="login_userID" placeholder="userID">
					<input type="password" name="login_password" placeholder="password">
					<input type="submit" value="login" class="login_submit">
					<p class="message">Not registered? <a href="#">Create an account</a></p>
				</form>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>
</body>
</html>
