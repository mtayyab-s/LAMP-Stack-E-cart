
<?php
/*
name: Muhammad Tayyab
id:1001256129
*/

include('config.php');
if(isset($_POST['submit'])){
	  $username = $_POST['username'];
	  $password = $_POST['password'];
	  $password = md5($password);
	  $address = $_POST['address'];
	  $phone = $_POST['phone'];
	  $email = $_POST['email'];
	  
	  
foreach($_POST as $key=>$value) {
if(empty($_POST[$key])) {
$message = $key . " field is required";
break;
}
}

if($_POST['password'] != $_POST['confirm_password']){ 
$message = 'Passwords should be same<br>'; 
}

if(!isset($message)) {
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
$message = "Invalid email address";
	  
}
}
  $data = $dbh->prepare('INSERT INTO customers(username,password,address,phone,email) VALUES(:username,:password,:address,:phone,:email)');
  $data->bindParam(':username',$username);
  $data->bindParam(':password',$password);
  $data->bindParam(':address',$address);
  $data->bindParam(':phone',$phone);
  $data->bindParam(':email',$email);
  
  $data->execute();
}
?>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>
<div class ="container">

<div class = "login">
<h1> Register</h1>
<?php
if(isset($message))
	echo $message;

?>
<form action="" method="POST">
<p><label>username: <input type= "text" name="username" class="box"></label></p>
<p><label>password: <input type= "password" name = "password" class="box"></label></p>
<p><label>Confirm password: <input type= "password" name = "confirm_password" class="box"></label></p>
<p><label>address: <input type= "text" name = "address" class="box"></label></p>
<p><label>phone: <input type= "text" name = "phone" class="box"></label></p>
<p><label>email: <input type= "text" name = "email" class="box"></label></p>
<p class="submit"><input type = "submit" name="submit" value="submit" class="submit">
<a href="index.php">login</a></p>
</form>
</div>
</div>

</body>
</html>
