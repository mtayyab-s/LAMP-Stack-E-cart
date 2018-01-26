<?php
/*
name: Muhammad Tayyab
id:1001256129
*/
session_start();
 $msg = "Welcome ".$_SESSION['items'][0]['username'];
 $results=null;
 function myFunct(){
	 global $results,$data;
	 include('config.php');
	 try{
	   $dbh->beginTransaction();
       $query = " INSERT INTO shippingorder(ISBN,number,username,warehouseCode) VALUES(:ISBN,:number,:username,:warehouse)";
	   $username = $_SESSION['items'][0]['username'];
	   $id = uniqid();
	   $data = $dbh->prepare($query);
	   foreach(array_slice($_SESSION['items'],3) as $keys=>$v){
            $data->execute(array(
            ':ISBN' =>$v['ISBN'],
		    ':number'=>$v['number'],
		    ':username'=>$username,
		    ':warehouse'=>$v['warehouseCode']
			));
		}
		$data2 = $dbh->prepare("INSERT INTO shoppingbasket(basketid,username) VALUES(:id,:username)");
	    $data2->bindParam(':id',$id);
	    $data2->bindParam(':username',$username);
	    $data2->execute();
	    $data3 = $dbh->prepare("INSERT INTO contains(ISBN,basketId,number) VALUES(:ISBN,:basketId,:number)");
	   foreach(array_slice($_SESSION['items'],3) as $keys=>$v) {
            $data3->execute(array(
          ':ISBN' =>$v['ISBN'],
		   ':basketId'=>$id,
		  ':number'=>$v['number']
		  ));
		}
		$sql2="UPDATE stocks SET number= :number WHERE ISBN= :ISBN " ;
	    $data4 = $dbh->prepare($sql2);
	    foreach(array_slice($_SESSION['items'],3) as $keys=>$v) {
            $data4->execute(array(
          ':ISBN' =>$v['ISBN'],
		  ':number'=>$v['stocks']-$v['number']
        ));
		}
	
	$dbh->commit();
  }
  catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
  
}
  if(isset($_GET['buy'])){
	 echo '<script type="text/javascript">'; 
     echo 'alert("order has been placed");'; 
     myFunct();
     echo 'window.location.href = "welcome.php";';
     echo '</script>';
  }
?>
<html>
<body>
<html>
<head>
<title>Cheapbook app</title>
<link rel="stylesheet" type="text/css" href="menubar.css">
<style>
table {
    width:100%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th {
    background-color: black;
    color: white;
}
</style>
</head>
<body+
<div>
<ul>
   <li>
  <?php
echo '<a href="">'.$msg.'</a>';
?>  
   </li>
   <li>
   
   <?php
if( isset($_SESSION['items'][1]['count']))
   echo '<a href="basket.php">cart('.$_SESSION['items'][1]['count'].')</a>';
else
	 echo '<a href="basket.php">cart</a>';
   ?>
   </li>
   <li><a href="logout.php">logout</a><li>
</ul>
</div><br><br>


<table id='t01'>
  <tr>
    <th>  Title  </th>
    <th>  ISBN   </th>
	<th>  quantity  </th>
    <th>  Price  </th>    
	<th>  warehouseCode  </th>
	
  </tr>

<?php
//for ($x = 1; $x <= $_SESSION['items'][1]['count']; $x++) {
	foreach(array_slice($_SESSION['items'],3) as $v){
echo "<tr><td>".$v['title']."</td><td>".$v['ISBN']."</td><td>".$v['number']."</td><td>".$v['price']."</td><td>".$v['warehouseCode']."</tr></tr>";
}
?>
</table><br>

<table id='t02'>
  <tr>
    <tr>  Total:  
	<?php
	$var=0;
	//for ($x = 1; $x <= $_SESSION['items'][1]['count']; $x++) 
    foreach(array_slice($_SESSION['items'],3) as $v)
	$var=$var+($v['price']*$v['number']);
	echo "$".$var;
	
	?>
 </tr>
  </tr>
</table>
<form action="" method ="GET">
<input type="submit" name="buy" value="buy"></input>
<a href= "welcome.php">back</a>

</form>
</body>
</html>