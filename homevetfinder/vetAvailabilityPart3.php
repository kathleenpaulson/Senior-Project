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
$conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

if(!(isset($_SESSION['username'])))
{
header("Location:index.html");
exit();
}


  if(isset($_POST['timeslot']))
 {
     $timeslot=$_POST['timeslot'];
 }

$VetID=$_POST['VetID'];
$DayShift=$_POST['DayShift'];
$TimeShift=$_POST['TimeShift'];
$AptDate=$_POST['AptDate'];
$VetName=$_POST['VetName'];
$TimeID=$_POST['TimeID'];
  
  //Check if user is correctly logged in
  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    
    //echo "Welcome back '$username'";
          
  }
  if($timeslot=='-')
  {
  echo "No time was selected!<br>";
  }
  else
  {
  	$query="insert into Availability(TimeID,VetID,Hours,Occupied) values('$TimeID','$VetID','$timeslot','No')";
  	if ($conn->query($query) === TRUE)
 	{
 	echo "You have successfully inserted a work shift, Dr. $VetName.  <br>";
 	echo "This is the shift that you have selected:<br>";
 	echo "$DayShift, $AptDate: $timeslot. <br>";
  
 	}
 	else
 	{
 	echo "Error updating record: " . $conn->error;
	

 	}

  
  }

?>
 


 <div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>