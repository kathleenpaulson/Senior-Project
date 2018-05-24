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
$UserName=$_POST['UserName'];
$confirm=$_POST['Confirm'];
$TimeID=$_POST['TimeID'];
$vetname=$_POST['vetname'];
$Hours=$_POST['Hours'];
$DateVisit=$_POST['DateVisit'];

//echo "VetID: ".$VetID."<br>";
//echo "AppointmentID: ".$AppointmentID."<br>";
//echo "vetName: ".$vetName."<br>";
//echo "Confirm Value: ".$confirm."<br>";
//echo "TimeID: ".$TimeID."<br>";


if($confirm==1)
{
$query="Delete FROM Appointment WHERE AppointmentID='$AppointmentID'";

if ($conn->query($query) === TRUE)
 {
 echo "Appointment with $vetname on $DateVisit at $Hours has been deleted $UserName<br>";
  $query2="UPDATE Availability SET Occupied='No' WHERE Availability.VetID='$VetID' AND Availability.TimeID='$TimeID'";
    if ($conn->query($query2) === TRUE)
        {
         echo "Your Schedule has been modified<br>";
	} 
	else 
	{
    	echo "Error updating record: " . $conn->error;
	}

 }
 else
 {
 echo "Error updating record: " . $conn->error;
	

 }

}
elseif($confirm==0)
{
 echo "Deletion Cancled<br>";
}


?>







<form action="clientmenu.php">
    <input type="submit" value="Return to menu" />
</form>

 <div class="footer"> 

<div> <h3>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h3> </div>
 </div>
</body>
</html>