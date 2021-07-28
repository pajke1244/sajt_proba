<?php 
require("top_inc.php");


if (isset($_GET['type']) && $_GET['type'] != '') {
	$type=escape_string($_GET['type']);
	if ($type==='delete') {
		$id=escape_string($_GET['id']);
		$delete_sql=query("delete from users where id = '$id' ");

	}
}

$sql=query("SELECT * from users order by id desc");
?>
<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Users  </h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table">
								<thead>
									<tr>
										<th class="serial">#</th>
										<th class="avatar">ID</th>
										<th class="avatar">Name</th>
										<th class="avatar">Email</th>
										<th class="avatar">Mobile</th>
										<th class="avatar">ADDED</th>
										<th class="avatar"></th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i=1;
									while ($row=mysqli_fetch_assoc($sql)) { ?>																
										<tr class=" pb-0">
											<td class="serial"><?php echo $i ?></td>
											<td> <?php echo $row['id']; ?></td>
											<td> <?php echo $row['name']; ?> </td>
											<td> <?php echo $row['email']; ?> </td>
											<td> <?php echo $row['mobile']; ?> </td>
											<td> <?php echo $row['added_on']; ?> </td>
											<td><?php   
											echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";?> 
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