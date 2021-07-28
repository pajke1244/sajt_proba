<?php require("top_inc.php"); ?>

<?php 
if (isset($_GET['id']) && $_GET['id']!='') {
	$id=escape_string($_GET['id']);
	$result=query("SELECT * FROM categories where id = '$id'");
	$check=mysqli_num_rows($result);
	if ($check>0) {
		$row=mysqli_fetch_assoc($result);
		$categories=$row['categories'];
	}else{
		redirect("categories.php");
		die();
	}


}

if (isset($_POST['submit'])) {
	$cat=escape_string($_POST['categories']);
	$result=query("SELECT * FROM categories where categories = '$cat'");
	$check=mysqli_num_rows($result);
	if ($check>0) {
		if (isset($_GET['id']) && $_GET['id']!='') {
			$getData=mysqli_fetch_assoc($result);
			if ($id==$getData['id']) {
				
			}else{
				$msg="Categories already exist";
			}
			
		}else{
			$msg="Categories already exist";
		}
	}
	if ($msg=='') {
		if (isset($_GET['id']) && $_GET['id']!='') {
			$sql=query("UPDATE  categories set categories='$cat' where id='$id' ");
		}else{
			$sql=query("INSERT INTO categories (categories,status) values ('$cat','1') ");
		}
		redirect("categories.php");
		die();
	}

}



?>
<div class="content pb-0">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<form action="" method="post">					
					<div class="card">
						<div class="card-header"><strong>Category</strong><small> Form</small></div>
						<div class="card-body card-block">
							<div class="form-group"><label for="categories" class=" form-control-label">Categories name</label><input type="text" name="categories" placeholder="Enter your categories name" class="form-control" required value="<?php if(isset($categories)){ echo $categories; } ?>"></div>
							<button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit">
								<span id="payment-button-amount">Submit</span>
							</button>
						</div>
					</div>
				</form>
				<div class="field_error">
					<?php if (isset($msg)) {
						echo $msg;
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require("footer_inc.php"); ?>