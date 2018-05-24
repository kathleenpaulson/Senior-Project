<!DOCTYPE html>

<head>

	<title>Home Vet Finder</title>
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
<h1></h1>
</div>

<div class="navbar" style="clear:both">
  <a href="index.html">Home</a>  
  <a href="logout.php">Logout</a>
  <a href="vetmenu.php">Main Menu</a>

 
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
  
  //Check if user is correctly logged in
  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    
    //echo "Welcome back '$username'";
          
  }
  else echo "Please <a href=clientlogin_form.html>click here</a> to log in.";
$TimeID=$_POST['TimeID'];
$VetID=$_POST['VetID'];
$Hours=$_POST['Hours'];
$TimeShift=$_POST['TimeShift'];
$DayShift=$_POST['DayShift'];
$AptDate=$_POST['AptDate'];
$VetName=$_POST['VetName'];

echo "<br>";

echo "Please confirm deletion of the following data:<br>";
echo "<br>";
echo "Veterinarian: $VetName<br>";

echo "Hours: $Hours<br>";
echo "Day: $DayShift<br>";
echo "Time Slot: $TimeShift<br>";
echo "Date: $AptDate<br>";



?>
 
<form name="form" method="POST" action="vetScheduleDeletePart2.php">
<input value="1" type="hidden" name="Confirm">
 <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
<input value="<?php echo $VetName;?>" type="hidden" name="VetName">
          <input value="<?php echo $TimeID;?>" type="hidden" name="TimeID">
          <input value="<?php echo $Hours;?>" type="hidden" name="Hours">
          <input value="<?php echo $TimeShift;?>" type="hidden" name="TimeShift">
          <input value="<?php echo $DayShift;?>" type="hidden" name="DayShift">
           <input value="<?php echo $AptDate;?>" type="hidden" name="AptDate">
<input type="submit"  value="Confirm Deletion">

  	   </form>
                <form name="form2" method="POST" action="vetScheduleDeletePart2.php">
  	   <input value="0" type="hidden" name="Confirm">

  	   <input type="submit"  value="Cancel Deletion">

  	   </form>

<div style="margin-bottom:100px;"></div>

<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>