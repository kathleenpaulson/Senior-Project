<!DOCTYPE html>

<head>

	<title>Home Vet Search Results</title>
	<link rel="stylesheet" type="text/css" href="style.css">      
</head>


<body>


<div class="w3-container w3-teal">
  <h1>Home Vet Finder</h1>
</div>


<div class="head"> 
<div class="logo"><h1>Home Vet Finder</h1> </div>

<div class="link"> <h2><a href="index.html">Home</a> &nbsp;&nbsp;<a href="vetbios.html">Vet Bios</a></h2></div>
</div>
<div class="link"> <h2><a href="index.html">Home</a> &nbsp;&nbsp;
</div>


<br>
<br>
<br><br>
<br><br>
<br>
<div><h2>My Home Vet Search Results</h2></div>
<br>
<br><br>
<br><br>

 


<?php
 require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
 echo "<div>";
if($_SERVER['REQUEST_METHOD'] == "POST")  
{
  $location = $_POST['location']; 
  
  if(!isset($location))
  {
   // echo("<p>You didn't select any locations!</p>\n");
  }
  else
  {
    $locationCount = count($location); 
    //echo("<p>You selected $locationCount locations: ");
    for($i=0; $i < $locationCount; $i++)
    {
     // echo($location[$i] . " ");
    }
    echo("</p>");
  }


  $petType = $_POST['petType']; 
  if(!isset($petType))
  {
  //  echo("<p>You didn't select any pet types!</p>\n");
  }
  else
  {
    $petCount = count($petType); 
  //  echo("<p>You selected $petCount pets: ");
    for($i=0; $i < $petCount; $i++)
    {
    //  echo($petType[$i] . " ");
    }
    echo("</p>");
  }
  
 
  
  $insurance = $_POST['insurance']; 
  if(!isset($insurance))
  {
  //  echo("<p>You didn't select any insurance!</p>\n");
  }
  else
  {
    $insuranceCount = count($insurance); 
    //echo("<p>You selected $insuranceCount insurance: ");
    for($i=0; $i < $insuranceCount; $i++)
    {
   //   echo($insurance[$i] . " ");
    }
    echo("</p>");
  }  
}
 //JOIN VetPetSpecial ON Vet.VetID = VetPetSpecial.VetID)
 //JOIN VetInsurance on Vet.VetID = VetInsurance.VetID join Insurance on VetInsurance.Insurance_ID = Insurance.Insurance_ID)
echo "</div>";

$select = "Select Distinct Vet.vetFirstName,Vet.vetLastName, Vet.VetID, Vet.VetUserName, Vet.Email,Vet.VetStreet, Vet.City, Vet.State, Vet.vetZipCode, Vet.Vet_Bio, Vet.Phone_Number, LocationName ";
$from = "From Vet ";
if (isset($location))
{
	$from = $from . "join vetlocation on Vet.VetID = vetlocation.VetID ";
}
if (isset($petType))
{
	$from = $from . "join VetPetSpecial on Vet.VetID = VetPetSpecial.VetID ";
}
if (isset($insurance))
{
	$from = $from . "join VetInsurance on Vet.VetID = VetInsurance.VetID join Insurance on VetInsurance.Insurance_ID = Insurance.Insurance_ID ";
}

$groupbyneeded = false;
$groupby = "group by Vet.vetFirstName,Vet.vetLastName, Vet.VetID, Vet.VetUserName, Vet.Email,Vet.VetStreet, Vet.City, Vet.State, Vet.vetZipCode, Vet.Vet_Bio, Vet.Phone_Number ";
$having = "having "; 
$where = "Where 1 = 1 ";
if (isset($location))
{
		$where = $where . "and vetlocation.LocationName in (";
	for ($i = 0; $i < $locationCount; $i++)
	{
		$where = $where . "'" . $location[$i] . "'";
		if ($i <> $locationCount - 1)
		{
			$where = $where . ", ";
		}
	}
	$where = $where . ") ";
	if ($groupbyneeded == false)
	{
		$groupbyneeded = true;
		$having = $having . "Count(Distinct vetlocation.LocationName) >= " . $locationCount . " ";
	}
	else
	{
		$having = $having . "Count(Distinct vetlocation.LocationName) >= " . $locationCount . " ";
	}
}
if (isset($petType))
{
		$where = $where . "and VetPetSpecial.Pet_type in (";
	for ($i = 0; $i < $petCount; $i++)
	{
		$where = $where . "'" . $petType[$i] . "'";
		if ($i <> $petCount - 1)
		{
			$where = $where . ", ";
		}
	}
	$where = $where . ") ";
	if ($groupbyneeded == false)
	{
		$groupbyneeded = true;
		$having = $having . "Count(Distinct VetPetSpecial.Pet_type) >= " . $petCount . " ";
	}
	else
	{
		$having = $having . "and Count(Distinct VetPetSpecial.Pet_type) >= " . $petCount . " ";
	}
}
if (isset($insurance))
{
	$where = $where . "and Insurance.Insurance_Type in (";
	for ($i = 0; $i < $insuranceCount; $i++)
	{
		$where = $where . "'" . $insurance[$i] . "'";
		if ($i <> $insuranceCount - 1)
		{
			$where = $where . ", ";
		}
	}
	$where = $where . ") ";
	if ($groupbyneeded == false)
	{
		$groupbyneeded = true;
		$having = $having . "Count(Insurance.Insurance_Type) >= " . $insuranceCount . " ";
	}
	else
	{
		$having = $having . "and Count(Insurance.Insurance_Type) >= " . $insuranceCount . " ";
	}
}
$query = $select . $from . $where;
$select2 = "Select Vet.VetID ";
$subquery = $select2 . $from . $where;
if ($groupbyneeded == true)
{
	$subquery = $subquery . $groupby . $having;
	$query = $query . $groupby . $having . ";";
}
else
{
	$query = $query . ";";
}
$query2 = "Select LocationName, VetID from vetlocation where vetlocation.VetID in (" . $subquery . ");";
$query3 = "Select * from Ratings join Invoices on Ratings.InvoiceID = Invoices.InvoiceID join Appointment on Appointment.AppointmentID = Invoices.AppointmentID join Users on Users.UserID = Invoices.UserID join Pet on Users.UserID = Pet.UserID where Pet.PetID = Appointment.PetID;";
$result = $conn->query($query);
$result2 = $conn->query($query2);
$result3 = $conn->query($query3);
 if (!$result) die($conn->error);
 if (!$result2) die($conn->error);
 if (!$result3) die($conn->error);
  $rows = $result->num_rows;
  $rows2 = $result2->num_rows;
  $rows3 = $result3->num_rows;
 $r=mysqli_fetch_array($result);
 $r2=mysqli_fetch_array($result2);
 $r3=mysqli_fetch_array($result2);
   if ($rows == 0 && $rows2 == 0)
  {
  echo "<h2>No vets meet your search criteria.  Please try again.<br><br>";
  }
