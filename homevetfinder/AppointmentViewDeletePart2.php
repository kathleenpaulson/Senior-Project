<html>
<title>Appointment View Delete</title>
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
<h1>Delete Appointment</h1>
</div>

<div class="navbar" style="clear:both">
  <a href="index.html">Home</a>
  <a href="ViewRating.php">View Vet Ratings</a>
  <a href="logout.php">Logout</a>
  <div class="dropdown">
    <button class="dropbtn" onclick="myFunction()">Log In/Sign Up
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" id="myDropdown">
      <a href="clientsignup.php">Client Sign Up</a>
      <a href="clientlogin_form.html">Client Sign In</a>
      <a href="vetsignup.php">Vet Sign Up</a>
      <a href="vetlogin_form.html">Vet Sign In</a>      
    </div>
    
    
    
  </div> 
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
require_once 'login.php';
require_once 'vet_sessioncontrol.php';
session_start();
if(!(isset($_SESSION['username'])))
{
header("Location:index.html");
exit();
}

$conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

$AppointmentID=$_POST['AppointmentID'];
$VetID=$_POST['VetID'];
$vetName=$_POST['VetName'];
$Hours=$_POST['Hours'];
$DateVisit=$_POST['DateVisit'];
//echo "VetID: ".$VetID."<br>";
//echo "AppointmentID: ".$AppointmentID."<br>";
//echo "vetName: ".$vetName."<br>";
//echo "hours: ".$Hours."<br>";
//echo "Date: ".$DateVisit."<br>";

$queryA="Select Availability.TimeID FROM Availability JOIN DatesAvailable ON Availability.TimeID=DatesAvailable.TimeID WHERE Availability.VetID='$VetID' AND Hours='$Hours' AND Occupied='Yes' AND DatesAvailable.AptDate='$DateVisit'";
$resultID=mysqli_query($conn,$queryA);

$rowCount = $resultID->num_rows;
//echo $rowCount."<br>";
$rowID = mysqli_fetch_array($resultID);
$TimeID=$rowID['TimeID'];
//echo "TimeID: ".$TimeID."<br>";

 

echo " Confirm Deletion of appointment?<br>";
echo "AppointmentID: $AppointmentID<br>";
echo "Date: $DateVisit<br>";
echo "Time: $Hours<br>";


$conn->close();
?>
<form name="form" method="POST" action="AppointmentViewDeletePart3.php">
     <input value="<?php echo $AppointmentID;?>" type="hidden" name="AppointmentID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
     <input value="<?php echo $vetName;?>" type="hidden" name="VetName">
      <input value="<?php echo $TimeID;?>" type="hidden" name="TimeID">

     <input value="1" type="hidden" name="Confirm">
	<input type="submit"  value="Confirm">
	</form>
	
	 <form name="form2" method="POST" action="AppointmentViewDeletePart3.php">
  	   <input value="0" type="hidden" name="Confirm">

  	   <input type="submit"  value="Cancel">

 </form>
 <div class="footer"> 

<div> <h3>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h3> </div>
 </div>
</body>
</html>
  

