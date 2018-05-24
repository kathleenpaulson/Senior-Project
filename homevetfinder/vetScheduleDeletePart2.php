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
  <a href="ViewRating.php">View Vet Ratings</a>
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
  
$conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

$TimeID=$_POST['TimeID'];
$VetID=$_POST['VetID'];
$Hours=$_POST['Hours'];
$TimeShift=$_POST['TimeShift'];
$DayShift=$_POST['DayShift'];
$AptDate=$_POST['AptDate'];
$VetName=$_POST['VetName'];
$confirm=$_POST['Confirm'];


if($confirm==1)
{
$sql="DELETE FROM Availability WHERE VetID='$VetID' AND TimeID='$TimeID' AND Hours='$Hours' AND Occupied='No'";
if ($conn->query($sql) === TRUE)
        {
         echo "The selected appointment spot has been deleted from your schedule.  <br>";
	} 
	else 
	{
    	echo "Error updating record: " . $conn->error;
	}

}
else
{
echo "Deletion Cancelled.<br>";
}

$conn->close();
?>


<div style=“margin-bottom:100px;”></div>
<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>