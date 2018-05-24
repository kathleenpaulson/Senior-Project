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

$select = "Select Distinct Vet.Name, Vet.VetID, Vet.VetUserName, Vet.Email,Vet.VetStreet, Vet.City, Vet.State, Vet.vetZipCode, Vet.Vet_Bio, Vet.Phone_Number, LocationName ";
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
$groupby = "group by Vet.Name, Vet.VetID, Vet.VetUserName, Vet.Email,Vet.VetStreet, Vet.City, Vet.State, Vet.vetZipCode, Vet.Vet_Bio, Vet.Phone_Number ";
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
if ($groupbyneeded == true)
{
	$query = $query . $groupby . $having . ";";
}
else
{
	$query = $query . ";";
}
$result = $conn->query($query);

 if (!$result) die($conn->error);
  $rows = $result->num_rows;
  
 $r=mysqli_fetch_array($result);

   if ($rows == 0)
  {
  echo "<h2>No vets meet your search criteria.  Please try again.<br><br>";
  }
for ($j = 0 ; $j < $rows ; ++$j)
  {
     
	
    $result->data_seek($j);
	
    
	     ?>
    
 
 
	 
<div class="a1">
<?php  

 if($result->fetch_assoc()['VetUserName']=="vetdoc1"){
 
?>
<img src="images/vetbio1.jpg"  style="width: 100%; height:100%;">

<?php }
$result->data_seek($j);?>
<?php  

 if($result->fetch_assoc()['VetUserName']=="vetdoc2"){
 
?>
<img src="images/vetbio3.jpg"  style="width: 100%; height:100%;">

<?php }
$result->data_seek($j);?>
<?php  

 if($result->fetch_assoc()['VetUserName']=="vetdoc3"){
 
?>
<img src="images/vetbio4.jpg"  style="width: 100%; height:100%;">

<?php }
$result->data_seek($j);?>
<?php  

 if($result->fetch_assoc()['VetUserName']=="vetdoc4"){
 
?>
<img src="images/vetbio2.jpg"  style="width: 100%; height:100%;">

<?php }
$result->data_seek($j);?>
 </div>
<div class="a2" style="height:350px;"> 

<h2><?php echo "Name: " . $result->fetch_assoc()['Name']   . '<br>';
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
<?php echo "Location-Name: " . $result->fetch_assoc()['LocationName']   . '<br>';
    $result->data_seek($j);?><br>
	<?php echo "Vet-Bio: " . $result->fetch_assoc()['Vet_Bio']   . '<br>';
    $result->data_seek($j);?>
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