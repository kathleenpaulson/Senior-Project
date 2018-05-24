<html>
<head>
	<title>Home Vet Finder</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
    	<link rel="stylesheet" type="text/css" href="clientloginstyle.css">
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
require_once 'vet_sessioncontrol.php';
session_start();
if(!(isset($_SESSION['username'])))
{
header("Location:index.html");
exit();
}

$conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

$AppointmentID=$_POST['AppointmentID'];
$VetID=$_POST['VetID'];
$UserID=$_POST['UserID'];
$Amount=$_POST['Amount'];
$vetName=$_POST['VetName'];
$UserName=$_POST['UserName'];
$confirm=$_POST['Confirm'];
$CareID=$_POST['CareID'];
$InvoiceID=$_POST['InvoiceID'];

echo "VetID: ".$VetID."<br>";
echo "AppointmentID: ".$AppointmentID."<br>";
echo "vetName: ".$vetName."<br>";
echo "Confirm Value: ".$confirm."<br>";
echo "Amount: ".$Amount."<br>";
echo "UserID: ".$UserID."<br>";
echo "CareID: ".$CareID."<br>";
echo "InvoiceID: ".$InvoiceID."<br>";
echo "UserName: ".$UserName."<br>";


if($confirm==1)
{
$query="insert into Invoices(InvoiceID,VetID,UserID,AppointmentID,Amount,CareID,Paid) values('$InvoiceID','$VetID','$UserID','$AppointmentID','$Amount','$CareID','No')";

if ($conn->query($query) === TRUE)
 {
 echo "Invoice: '$InvoiceID' has been sent to '$UserName' Dr.'$vetName'<br>";
 
 }
 else
 {
 echo "Error updating record: " . $conn->error;
	

 }

}
elseif($confirm==0)
{
 echo "Submission Cancled<br>";
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