
<?php
/*
name: Muhammad Tayyab
id:1001256129
*/

 session_start();
 $msg = "Welcome ".$_SESSION['items'][0]['username'];
 $msgs =null;
 $results;
 $data=null;
 

 function getByAuthor(){
	 global $results,$data;
	 include('config.php');
	 $author = strtolower($_GET['author']);      //get author name
     
	 $data = $dbh->prepare('SELECT * FROM  author a RIGHT JOIN writtenby w ON a.ssn = w.ssn  
	                       WHERE a.name = :author');
	 $data->bindParam(':author',$author);
     $data->execute();
     while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
	 $results=$row;//fetches row and stores in an rray indexed by column
	 }
  }
 function getByTitle(){
	 global $results,$data;
	 include('config.php');
	 $title = strtolower($_GET['title']);
     $data = $dbh->prepare('SELECT * FROM  book b INNER JOIN stocks k ON b.ISBN = k.ISBN WHERE b.title=:title');
	 $data->bindParam(':title',$title);
     $data->execute();
     $results=$data->fetch(PDO::FETCH_ASSOC);//fetches row and stores in an rray indexed by column
    
 }
 
 if(isset($_GET['submit'])){
	 
   getByAuthor();
     if($results < 1){

 	
 $msgs = "none";
 }
 else {
	 
	
	
  $_SESSION['items'][2]=array('ISBN'=>$results['ISBN']);
   $msgs = 'ISBN: '.$results['ISBN']."\n";
   
 }
}
 
 elseif(isset($_GET['submit2'])){
	 
	 getByTitle();
 if($results < 1){
	 
 $msgs = "none";}
 else{
	 
	  if($results['number']<1)
		 $msgs="no stocks available";
 
	  else{
  $_SESSION['items'][2]=array('title'=>$results['title'],'ISBN'=>$results['ISBN'],'price'=>$results['price'],'number'=>1,'warehouseCode'=>$results['warehouseCode'],'stocks'=>$results['number']);
  $msgs = 'ISBN: '.$results['ISBN']."\n".'title: '.$results['title']."\n".'stock: '.$results['number'];
  }
 }
}
if(isset($_GET['cart']) && $_GET["texts"]!== "none" && $_GET["texts"]!== "" && $_GET["texts"]!== "no stocks available"){
       
	    if($_SESSION['items'][2]['stocks']<$_SESSION['items'][2]['number']){
            header('loation:welcome.php');
		}
		
		else{
		$_SESSION['items'][0]['key']++;
	   $set = false;
	   
	   foreach(array_slice($_SESSION['items'],3) as $keys=>$v)
	   {
		   if($v['ISBN']==$_SESSION['items'][2]['ISBN']){
			   
		   
		   $set=true;
		   $_SESSION['items'][$keys+3]['number']++;
		   break;
		   }
		   
	   }
	   
	   if($set==false){
	      array_push( $_SESSION['items'],$_SESSION['items'][2]);
	        
	   }
	  $_SESSION['items'][1]['count']++;
	 header('location:basket.php');
	 exit;
}
}

?>
<html>
<head>

<title>Cheapbook app</title>
<link rel="stylesheet" type="text/css" href="menubar.css">
 <script type="text/javascript">
function refresh(){
var e=document.getElementById("refreshed");
if(e.value=="no")e.value="yes";
else{e.value="no";location.reload();}
}
</script>
</head>
<body>
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

<div>
<form action="" type="GET">
<p><label>Author:  </label>
<input type="text" name="author"></input></p>
<p><label>title:  </label>
<input type="text" name="title"></input></p>
<p><input type="submit" name="submit" value="search by Author"></input>
<input type="submit" name="submit2" value="search By title"></input>


</p>

</form>
<form action="" method="GET">
<textarea rows="4" cols="100" name="texts">
<?php
echo $msgs;
?>
</textarea>
<p><input type="submit" name = "cart" value="add"  ></input></p>
</form>
</div>
 <input type="hidden" id="refreshed" value="no" onload="refresh(); ">  

</body>
</html>
