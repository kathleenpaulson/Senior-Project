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
$CareID=$_POST['CareID'];
$VetID=$_POST['VetID'];
$Amount=$_POST['Amount'];
$UserID=$_POST['UserID'];
$UserName=$_POST['UserName'];
$vetName=$_POST['VetName'];
$Hours=$_POST['Hours'];
$DateVisit=$_POST['DateVisit'];
echo "VetID: ".$VetID."<br>";
echo "UserID: ".$UserID."<br>";
echo "CareID: ".$CareID."<br>";
echo "AppointmentID: ".$AppointmentID."<br>";
echo "Amount: ".$Amount."<br>";


$queryCount="Select InvoiceID FROM Invoices";
$resultCount=mysqli_query($conn,$queryCount);
$rows2=$resultCount->num_rows;
//echo $rows2."<br>";
$newID=$rows2+1;
$check=$newID+1;
if($newID < 10)
{
$ID='INV0'.$newID;
}
elseif($newID >=10)
{
$ID='INV'.$newID;
}

for($x=0;$x<$rows2;$x++)
{
	$rowI=mysqli_fetch_array($resultCount);
	$IDCheck=$rowI['InvoiceID'];
	if($ID==$IDCheck)
	{
	
		$ChangeID=$check+1;
		if($ChangeID < 10)
		{
		$ID='INV0'.$ChangeID;
		}
		elseif($ChangeID >= 10)
		{
		$ID='INV'.$ChangeID;

		}
		$check++;
	}
}




 echo "InvoiceID is: ".$ID."<br>";

echo " Confirm Submission Of Invoice?<br>";

$resultCount->close();
$conn->close();
?>
<form name="form" method="POST" action="vetSendInvoicePart3.php">
     <input value="<?php echo $AppointmentID;?>" type="hidden" name="AppointmentID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
     <input value="<?php echo $UserID;?>" type="hidden" name="UserID">
     <input value="<?php echo $vetName;?>" type="hidden" name="VetName">
     <input value="<?php echo $Amount;?>" type="hidden" name="Amount">
      <input value="<?php echo $CareID;?>" type="hidden" name="CareID">
       <input value="<?php echo $ID;?>" type="hidden" name="InvoiceID">
       <input value="<?php echo $UserName;?>" type="hidden" name="UserName">


     <input value="1" type="hidden" name="Confirm">
	<input type="submit"  value="Confirm">
	</form>
	
	 <form name="form2" method="POST" action="vetSendInvoicePart3.php">
  	   <input value="0" type="hidden" name="Confirm">

  	   <input type="submit"  value="Cancel">

  	   </form>

<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>
