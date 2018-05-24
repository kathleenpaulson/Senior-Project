<html>
<head>
<title>Appointments</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<link rel="stylesheet" type="text/css" href="clientloginstyle.css">     
	<link rel="stylesheet" type="text/css" href="tablestyle.css"> 
	<script>

	function myFunction() {
  
    		 document.getElementById("a1").style.backgroundColor = "black";
			}
	</script>
</head>
<body>
<div class="header">
<p><img src="images/homevetfinder.png" alt="Picture of a dog and cat" /></p>
<h1>Appointment Table</h1>
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
//$_SESSION["testUsername"] = "newPetOwner1";

$VetID=$_POST['VetID'];
//$petType=$_POST['PetType'];

require_once 'login.php';
require_once 'client_sessioncontrol.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  //need to modify table to have one more field,Appointment_Date
  $queryAvailability  ="Select DatesAvailable.DayShift,DatesAvailable.TimeShift,DatesAvailable.AptDate,Availability.Hours,Availability.Occupied,Availability.TimeID,Availability.VetID from DatesAvailable JOIN Availability on DatesAvailable.TimeID=Availability.TimeID where (Availability.VetID='$VetID')"; 
$queryName="Select vetFirstName,vetLastName FROM Vet where VetID='$VetID'";
  $resultA = mysqli_query($conn,$queryAvailability);
  $resultName=mysqli_query($conn,$queryName);



//echo $petType."<br>";

  $rowNameC=$resultName->num_rows;
  $rowCount = $resultA->num_rows;
   
     while($rowN = $resultName->fetch_assoc()) 
     {
        $name=$rowN['vetFirstName'];
        $name=$name." ".$rowN['vetLastName'];
     }
     echo "<br>";
echo "Schedule for: Dr. ".$name ."<br><br>";     
//echo $VetID;
 echo "<table id = 'tbl' border ='1'>";
            echo "<tr>";
            echo "<th>Date</th>";
		//echo "<th>TimeID</th>";
                echo "<th>Hours</th>";
                echo "<th>Day </th>";
                echo "<th>Time</th>";
                echo "<th>Occupied</th>";
                echo "<th>Make Appointment</th>";             
                echo "</tr>";
        for($i=0;$i<$rowCount;$i++)
        {   
        
 	$row = mysqli_fetch_array($resultA);
 	
 	$TimeID=$row['TimeID'];
 	 echo "<tr>";
 	 echo "<td>".$row['AptDate']."</td>";

 	 //echo "<td>".$row['TimeID']."</td>";

 	echo "<td>".$row['Hours']."</td>";
 	echo "<td>".$row['DayShift']."</td>";
 	echo "<td>".$row['TimeShift']."</td>";
 	echo "<td>".$row['Occupied']."</td>";
 	
 	if($row['Occupied']=='No')
 	{
 	?>
 	 	   <td><form name="form" method="POST" action="ApptPart3.php">
     <input value="<?php echo $TimeID;?>" type="hidden" name="TimeID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
     <input type="submit"  value="Make Appointment">
  	   </form></td>
 	
 	<?php
 	}
 	elseif($row['Occupied']=='Yes')
 	{
 	echo "<td>Occupied</td>";
 	}
	echo "</tr>";
 	}
 	
 

 
 echo "</table>";
 mysqli_free_result($resultA); 

  $resultA->close();
  $resultName->close();
  $conn->close();
  

//echo "VetID: " . $VetID ." loaded<br>";


?>


<?php
/*
 <div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
*/

?>
</html>


