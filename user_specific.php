
<html>
<head>
<title>Hi</title>
</head>
<body>
<div align="right"><a href="main_downtime_page.php"><input type="button" name="button" value="GoBack"/></a>
<div align="center"><h2><u>Queue of a list of users</u></h2>


<div align="center"><h3><b><u>The table below gives you the machine status and a host of other details too</u></b></h3>

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
$query = "SELECT DISTINCT author FROM finalproject3";
$result=pg_query($query); 
$i=0;
while($rows=pg_fetch_array($result))
{
$roll[$i]=$rows['author'];
$i++;
}
$total_elmt=count($roll);
?>
<form method="POST" action="">
<label for="Select User">Select User</label>
<select name="sel">
<option>Select</option></h3></b>
<br><br>
<?php 
for($j=0;$j<$total_elmt;$j++)
{
?><option><?php 
echo $roll[$j];
?></option><?php
}
?>
</select>

<input name="submit" type="submit" value="Search"/><br />

</form>
<br><br><br>
<table border="2" border="1" cellpadding="1" cellspacing="1" >
        <tr>
	
		<th>Machine Name</th>
          <th>Author</th>
          <th>Ping Check</th>
          <th>AutoFS Check</th>
          <th>Depot Check</th>
		  <th>Status Description</th>
		   <th>Comment History</th>
		 <th>Final Machine Status</th>
        </tr>
        <?php
		
		if(isset($_POST['submit']))
{
$value=$_POST['sel'];
}
else{
	
	$value=$_GET['username'];
}

$query2 = "SELECT * FROM finalproject3 WHERE author='$value' ";

$result2=pg_query($query2);




          while( $row = pg_fetch_assoc( $result2 ) ){
			  //echo .$row['user_name' will get 'machine_name'];
            echo "<tr>";
			// 
			 echo  "<td>".$row['machinename']."</td>";
             
			 echo  "<td>".$row['author']."</td>";
			 echo "<td>".$row['PingCheck']."</td>";
				echo  "<td>".$row['AutoFSCheck']."</td>";
			  echo  "<td>".$row['DepotCheck']."</td>";
			  //echo  "<td>".$row['status']."</td>";
			  echo  "<td>".$row['status_description']."</td>";
            echo  "<td>".$row['comments']."</td>";
			//echo  "<td>".$row['timestamp']."</td>";
			echo  "<td";
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
    </table>
		</body>
		</html>
			