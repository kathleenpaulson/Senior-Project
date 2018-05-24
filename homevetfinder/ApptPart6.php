<html>

<head>

	<title>Appointment</title>
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
<h1>Appointment</h1>
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
if(!(isset($_SESSION['username'])))
{
header("Location:index.html");
exit();
}
require_once 'login.php';
require_once 'client_sessioncontrol.php';
  $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

$Confirm=$_POST['Confirm'];
if($Confirm==1)
{
$VetID=$_POST['VetID'];
$TimeID=$_POST['TimeID'];
$UserID=$_POST['UserID'];
$PetID=$_POST['PetID'];
$Pet_type=$_POST['Pet_type'];
$CareID=$_POST['CareID'];
$AppointmentID=$_POST['AppointmentID'];
$vetName=$_POST['vetName'];
$Amount=$_POST['Amount'];
$DayShift=$_POST['Day'];
$AptDate=$_POST['AptDate'];
$Hours=$_POST['Hours'];
$Name=$_POST['OwnerName'];
$PetName=$_POST['PetName'];
}

//echo $Confirm;
//echo "VetID: ".$VetID."<br>";
//echo "PetID: ".$PetID."<br>";
//echo "UserID: ".$UserID."<br>";
//echo "TimeID: ".$TimeID."<br>";
//echo "Pet Type: ".$Pet_type."<br>";
//echo "CareID: ".$CareID."<br>";
//echo "AppointmentID: ".$AppointmentID."<br>";
//echo "vetName: ".$vetName."<br>";
//echo "Amount: ".$Amount."<br>";
//echo "Day Shift: ".$DayShift."<br>";
//echo "Date: ".$AptDate."<br>";
//echo "Time: ".$Hours."<br>";
//echo "Owner Name: ".$Name."<br>";
//echo "Pet Name: ".$PetName."<br>";

if($Confirm==1)
{
$query="insert into Appointment(AppointmentID,VetID,UserID,Date_visit,Time_Visit,CareID,Amount,PetID) values('$AppointmentID','$VetID','$UserID','$AptDate','$Hours','$CareID','$Amount','$PetID')";

if ($conn->query($query) === TRUE)
 {
    echo "Your appointment has been created ".$Name ." for your pet ". $PetName." with the following details:<br>";
    echo "AppointmentID: ".$AppointmentID."<br>";
    echo "VetID: ".$VetID." (Dr.".$vetName.")<br>";
    echo "UserID: ".$UserID." (".$Name.")<br>";
    echo "UserID: ".$PetID." (".$PetName.")<br>";
    echo "Amount: ".$Amount."<br>";
    echo "Time Details:<br><br>";
    
        $query2="UPDATE Availability SET Occupied='Yes' WHERE Availability.VetID='$VetID' AND Availability.TimeID='$TimeID'";
    if ($conn->query($query2) === TRUE)
        {
          echo "Time(Hours): ".$Hours."<br>";
          echo "Date(YYYY-MM-DD): ".$AptDate."<br>";

	} 
	else 
	{
    	echo "Error updating record: " . $conn->error;
	}

    
} 
else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
elseif($Confirm==0)
{
	echo "Appointment Creation Canceled!<br>";

}

//$result->close();
//$resultCount->close();
//  $resultName->close();
  $conn->close();


?>

<form action="clientmenu.php">
    <input type="submit" value="Return to menu" />
</form>
<div class="footer"> 

<div> <h3>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h3> </div>
 </div>
</body>
</html>