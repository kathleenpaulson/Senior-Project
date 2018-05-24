<html>
<title>Appointment</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<link rel="stylesheet" type="text/css" href="petfinder.css">     
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
$CareID=$_POST['CareID'];
$AppointmentID=$_POST['AppointmentID'];
$vetName=$_POST['vetName'];
$Amount=$_POST['Amount'];

//echo "VetID: ".$VetID."<br>";
//echo "PetID: ".$PetID."<br>";
//echo "UserID: ".$UserID."<br>";
//echo "TimeID: ".$TimeID."<br>";
//echo "Pet Type: ".$Pet_type."<br>";
//echo "CareID: ".$CareID."<br>";
echo "<br>";
//echo "vetName: ".$vetName."<br>";
//echo "Amount: ".$Amount."<br>";

$query="Select DatesAvailable.DayShift,DatesAvailable.AptDate,Availability.Hours From DatesAvailable JOIN Availability ON DatesAvailable.TimeID=Availability.TimeID where Availability.VetID='$VetID' AND Availability.TimeID='$TimeID'";
$queryName="Select Pet.PetName,Users.firstName,Users.lastName FROM Users JOIN Pet ON Users.UserID=Pet.UserID WHERE Users.UserID='$UserID' AND Pet.PetID='$PetID'";

 $result = mysqli_query($conn,$query);
  $rows = $result->num_rows;
  
  $result2 = mysqli_query($conn,$queryName);
  $rows2 = $result2->num_rows;

  
  if($rows >0)
  {
 	 for($i=0;$i<$rows;$i++)
 	 {
  		$row=mysqli_fetch_array($result);
  		$DayShift=$row['DayShift'];
  		$AptDate=$row['AptDate'];
  		$Hours=$row['Hours'];



  
  	}
  }
  else
  {
  	Echo "Error!<br>";
  }
  
    if($rows2 >0)
  {
 	 for($i=0;$i<$rows2;$i++)
 	 {
  		$row2=mysqli_fetch_array($result2);
  		$Name=$row2['firstName'];
  		$Name=$Name." ".$row2['lastName'];
  		$PetName=$row2['PetName'];
  		

  
  	}
  }
  else
  {
  	Echo "Error!<br>";
  }
  //echo "Day Shift: ".$DayShift."<br>";
  //echo "Date: ".$AptDate."<br>";
  //echo "Time: ".$Hours."<br>";
    //echo "Owner Name: ".$Name."<br>";
  //echo "Pet Name: ".$PetName."<br>";
  echo "Please confirm that you would like to schedule an appointment for ".$PetName." with Dr. ".$vetName." on ".$DayShift.", ".$AptDate. " from ".$Hours.":<br><br>";
 


  
  

$result->close();
$result2->close();
$conn->close();


?>
<form name="form" method="POST" action="ApptPart6.php">
     <input value="<?php echo $TimeID;?>" type="hidden" name="TimeID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
     <input value="<?php echo $UserID;?>" type="hidden" name="UserID">
      <input value="<?php echo $PetID;?>" type="hidden" name="PetID">
       <input value="<?php echo $Pet_type;?>" type="hidden" name="Pet_type">
            <input value="<?php echo $CareID;?>" type="hidden" name="CareID">
            <input value="<?php echo $AppointmentID;?>" type="hidden" name="AppointmentID">
	<input value="<?php echo $vetName;?>" type="hidden" name="vetName">
	<input value="<?php echo $Amount;?>" type="hidden" name="Amount">
	<input value="<?php echo $DayShift;?>" type="hidden" name="Day">
	<input value="<?php echo $AptDate;?>" type="hidden" name="AptDate">
	<input value="<?php echo $Hours;?>" type="hidden" name="Hours">
	<input value="<?php echo $Name;?>" type="hidden" name="OwnerName">
	<input value="<?php echo $PetName;?>" type="hidden" name="PetName">
	<input value="1" type="hidden" name="Confirm">

	<input type="submit"  value="Confirm Appointment">

  	   </form>
  	   
  	   <form name="form2" method="POST" action="ApptPart6.php">
  	   <input value="0" type="hidden" name="Confirm">

  	   <input type="submit"  value="Cancel">

  	   </form>

<div class="footer"> 

<div> <h3>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h3> </div>
 </div>
</body>
</html>
