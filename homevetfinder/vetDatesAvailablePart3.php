<html>
<head>
	<title>Home Vet Finder</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
    	<link rel="stylesheet" type="text/css" href="clientformstyle.css">
    	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<script>

function myFunction() {
  
     document.getElementById("a1").style.backgroundColor = "black";
}
</script>
</head>
<body>

<div class="header">
<p><img src="images/homevetfinder.png" alt="Picture of a dog and cat" /></p>
<h1>Vets Available</h1>
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
session_start();
require_once 'login.php';
require_once 'vet_sessioncontrol.php';

$conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

if(!(isset($_SESSION['username'])))
{
header("Location:index.html");
exit();
}
  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    
    //echo "Welcome back '$username'";
          
  }
  else echo "Please <a href=clientlogin_form.html>click here</a> to log in.";
  
$TimeID=$_POST['TimeID'];
$newDate=$_POST['newDate'];
$newDay=$_POST['newDay'];
$TimeShift=$_POST['TimeShift'];
$VetName=$_POST['VetName'];







$sql="insert into DatesAvailable(TimeID,DayShift,TimeShift,AptDate) values('$TimeID','$newDay','$TimeShift','$newDate')";
if ($conn->query($sql) === TRUE)
 {
 echo "Work Spot Schedule has been updated Dr.'$VetName'<br>";
  
 }
 else
 {
 echo "Error updating record: " . $conn->error;
 }


  
  
  
  
  
  
  
  
  $conn->close();
?>
 
<form action="vetmenu.php">
    <input type="submit" value="Return to menu" />
</form>
<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>