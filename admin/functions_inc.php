<?php 
ob_start();
function pr($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";

}

function prx($arr){

	echo "<pre>";
	print_r($arr);
	die();

}
function escape_string($string){
	global $connection;
	$string=trim($string);
	return mysqli_real_escape_string($connection,$string);
}

function query($sql){
	global $connection;
	return mysqli_query($connection,$sql);
}

function redirect($location){

	return header("Location: $location");

}

//funkcija za prikaz kategorija na stranici top.php
function get_categories_top(){
	$cat_result=query("SELECT * FROM categories where status=1");
	while ($row=mysqli_fetch_assoc($cat_result)) {
		$categories=$row['categories'];
	}
}
//funkcija za prikaz proizvoda na pocetnoj strani pomocu limit-a ogranicavamo broj brikazanih proizvoda
function get_product($limit='',$cat_id='',$product_id=''){
	global $connection;
	$sql="SELECT product.*,categories.categories from product,categories where product.status=1 ";
	if ($cat_id!='') {
		$sql.=" and product.categories_id = $cat_id";
	}
	if ($product_id!='') {
		$sql.=" and product.id = $product_id";
	}
	$sql.=" and product.categories_id = categories.id ";

	$sql.=" order by product.id desc";

	if ($limit!='') {
		$sql.=" limit $limit";
	}	
	$res=mysqli_query($connection,$sql);
	$data=array();
	while ($row=mysqli_fetch_assoc($res)) {
		$data[]=$row;
	}
	return $data;
}

?>