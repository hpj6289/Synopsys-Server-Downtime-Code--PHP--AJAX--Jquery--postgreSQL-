
	  <?php


   $host        = "host=gmsmaster-vm1";
   $port        = "port=5432";
   $dbname      = "dbname=gms";
   $credentials = "user=gmsadmin password=iltwas";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db){
      echo "Error : Unable to open database\n";
   } else {
      echo "";
   }


$query = 'SELECT * FROM "finalproject3"';
//$query2 = "SELECT * FROM secondone1";


$result=pg_query($query);
//$result1=mysql_query($query1) or die("Query Failed : ".mysql_error());
//$result1=mysql_query($query2) or die("Query Failed : ".mysql_error());

?>

<html>
<head>
<title>Hi</title>
</head>
<body>


<div align="center"><h2><b><u>The table below displays a comment history releavent to the user and machine</u></b></h2>
<div align="right"><input type="button" value="Logout" onclick="location.href='login2.php'" name="button"></div>
<table border="2" border="1" cellpadding="1" cellspacing="1" >
        <tr>

		<th>Machine Name</th>
		<th>Author</th>
		<th>Ping Check </th>
		<th> Auto FS Check </th>
		<th>Depot Check </th>

<th>Status Description</th>
		  
		  <th>Comment History</th>
		 
		  <th>Final Machine Status</th>
		  
		  
        
        </tr>
            <?php
          while( $row = pg_fetch_assoc( $result ) ){
            echo "<tr>";
             $machine=$row['machinename'];
			 //echo "<td>  echo fopen("uncommon2.txt")</td>";
			 $username=$row['author'];
			 //echo "<td>".$row['machinename']."</td>";
				//echo  "<td>".$row['user']."</td>";
			 echo  "<td><a href='machine.php?machine=$machine'>$machine</a></td>";
            echo  "<td><a href='user.php?username=$username'>$username</a></td>";
			//echo  "<td>".$row['time_stamp']."</td>";
              //echo  "<td>".$row['comments']."</td>";
			 // echo  "<td>".$row['status']."</td>";
              
			 echo "<td>".$row['PingCheck']."</td>";
				echo  "<td>".$row['AutoFSCheck']."</td>";
			  echo  "<td>".$row['DepotCheck']."</td>";
				
			 // echo  "<td>".$row['Author_of_Comment']."</td>";
			   echo  "<td>".$row['status_description']."</td>";
			   echo  "<td>".$row['comments']."</td>";
			   //echo  "<td>".$row['status2']."</td>";
			    echo  "<td";
			  //echo  "<td>".$row['PingCheck']."</td>";
			  //echo  "<td>".$row['AutoFS']."</td>";
			  //echo  "<td>".$row['DepotCheck']."</td>";
			  if ($row["PingCheck"]=='OK')
				   {
					
				   echo ' style="background-color: #7FFF00"';}
				   else if($row["PingCheck"]=='NOK'){
					   echo ' style="background-color:	#8B0000"';
				   }
				   //else if($row["PingCheck"]=='down'){
					 //  echo ' style="background-color:	#DC143C"';
				   //}
				   echo ">".$row['status2']."</td>";

            echo "</tr>";
          }
        ?>
    </table></div>
	<br><br>
<?php
$host        = "host=gmsmaster-vm1";
   $port        = "port=5432";
   $dbname      = "dbname=gms";
   $credentials = "user=gmsadmin password=iltwas";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db){
      echo "Error : Unable to open database\n";
   } else {
      echo "";
   }

if (isset($_GET['test'])) {
    echo $_GET['test'];
}else{
    echo "";// Fallback behaviour goes here
}
//$query4='SELECT DISTINCT user from "finalproject3"';
//$result4=pg_query($query4);

//$query = 'SELECT * FROM "finalproject3"';
//$result=pg_query($query);
//$i=0;
//while($rows=pg_fetch_array($result4))
//{
//$Title[$i]=$rows['user'];
//$i++;
//}
//$total_elmt=count($Title);
$query1 = 'SELECT DISTINCT machinename FROM "finalproject3"';
$result1=pg_query($query1);
$i=0;
while($rows=pg_fetch_array($result1))
{
$Title1[$i]=$rows['machinename'];
$i++;
}
$total_elmt1=count($Title1);

$query2 = 'SELECT DISTINCT author FROM "finalproject3"';
$result2=pg_query($query2);
$i=0;
while($rows = pg_fetch_array($result2))
{
$Title2[$i]=$rows['author'];
$i++;
}
$total_elmt2=count($Title2);


?>
<div align="center"><form method="POST" action="">
<h3><b><u>Select the machine:</u></b></h3> <select name="mch">
<option value="-1">Select</option>
<?php 
for($j=0;$j<$total_elmt1;$j++)
{
?><option><?php 
echo $Title1[$j];
?></option><?php
}
?>
</select><br/>


<h3><b><u>Select the Person to be assigned the machine:</u></b></h3> <select name="per">
<option value="-1">Select</option>
<?php 
for($j=0;$j<$total_elmt2;$j++)
{
?><option><?php 
echo $Title2[$j];
?></option><?php
}
?>
</select><br/>

<br><br><input name="submit" type="submit" value="Update"/></br>
</form>


<?php
if(isset($_POST['submit'])){

//$comments=$_POST['comment'];
$machine=$_POST['mch'];

$user=$_POST['per'];
//$user=$_POST['usr'];
//$status=$_POST['status'];

//$statusdesc=$_POST['statusdesc'];

		$query2="UPDATE finalproject3 SET author='$user' WHERE machinename='$machine'";
		$result3=pg_query($query2);
		echo "Details inserted successfully";
	}

?>




</body>
</html>