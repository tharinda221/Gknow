<html>
<body>
 
 
<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 
mysql_select_db("problemes", $con);

$in=$_POST[index];
$nm=$_POST[name];
$prob=$_POST[problem];
 
$sql="INSERT INTO problems (index,name,problem) VALUES ($in,'$nm','$prob')";
 
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";
 
mysql_close($con)
?>
</body>
</html>