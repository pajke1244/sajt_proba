<?php require("top_inc.php"); ?>
<?php 
// $name='';
// $categories_id='';
// $mrp='';
// $price='';
// $qty='';
// $image='';
// $short_desc='';
// $description='';
// $meta_title='';
// $meta_desc='';
// $meta_keyword='';
// $status='';
$image_required='required'; 
?>
<?php 
if (isset($_GET['id']) && $_GET['id']!='') {
	$image_required='';
	$id=escape_string($_GET['id']);
	$result=query("SELECT * FROM product where id = '$id'");
	$check=mysqli_num_rows($result);
	if ($check>0) {	
		$row=mysqli_fetch_assoc($result);
		$name=$row['name'];
		$categories_id=$row['categories_id'];
		$mrp=$row['mrp'];
		$price=$row['price'];
		$qty=$row['qty'];
		$image=$row['image'];
		$short_desc=$row['short_desc'];
		$description=$row['description'];
		$meta_title=$row['meta_title'];
		$meta_desc=$row['meta_desc'];
		$meta_keyword=$row['meta_keyword'];

	}else{
		redirect("product.php");
		die();
	}


}

if (isset($_POST['submit'])) {
	$categories_id=escape_string($_POST['categories_id']);
	$name=escape_string($_POST['name']);
	$mrp=escape_string($_POST['mrp']);
	$price=escape_string($_POST['price']);
	$qty=escape_string($_POST['qty']);
	$image=escape_string($_POST['image']);
	$short_desc=escape_string($_POST['short_desc']);
	$description=escape_string($_POST['description']);
	$meta_title=escape_string($_POST['meta_title']);
	$meta_desc=escape_string($_POST['meta_desc']);
	$meta_keyword=escape_string($_POST['meta_keyword']);
	$result=query("SELECT * FROM product where name = '$name'");
	$check=mysqli_num_rows($result);
	if ($check>0) {
		if (isset($_GET['id']) && $_GET['id']!='') {
			$getData=mysqli_fetch_assoc($result);
			if ($id==$getData['id']) {
				
			}else{
				$msg="Product already exist";
			}
			
		}else{
			$msg="Product already exist";
		}
	}
	if ($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'  ) {
		$msg="Please select only png/jpg/jpeg image format" ;
	}


	if ($msg=='') {
		if (isset($_GET['id']) && $_GET['id']!='') {
			if ($_FILES['image']['name']!='') {
						//sa sliku
				$image=rand(111111111,99999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
				$update_sql=query("UPDATE product SET categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',image='$image',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword'  where id='$id' ");
			}else{
				$update_sql=query("UPDATE product SET categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword'  where id='$id' ");
			}
			query($update_sql);
			
		}else{


//sa sliku
			$image=rand(111111111,99999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$_FILES['image']['name']);

			$sql=query("INSERT INTO product (categories_id, name, mrp, price, qty, image, short_desc, description, meta_title, meta_desc, meta_keyword, status) values ('$categories_id','$name','$mrp','$price','$qty','$image','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword','1') ");
		}
		redirect("product.php");
		die();
	}

}



?>
<div class="content pb-0">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<form action="" method="post" enctype="multipart/form-data">					
					<div class="card">
						<div class="card-header"><strong>Product</strong><small> Form</small></div>
						<div class="card-body card-block">
							<div class="form-group">
								<label for="categories" class=" form-control-label">Categories name</label>
								<select class="form-control" name="categories_id">
									<option value="">Select categories</option>
									<?php 
									$res=mysqli_query($connection,"select id, categories from categories order by categories asc");
									while ($row=mysqli_fetch_assoc($res)) {
										if ($row['id']==$categories_id) {
											echo "<option selected value=".$row['id'].">".$row['categories'] ."</option>";
										}else{
											echo "<option value=".$row['id'].">".$row['categories'] ."</option>";
										}
										
									}	

									?>
								</select>
							</div>
							<div class="form-group">
								<label for="name" class=" form-control-label">Product name</label><input type="text" name="name" placeholder="Enter your product name" class="form-control" required value="<?php if(isset($name)){ echo $name; } ?>">
							</div>
							<div class="form-group">
								<label for="mrp" class=" form-control-label">MRP</label><input type="text" name="mrp" placeholder="Enter your mrp" class="form-control" required value="<?php if(isset($mrp)){ echo $mrp; } ?>">
							</div>
							<div class="form-group">							
								<label for="price" class=" form-control-label">Price </label><input type="text" name="price" placeholder="Enter your price " class="form-control" required value="<?php if(isset($price)){ echo $price; } ?>">
							</div>
							<div class="form-group">
								<label for="qty" class=" form-control-label">Quantity</label><input type="text" name="qty" placeholder="Enter  product quantity" class="form-control" required value="<?php if(isset($qty)){ echo $qty; } ?>">
							</div>
							<div class="form-group">
								<label for="image" class=" form-control-label">Product image</label><input type="file" name="image" placeholder="Enter your image " class="form-control"  value="<?php if(isset($image)){ echo $image; } ?>">
							</div>
							<div class="form-group">
								<label for="short_desc" class=" form-control-label">Product short description</label><input type="text" name="short_desc" placeholder="Enter  product short description " class="form-control" required value="<?php if(isset($short_desc)){ echo $short_desc; } ?>">
							</div>
							<div class="form-group">
								<label for="description" class=" form-control-label">Product description</label><input type="text" name="description" placeholder="Enter your product description" class="form-control" required value="<?php if(isset($description)){ echo $description; } ?>">
							</div>
							<div class="form-group">
								<label for="meta_title" class=" form-control-label">Product meta title</label><input type="text" name="meta_title" placeholder="Enter your meta_title" class="form-control" required value="<?php if(isset($meta_title)){ echo $meta_title; } ?>">
							</div>
							<div class="form-group">
								<label for="meta_desc" class=" form-control-label">Product meta description</label><input type="text" name="meta_desc" placeholder="Enter your  meta_desc" class="form-control" required value="<?php if(isset($meta_desc)){ echo $meta_desc; } ?>">
							</div>
							<div class="form-group">
								<label for="meta_keyword" class=" form-control-label">Product meta keyword</label><input type="text" name="meta_keyword" placeholder="Enter your product meta_keyword" class="form-control" required value="<?php if(isset($meta_keyword)){ echo $meta_keyword; } ?>">
							</div>
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