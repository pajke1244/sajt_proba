<?php 
session_start();
$connection=mysqli_connect("localhost","root","","ecom_you");

define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/sajt_proba/');
define('SITE_PATH','http://127.0.0.1/sajt_proba/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'/media/product/');

define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'/media/product/');

?>