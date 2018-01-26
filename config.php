<?php
/*
name: Muhammad Tayyab
id:1001256129
*/

define('User_Name','root');
define('db_password','tayyab12');
try{
	$dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=cheapb",User_Name,db_password);
}catch(PDOException $exc){
	echo "Error".$exc->getMessage();
}

?>