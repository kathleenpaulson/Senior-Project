<?php
//session_start();
require_once 'client_sessioncontrol.php';
?>


<!DOCTYPE html>

<head>

	<title>Client Main Menu</title>
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
<h1>Main Menu</h1>
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

<div>
<form action="vetsearch_loggedinform.php">
	<input type="submit" value="Make an Appointment" />
</form>
</div>
<br>
<form action="userAppointmentViewPart1.php" >
    <input type="submit" value="View/Delete Appointments" />
</form>
<br>
<form action="AddRating.php" >
    <input type="submit" value="Rate a Vet!" />
</form>
<br>
<form action="ViewPayInvoicePart1.php" >
    <input type="submit" value="View/Pay Invoice" />
</form>
<br>

<form action="addpet_form.php" >
    <input type="submit" value="Add a Pet" />
</form>
<br>



 <div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
 <div style="margin-bottom: 100px"></div>
</body>
</html>