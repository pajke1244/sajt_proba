<?php 
require("top_inc.php");


if (isset($_GET['type']) && $_GET['type'] != '') {
	$type=escape_string($_GET['type']);
	if ($type==='status') {
		$operation=escape_string($_GET['operation']);
		$id=escape_string($_GET['id']);
		if ($operation=='active') {
			$status='1';
		}else{
			$status='0';
		}
		$sql=query("UPDATE product set status = '$status' where id='$id'");
	}

	if ($type==='delete') {
		$id=escape_string($_GET['id']);
		$delete_qury=query("delete from product where id='$id'");
	}
	if ($type==='update') {
		$id=escape_string($_GET['id']);
		$update_query=query("update  product set categories='$id'");
	}
}

$sql=query("SELECT product.*,categories.categories from product,categories where product.categories_id=categories.id order by id DESC");
?>
<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Product </h4>
						<h4 class="box-link"><a href="manage_product.php">Add Product </h4></a> 
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table">
								<thead>
									<tr>
										<th class="serial">#</th>
										<th>ID</th>
										<th>Categories</th>
										<th>Name</th>
										<th>Mrp</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Image</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i=1;
									while ($row=mysqli_fetch_assoc($sql)) { ?>																
										<tr class=" pb-0">
											<td class="serial"><?php echo $i ?></td>
											<td> <?php echo $row['id']; ?></td>
											<td> <?php echo $row['categories'];?></td>
											<td> <?php echo $row['name'];?></td>
											<td> <?php echo $row['mrp'];?></td>
											<td> <?php echo $row['price'];?></td>
											<td> <?php echo $row['qty'];?></td>
											<td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'];?>"></td>
											<td> <?php if ($row['status']==1) {
												echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Completed</a></span> &nbsp";
											}else{
												echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Pending</a></span> &nbsp";
											} 

											echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
											echo " &nbsp<span class='badge badge-edit'><a href='manage_product.php?id=".$row['id']."'>Edit</a></span>";

											?> 

										</td>											                            
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php require("footer_inc.php"); ?>