<html>
<head>
	
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">     
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<link rel="stylesheet" type="text/css" href="petfinder.css">
	
	<script>

	function myFunction() {
  
    		 document.getElementById("a1").style.backgroundColor = "black";
			}
	</script>
</head>
<body>
<div class="header">
<p><img src="images/homevetfinder.png" alt="Picture of a dog and cat" /></p>
<h1></h1>
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
require_once 'login.php';
require_once 'client_sessioncontrol.php';
session_start();
if(!(isset($_SESSION['username'])))
{
header("Location:index.html");
exit();
}

$conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

$AppointmentID=$_POST['AppointmentID'];
$UserID=$_POST['UserID'];
$VetID=$_POST['VetID'];
$vetname=$_POST['VetName'];
$UserName=$_POST['UserName'];
$Hours=$_POST['Hours'];
$DateVisit=$_POST['DateVisit'];
echo "Vet: ".$vetname."<br>";
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
echo "Date: ".$DateVisit."<br>";
echo "Time: ".$Hours."<br>";

 

echo " Confirm Deletion?<br>";


$conn->close();
?>



<form name="form" method="POST" action="userAppointmentViewPart3.php">
     <input value="<?php echo $AppointmentID;?>" type="hidden" name="AppointmentID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
      <input value="<?php echo $UserID;?>" type="hidden" name="UserID">
     <input value="<?php echo $UserName;?>" type="hidden" name="UserName">
      <input value="<?php echo $TimeID;?>" type="hidden" name="TimeID">
      <input value="<?php echo $DateVisit;?>" type="hidden" name="DateVisit">
      <input value="<?php echo $vetname;?>" type="hidden" name="vetname">
      <input value="<?php echo $Hours;?>" type="hidden" name="Hours">


     <input value="1" type="hidden" name="Confirm">
	<input type="submit"  value="Confirm">
	</form>
	
	 <form name="form2" method="POST" action="AppointmentViewDeletePart3.php">
  	   <input value="0" type="hidden" name="Confirm">

  	   <input type="submit"  value="Cancel">

  	   </form>
 <form action="clientmenu.php">
    <input type="submit" value="Return to menu" />
</form>


 <div class="footer"> 





<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>