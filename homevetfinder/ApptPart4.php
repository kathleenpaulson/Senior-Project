<html>
<title>Appointment View Delete</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<link rel="stylesheet" type="text/css" href="clientloginstyle.css">     
	<link rel="stylesheet" type="text/css" href="tablestyle.css"> 
	<script>

	function myFunction() {
  
    		 document.getElementById("a1").style.backgroundColor = "black";
			}
	</script>


<body>
<div class="header">
<p><img src="images/homevetfinder.png" alt="Picture of a dog and cat" /></p>
<h1>Appointments</h1>
</div>

<div class="navbar" style="clear:both">
  <a href="index.html">Home</a>
  <a href="ViewRating.php">View Vet Ratings</a>
  <a href="logout.php">Logout</a>
  <a href="clientmenu.php">Main Menu</a>
  
</div>


<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}



// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
    var myDropdown = document.getElementById("myDropdown");
      if (myDropdown.classList.contains('show')) {
        myDropdown.classList.remove('show');
      }
  }
}



</script>

<?php

session_start();
if(!(isset($_SESSION['username'])))
{
header("Location:index.html");
exit();
}

require_once 'login.php';
require_once 'client_sessioncontrol.php';
  $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

$VetID=$_POST['VetID'];
$TimeID=$_POST['TimeID'];
$UserID=$_POST['UserID'];
$PetID=$_POST['PetID'];
$Pet_type=$_POST['Pet_type'];

//echo "VetID: ".$VetID."<br>";
//echo "PetID: ".$PetID."<br>";
//echo "UserID: ".$UserID."<br>";
//echo "TimeID: ".$TimeID."<br>";
//echo "Pet Type: ".$Pet_type."<br>";

$query="Select VetPetSpecial.CareID,VetPetSpecial.Amount,VetPetSpecial.Pet_type,VetPetSpecial.Speciality FROM VetPetSpecial where VetPetSpecial.VetID='$VetID' AND VetPetSpecial.Pet_type='$Pet_type'";
 $result = mysqli_query($conn,$query);
  $rows = $result->num_rows;
//echo $rows."<br>";


//Check VetPetSpecial
//get CareID,Amount,Pet_type,and Amount and put into a table with a confirm appointment button at end
//make new ID for Appointment
//run an sql query to insert data into appointment table
//To make a new ID
$queryCount="Select AppointmentID from Appointment";
$resultCount=mysqli_query($conn,$queryCount);
$rows2=$resultCount->num_rows;
//echo $rows2."<br>";
$newID=$rows2+1;
$check=$newID+1;
if($newID < 10)
{
$ID='A0'.$newID;
}
elseif($newID >= 10)
{
$ID='A'.$newID;
}

for($x=0;$x<$rows2;$x++)
{
	$rowI=mysqli_fetch_array($resultCount);
	$IDCheck=$rowI['AppointmentID'];
	if($ID==$IDCheck)
	{
	
		$ChangeID=$check+1;
		if($ChangeID < 10)
		{
		$ID='A0'.$ChangeID;
		}
		elseif($ChangeID >= 10)
		{
		$ID='A'.$ChangeID;

		}
		$check++;
	}
}
//echo $ID."<br>";
//End of making a new ID

//Start of Finding NAME
$queryName="Select vetFirstName,vetLastName FROM Vet where VetID='$VetID'";

  $resultName=mysqli_query($conn,$queryName);





  $rowNameC=$resultName->num_rows;
  $rowCount = $resultA->num_rows;
   
     while($rowN = $resultName->fetch_assoc()) 
     {
        $name=$rowN['vetFirstName'];
        $name=$name." ".$rowN['vetLastName'];
     }
//End of finding NAME
if($rows >0)
{
echo "<br>";
echo "Types of care needed:  <br><br>";
echo "<table id='tbl' border ='1'>";
            echo "<tr>";
            	//echo "<th>CareID</th>";
            	echo "<th>Speciality</th>"; 
                echo "<th>Price($)</th>";
                echo "<th>Pet Type</th>"; 
                 
                echo "<th>Select Care</th>";   
                echo "</tr>";
        for($i=0;$i<$rows;$i++)
        {   
        
        
 	$row = mysqli_fetch_array($result);
 	$CareID=$row['CareID'];
        $Amount=$row['Amount'];
 	
 	 	 echo "<tr>";
 	 //echo "<td>".$row['CareID']."</td>";
 	 echo "<td>".$row['Speciality']."</td>";
 	echo "<td>".$row['Amount']."</td>";
 	echo "<td>".$row['Pet_type']."</td>";
 	

 		

 	?>
 	<td><form name="form" method="POST" action="ApptPart5.php">
     <input value="<?php echo $TimeID;?>" type="hidden" name="TimeID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
     <input value="<?php echo $UserID;?>" type="hidden" name="UserID">
      <input value="<?php echo $PetID;?>" type="hidden" name="PetID">
       <input value="<?php echo $Pet_type;?>" type="hidden" name="Pet_type">
            <input value="<?php echo $CareID;?>" type="hidden" name="CareID">
            <input value="<?php echo $ID;?>" type="hidden" name="AppointmentID">
	<input value="<?php echo $name;?>" type="hidden" name="vetName">
	<input value="<?php echo $Amount;?>" type="hidden" name="Amount">
	<input type="submit"  value="Select Care">
  	   </form></td>
 	
 	<?php
 	
	echo "</tr>";
 	}
 	
 

 
 echo "</table>";
 mysqli_free_result($result2); 
 }
 else
 {
 echo "Vet does not treat the Pet type ".$Pet_type." you selected!<br>";
 }


$result->close();
$resultCount->close();
  $resultName->close();
  $conn->close();

?>
<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>