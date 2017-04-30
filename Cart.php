<?php

require "header.php";?>

<?php
    
       // query:
//remove from cart
if(isset($_GET['action']) && $_GET['action']=="remove"){
	$id=intval($_GET['id']);
	$sql = "DELETE FROM cart WHERE serialNumber=". $id . " AND userID =  "."'$customerID'".";";
	$conn->query($sql);
}
    $sql = "Select playerCard.name, playerCard.price, serialLibrary.serialNumber FROM cart, playerCard, serialLibrary WHERE cart.userID = ". "'$customerID'" . " AND serialLibrary.serialNumber = cart.serialNumber AND serialLibrary.ID = playerCard.playerID;";
$result = $conn->query($sql);
if(isset($_POST['buy'])){
	$subtotal = intval($_POST['subtotal']);	
	if($subtotal>intval($coins)){
		echo "<script type='text/javascript'>alert('Coins not enough');</script>";	
	}else{
		while($row = $result->fetch_assoc()){
			$sql = "UPDATE serialLibrary SET customerID = "."'$customerID'" . " WHERE serialNumber= ".$row['serialNumber']." AND customerID IS NULL;";
			$conn->query($sql);				
		}
		$sql="DELETE FROM cart WHERE userID = ". "'$customerID'" . ";";
		$conn->query($sql);
		$sql="UPDATE user SET gameCoins = gameCoins-".$subtotal." WHERE customerID = "."'$customerID'". ";";
		$conn->query($sql);	
	}	
}

if($result->num_rows >= 0){  

?>

<div class="col-md-10 main">
    <h1 class="page-header">Cart</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
		     <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
		    $subtotal = 0;
		    while($row = $result->fetch_assoc()) { 
		        $subtotal+=$row['price'];
		?>
                <tr>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['price']?></td>
			    <td><a href="Cart.php?customerID=<?php echo $customerID;?>&action=remove&id=<?php echo $row['serialNumber']?>">Remove</a></td>
                </tr> 
                <?php } }
                else{
                    echo "Nothing to display";
                }?>
		<tr>
		    <td>
			Subtotal:<?php echo " ".$subtotal ?>
		    </td>
		    <td colspan="2">
			<form method="post" action="Cart.php?customerID=<?php echo $customerID;?>">
		    		<input type="hidden" name="subtotal" value="<?php echo $subtotal ?>">
				<input class="btn pull-right" type="submit" name="buy" value="Check Out">
			</form>
		    </td>
		</tr>
            </tbody>
        </table>
    </div>
</div>

<?php require "footer.php";?>
