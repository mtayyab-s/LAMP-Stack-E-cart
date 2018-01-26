<?php
/*
name: Muhammad Tayyab
id:1001256129
*/

session_start();
error_reporting(E_ALL);
ini_set('display_errors','On');

include('config.php');
 if(isset($_POST['submit'])){
	  $username = $_POST['username'];      //getting username
	  $password = $_POST['password'];       //getting password
	  $password = md5($password);
	  
	  if($username == '' && $password == '')
		  $errMsg = "enter username and password";
	  
	  
	  elseif($username == '')
		  $errMsg="enter your username";
	  elseif($password == '')
		  $errMsg = "enter your password";
		  
  else {
  $data = $dbh->prepare('SELECT username FROM  customers WHERE username = :username AND password = :password');
  $data->bindParam(':username',$username);
  $data->bindParam(':password',$password);
  $data->execute();
  $results=$data->fetch(PDO::FETCH_ASSOC);//fetches row and stores in an rray indexed by column
 
 if($results > 0){
	  $_SESSION['items'] = array();
	  $_SESSION['items'][0]= array('username'=>$results['username'],'key'=>2,'count'=>0);
      $_SESSION['items'][1]=array('count'=>0);
	  header('location:welcome.php');
	 exit;
  }
  else
	  $errMsg = "wrong username or password";
 }
 }
 
?>
<html>
<head>
<title>Message Board</title>
<link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>

<div class ="container">

<div class = "login">
<h1> login </h1>
<?php
if(isset($errMsg))
	echo $errMsg;

?>
<form action="" method="POST">
<p><label>username: <input type= "text" name="username" class="box"></label></p>
<p><label>password: <input type= "password" name = "password" class="box"></label></p>
<p class = "register"><a href="register.php">Register</a></p>
<p class="submit"><input type = "submit" name="submit" value="submit" class="submit"></p>
</form>
</div>
</div>
</body>
</html>
