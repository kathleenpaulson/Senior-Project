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
$InvoiceID=$_POST['InvoiceID'];
$UserID=$_POST['UserID'];
$VetID=$_POST['VetID'];
$UserName=$_POST['UserName'];
$VetName=$_POST['VetName'];
$Amount=$_POST['Amount'];
$AmountPaid=$_POST['AmountPaid'];
echo $InvoiceID."<br>"; 
  //Check if user is correctly logged in
  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    
    //echo "Welcome back '$username'";
          
  }
  else echo "Please <a href=clientlogin_form.html>click here</a> to log in.";
  
  $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);
 

 if(strpos($Amount,'$')!==false)
 {
// echo "DOLLAR SIGN!<br>";
  	if(strpos($Amount,'.00')!==false)
	 {
 	if (strpos($AmountPaid, '.00') !== false) 
 	{
    	$AmountPaid='$'.$AmountPaid;

 	}
 	else
 	{
  	$AmountPaid='$'.$AmountPaid.'.00';
 	}
 	 }
 }
 else
 {
// echo " NO DOLLAR SIGN!<br>";
   	if(strpos($Amount,'.00')!==false)
 	{
 		if(strpos($AmountPaid,'.00')===false)
 		{
 			$AmountPaid=$AmountPaid.'.00';
 			//echo $AmountPaid."<br>";
 		}
 	}
 }
 

/*
 

 
 
 */
 
 if($Amount==$AmountPaid)
 {
 echo "correct amount entered!<br>";
 
 $sql="UPDATE Invoices SET Paid='Pending' WHERE InvoiceID='$InvoiceID'";
 if ($conn->query($sql) === TRUE) 
     {
    echo "Your Invoice has been paid!";
     } 
     else 
     {
    echo "Error updating record: " . $conn->error;
     }
 
 }
 else
 {
 echo "Incorrect amount entered!<br>";
 }
 $conn->close();
  ?>
  
 
<form action="clientmenu.php">
    <input type="submit" value="Return to menu" />
</form>
<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>