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
<h1>Cancel Invoice</h1>
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
  
  //Check if user is correctly logged in
  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    
    //echo "Welcome back '$username'";
          
  }
  else echo "Please <a href=clientlogin_form.html>click here</a> to log in.";
  
  $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);
 
 $InvoiceID=$_POST['InvoiceID'];
$VetID=$_POST['VetID'];
$VetName=$_POST['VetName'];
$UserID=$_POST['UserID'];
$Amount=$_POST['Amount']; 
$CareID=$_POST['CareID'];
$confirm=$_POST['Confirm'];

if($confirm==1)
{
$sql="DELETE FROM Invoices WHERE VetID='$VetID' AND InvoiceID='$InvoiceID' AND UserID='$UserID' AND Amount='$Amount' AND CareID='$CareID'";
if ($conn->query($sql) === TRUE)
        {
         echo "Invoice canceled<br>";
	} 
	else 
	{
    	echo "Error updating record: " . $conn->error;
	}

}
else
{
echo "Stopped Cancelation<br>";
}

$conn->close();
?>


<form action="vetmenu.php">
    <input type="submit" value="Return to menu" />
</form>
</body>
</html>