<?php 

include "header.php"; 



// Query:

$sql = "SELECT * FROM user WHERE customerID=" . "'$customerID'" . ";";
//echo $sql;
$result = $conn->query($sql);
?>

<div class="col-md-10 main">
<h1 class="page-header">User</h1>
	<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>CustomerID</th> 
				<th>name</th>
				<th>Password</th>
				<th>GameCoins</th>
			</tr>
		</thead>
		</tbody>
<?php if($result->num_rows > 0){ 

			 while($row = $result->fetch_assoc() ) { ?>
				<tr>
					<td><?php echo $row['customerID'] ?></td>
					<td><?php echo $row['name'] ?></td>
	 				<td><?php echo $row['hashingPassword'] ?></td>
					<td><?php echo $row['gameCoins']?></td>	
	 			</tr>
	 		<?php } } 
	 		else {
				echo "Nothing to display";
				}?>
		</tbody>
	</table>
	</div>
</div>
<?php require "footer.php";?>
