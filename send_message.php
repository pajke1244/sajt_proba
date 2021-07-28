<?php require("admin/connection.inc.php"); 
 require("admin/functions_inc.php");
$name=escape_string($_POST['name']);
$email=escape_string($_POST['email']);
$mobile=escape_string($_POST['mobile']);
$comment=escape_string($_POST['message']);
$added_on=date('Y-m-d h:i:s');
$query=query("INSERT INTO contact_us (name, email, mobile, comment, added_on) VALUES ('$name','$email','$mobile','$comment','$added_on')");
echo "Thank you";

?>