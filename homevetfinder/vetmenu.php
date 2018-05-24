<!DOCTYPE html>

<head>

	<title>Vet Main Menu</title>
	<link rel="stylesheet" type="text/css" href="style.css">      
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="petfinder.css">
	
	<script>

	function myFunction() {
  
    		 document.getElementById("a1").style.backgroundColor = "black";
			}
	</script>
	
<style type = "text/css">



</style>
</head>


<body>

<div class="header">
<p><img src="images/homevetfinder.png" alt="Picture of a dog and cat" /></p>
<h1>Vet Menu</h1>
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

<form action="vetAvailabilityPart1.php" >
    <input type="submit" value="Add to Schedule" />
</form>
<br>
<form action="vetSchedule.php" >
    <input type="submit" value="View/Delete Schedule" />
</form>
<br>
<form action="vetDatesAvailablePart1.php" >
    <input type="submit" value="Add to Work Spots" />
</form>
<br>

<form action="AppointmentViewDeletePart1.php" >
    <input type="submit" value="View/Delete Appointments" />
</form>
<br>
<form action="vetSendInvoice.php" >
    <input type="submit" value="View/Send Invoices for Appointments" />
</form>
<br>
<form action="vetViewInvoice.php" >
    <input type="submit" value="View/Cancel Invoices" />
</form>
<br>

<form action="addvetinsurance_form.php" >
    <input type="submit" value="Add Insurance" />
</form>
<br>

<form action="addvetlocation_form.php" >
    <input type="submit" value="Add Location" />
</form>
<br>

<form action="addspeciality_form.php" >
    <input type="submit" value="Add Speciality" />
</form>
<br>




<?php
require_once 'vet_sessioncontrol.php';

/*
<div class="w3-bar w3-black">
<a href="vetsearch_loggedinform.php" class="w3-bar-item w3-button">Make an Appointment</a>
</div>
*/

?>
<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
 <div style="margin-bottom: 100px"></div>
 

</body>
</html>