<html>
<head>
	
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<link rel="stylesheet" type="text/css" href="clientloginstyle.css">    
	<link rel="stylesheet" type="text/css" href="tablestyle.css">           
	
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
session_start();
$UserID=$_POST['UserID'];
$UserName=$_POST['UserName'];
$vetName=$_POST['VetName'];
$VetID=$_POST['VetID'];
$InvoiceID=$_POST['InvoiceID'];
  
  //Check if user is correctly logged in
  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    
    //echo "Welcome back '$username'";
          
  }
  else echo "Please <a href=clientlogin_form.html>click here</a> to log in.";
  
 //connect with database 
  $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

//Method to make and ID for Rating put in part2
/*
$queryCount="Select RatingID FROM Ratings";
$resultCount=mysqli_query($conn,$queryCount);
$rows2=$resultCount->num_rows;
//echo $rows2."<br>";
$newID=$rows2+1;
$check=$newID+1;
if($newID < 10)
{
$ID='R0'.$newID;
}
elseif($newID >10)
{
$ID='R'.$newID;
}

for($x=0;$x<$rows2;$x++)
{
	$rowI=mysqli_fetch_array($resultCount);
	$IDCheck=$rowI['InvoiceID'];
	if($ID==$IDCheck)
	{
	
		$ChangeID=$check+1;
		if($check < 10)
		{
		$ID='R0'.$ChangeID;
		}
		elseif($newID >10)
		{
		$ID='R'.$ChangeID;

		}
		$check++;
	}
}





*/




$conn->close();
?>

</body>
</html>