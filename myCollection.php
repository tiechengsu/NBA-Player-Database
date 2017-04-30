<?php require "header.php" ?>

<?php 
	
// update
if(isset($_GET['action']) && $_GET['action']=="Sell"){
        $sNum=intval($_GET['sNum']);
        $sql = "UPDATE serialLibrary SET customerID = NULL WHERE serialNumber = ".$sNum.";";
        $result_delete = $conn->query($sql);

	$price = intval($_GET['price']);
	$sql = "UPDATE user SET gameCoins = gameCoins+".$price." WHERE customerID = "."'$customerID'". ";";
	$conn->query($sql);
	 
}

// Query:
$sql = "SELECT playerCard.name,playerCard.position,playerCard.height, playerCard.weight, playerCard.weight, playerCard.team, playerCard.price,serialLibrary.serialNumber
		        FROM playerCard,serialLibrary
			WHERE serialLibrary.ID = playerCard.playerID	
			AND serialLibrary.customerID = ". "'$customerID'" . ";";


$result = $conn->query($sql);
if($result->num_rows >= 0){
?>

<div class="col-md-10 main">
<h1 class="page-header">My Collection</h1>
	<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Player</th>
				<th>Position</th>
				<th>Height</th>
				<th>Weight</th>
				<th>Team</th>
				<th>Price</th>
				<th>SerialNumber</th>
				<th>Action</th>				
			</tr>
		</thead>

		<tbody>
			<?php while($row = $result->fetch_assoc() ) { ?>
				<tr>
					<td><?php echo $row['name'] ?></td>
					<td><?php echo $row['position'] ?></td>
					<td><?php echo $row['height'] ?></td>	
					<td><?php echo $row['weight'] ?></td>	
					<td><?php echo $row['team'] ?></td>	
					<td><?php echo $row['price'] ?></td>
					<td><?php echo $row['serialNumber']?></td>
				
					<td><a href="myCollection.php?customerID=<?php echo $customerID;?>&action=Sell&sNum=<?php echo $row['serialNumber']?>&price=<?php echo $row['price']?>">Sell</a></td>					
	 			</tr>
	 		<?php } } 
	 		else {
				echo "Nothing to display";
				}?>
		</tbody>
	</table>
	</div>
</div>
