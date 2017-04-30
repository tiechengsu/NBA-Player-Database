<?php

require "header.php";


$where = "";
if($_POST['filter']!==null && $_POST['operator']!==null && $_POST['value']!==null){
	if($_POST['filter']=="position") $filter = "position";
	else if($_POST['filter']=="height") $filter = "height";
	else if($_POST['filter']=="weight") $filter = "weight";
	else $filter = "team";
	
	if($_POST['operator']=='eq') $operator = "=";
	else if($_POST['operator']=='noteq') $operator = "!=";
	else if($_POST['operator']=='gt') $operator = ">";
	else if($_POST['operator']=='lt') $operator = "<";
	else if($_POST['operator']=='gteq') $operator = ">=";
	else  $operator = "<=";
	$value = $_POST['value'];
	$where = "WHERE " . $filter . " $operator " . "'$value'";
}
$orderby = "";
if(isset($_POST['sort']) && isset($_POST['order'])){
        if($_POST['sort']=="name") $sort = "name";
	else if($_POST['sort']=="position") $sort = "position";
        else if($_POST['sort']=="height") $sort = "height";
        else if($_POST['sort']=="weight") $sort = "weight";
        else $sort = "team";
	
	if($_POST['order'] == 'desc') $order = "DESC";
	else $order = "ASC";
	
	$orderby = "ORDER BY " . $sort . " $order"; 	
}

$sql = "SELECT * FROM playerCard " . $where . $orderby . ";" ;
 
$result = $conn->query($sql);

//add to cart
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	$sql = "SELECT * FROM serialLibrary WHERE ID= ". $id ." AND customerID IS NULL LIMIT 1;";
	$result_add = $conn->query($sql);
	if($result_add->num_rows >0 ){
		$row=$result_add->fetch_assoc();
		$sql = "INSERT INTO cart VALUES("."'$customerID'".",".$row['serialNumber'].");";
		$conn->query($sql);
	}else{
		echo "<script type='text/javascript'>alert('Out of storage');</script>";
	}

}

?>
<div class="col-md-10 main">
    <h1 class="page-header">Players</h1>
    <div class="panel-group" id="accordion">
        <!--filter-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Filter</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
            	<div class="panel-body">
			<form method="post" action="players.php?customerID=<?php echo $customerID; ?>">
				<?php require "form/players_filter.php"; ?>
			</form>
                </div>
            </div>
        </div>
        <!--order-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Order</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
			<form method="post" action="players.php?customerID=<?php echo $customerID; ?>">
				<?php require "form/players_order.php"; ?>
                	</form>	
		</div> 
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Team</th>
		    <th>Price</th>
		    <th>Action</th>
                </tr>
            </thead>
<?php if($result->num_rows > 0){
?>
            <tbody>
		<?php while($row=$result->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $row['name']?></td>
				<td><?php echo $row['position']?></td>
				<td><?php echo $row['height']?></td>	
				<td><?php echo $row['weight']?></td>	
				<td><?php echo $row['team']?></td>
				<td><?php echo $row['price']?></td>	
				<td><a href="players.php?customerID=<?php echo $customerID;?>&action=add&id=<?php echo $row['playerID']?>">Add to cart</a></td>
			</tr>
		<?php }}
		else{
			echo "Nothing to display";
			}?>
            </tbody>
        </table>
    </div>
</div>
<?php require "footer.php"; ?>
