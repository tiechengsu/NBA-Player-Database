<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php 
$customerID = $_GET['customerID'];
	 
?>

<?php
$currentPage = array_pop(explode("/",$_SERVICE['PHP_SELF']));
if($currentPage == "players.php") $playersPage = 'class="active"';
elseif($currentPage == "Teams.php") $teamPage = 'class="active"';
elseif($currentPage == "User.php") $userPage = 'class="active"';
elseif($currentPage == "myCollection.php") $collectionPage = 'class="active"';
elseif($currentPage == "Cart.php") $cartPage = 'class="active"';
require_once('secure_dbsetup/db_setup.php');
$sql = "USE tsu5;";
if($conn->query($sql) === FALSE) {           
    echo "Error using database: " . $conn->error;
}

$sql = "SELECT gameCoins FROM user WHERE customerID = "."'$customerID'".";";
$result = $conn->query($sql);
$coins = "";
if($result->num_rows>0){
	$row = $result->fetch_assoc();
	$coins = $row['gameCoins'];	
}

$items = 0;
$sql = "SELECT COUNT(*) FROM cart WHERE userID="."'$customerID'".";";
$result_cart = $conn->query($sql);
$row_cart = $result_cart->fetch_assoc();
$items = $row_cart['COUNT(*)'];

?>
    <div class="container-fluid">
		<div class="row">
        		<div class="col-xs-2 col-sm-2 col-md-2 sidebar">
            			<ul class="nav nav-sidebar">
				<li <?php echo $playersPage; ?>><a href="players.php?customerID=<?php echo $customerID; ?>" ><span class="glyphicon glyphicon-user">Players</span></a></li>
                			<li <?php echo $teamPage; ?>><a href="Teams.php?customerID=<?php echo $customerID; ?>"><span class="glyphicon glyphicon-home">Teams</span></a></li>
                			<li <?php echo $userPage; ?>><a href="User.php?customerID=<?php echo $customerID; ?>"><span class="glyphicon glyphicon-king">User</span></a></li>
				<li><?php echo $collectionPage; ?><a href="myCollection.php?customerID=<?php echo $customerID; ?>"<span class="glyphicon glyphicon-file">My Collection</span></a></li>
                			<li <?php echo $cartPage; ?>><a href="Cart.php?customerID=<?php echo $customerID; ?>"><span class="glyphicon glyphicon-piggy-bank">Cart</span></a></li>
           			 </ul>
        		</div>
			<div class="col-xs-10 col-sm-10 col-md-10">
				<span class="pull-left">Coins : <?php echo $coins ?></span>
				<br/><span class="pull-left"><?php echo $items." Items in Cart"?></span>
				<span class="pull-right"><?php echo $customerID . "   "?><a href="login.php">logout</a></span>
				<span class="text-center"><h1>NBA Player Database</h1></span>
			</div>
