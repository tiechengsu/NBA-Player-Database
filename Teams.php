<?php require "header.php" ?>

<?php
// Query:
$sql = "SELECT * FROM nbaTeams;";
$result = $conn->query($sql);
if($result->num_rows > 0){

?>

<div class="col-md-10 main">
<h1 class="page-header">Teams</h1>
	<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Team</th>
				<th>City</th>
				<th>Division</th>
			</tr>
		</thead>

		<tbody>
			<?php while($row = $result->fetch_assoc() ) { ?>
				<tr>
					<td><?php echo $row['name'] ?></td>
					<td><?php echo $row['city'] ?></td>
	 				<td><?php echo $row['division'] ?></td>
	 			</tr>
	 		<?php } } 
	 		else {
				echo "Nothing to display";
				}?>
		</tbody>
	</table>
	</div>
</div>

<?php require "footer.php"; ?>