for ($j = 0 ; $j < $rows ; ++$j)
  {
     
	
    $result->data_seek($j);
	
    
	     ?>
    
 
 
	 
<div class="a1">
<?php  

 if($result->fetch_assoc()['VetUserName']=="newVetDoc1"){
 
?>
<img src="images/vetbio1.jpg"  style="width: 100%; height:100%;">

<?php }
$result->data_seek($j);?>
<?php  

 if($result->fetch_assoc()['VetUserName']=="newVetDoc2"){
 
?>
<img src="images/vetbio3.jpg"  style="width: 100%; height:100%;">

<?php }
$result->data_seek($j);?>
<?php  

 if($result->fetch_assoc()['VetUserName']=="newVetDoc3"){
 
?>
<img src="images/vetbio4.jpg"  style="width: 100%; height:100%;">

<?php }
$result->data_seek($j);?>
<?php  

 if($result->fetch_assoc()['VetUserName']=="newVetDoc4"){
 
?>
<img src="images/vetbio2.jpg"  style="width: 100%; height:100%;">

<?php }
$result->data_seek($j);?>
 </div>
<div class="a2" style="height:350px;"> 

<h2><?php echo "Name: " . $result->fetch_assoc()['vetFirstName'] . " ";
    $result->data_seek($j);
    echo $result->fetch_assoc()['vetLastName']   . '<br>';
    $result->data_seek($j);?></h2>
<br>
<p><?php echo "Vet ID: " . $result->fetch_assoc()['VetID']   . '<br>';
    $result->data_seek($j);?><br>
<?php echo "Address: " . $result->fetch_assoc()['VetStreet']   . '<br>';
    $result->data_seek($j);?><br>
<?php echo "Phone No: " . $result->fetch_assoc()['Phone_Number']   . '<br>';
    $result->data_seek($j);?><br>
<?php echo "Email: " . $result->fetch_assoc()['Email']   . '<br>';
    $result->data_seek($j);?><br>
<?php    
    $count = mysqli_num_rows($result);
    echo "Location-Name: ";
    while ($i = $result->fetch_assoc())
    {
    	$storeArray = Array();
    	if ($count == 1)
    	{
    		$result2->data_seek($j);
    	}
    	while ($myrow = $result2->fetch_array())
    	{
    		
    		if ($myrow['VetID'] == $i['VetID'])
    		{
    			
    			$storeArray[] = $myrow['LocationName'];
    		} 
    	}
    	echo implode($storeArray, ",");
    }
    echo '<br>';
    $result->data_seek($j);
    $result2->data_seek($j);
    $result3->data_seek($j);
    ?>
<?php 
    ?><br>
	<?php echo "Vet-Bio: " . $result->fetch_assoc()['Vet_Bio']   . '<br>';
    $result->data_seek($j);?>
    <h2>Ratings</h2>
  	<table>
   		<tr>
    			<th>UserFirst</th>
     			<th>UserLast</th>
  			<th>Rating</th>
  			<th>Pet</th>
  		</tr>
    <?php
   			while ($row3 = $result3->fetch_assoc()) {
   				$VetName = $row3['vetFirstName'] . " " . $row3['vetLastName'];
   				$VetID = $row3['VetID'];
				$FirstName = $row3['firstName'];
				$LastName = $row3['lastName'];
				$Rating = $row3['Rating'];
				$Pet = $row3['Pet_type'];
				echo "<tr data-status='$VetID'>";
				echo "<td>$FirstName</td>";
				echo "<td>$LastName</td>";
				echo "<td>$Rating</td>";
				echo "<td>$Pet</td>";
				echo "</tr>";
				}
		?>
		</table>
</div>

<?php
$VetID=$result->fetch_assoc()['VetID']; 
//echo "VetID to be stored: " .$VetID."<br>";
?>
 <form action="ApptTable.php" method="post">
  <input type="hidden" name="VetID" value=<?php echo "$VetID"; ?> >
   <input type="submit" value="Make Appointment"></form>
  
<?php
 }
$result->close();
  $conn->close();
?>

<br>
 <div class="footer"> 

<div class="copy"> <h3>Copyright &copy;2018 Home Vet Finder, Inc. - All Rights Reserved.</h3> </div>
 </div>

</body>
</html>