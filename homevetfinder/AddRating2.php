<!DOCTYPE html>

<head>

	<title>Add Vet Rating</title>
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
<h1>Add Vet Ratings</h1>
</div>

<div class="navbar" style="clear:both">
  <a href="index.html">Home</a>
  <a href="ViewRating.php">View Vet Ratings</a>
  <a href="logout.php">Logout</a>
  <a href="clientmenu.php">Main Menu</a>
  
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
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
$UserID=$_POST['UserID'];
$VetID=$_POST['VetID'];
$InvoiceID=$_POST['InvoiceID'];
$Rating=$_POST['Rating'] . "/5";
$RatingID=$_POST['RatingID'];
 
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  
$query = "INSERT INTO Ratings (RatingID, InvoiceID, UserID, VetID, Rating)
    VALUES ('$RatingID', '$InvoiceID', '$UserID', '$VetID', '$Rating')";
    if ($conn->query($query) === TRUE) 
      {
      	      echo "<script> alert('Rating Added') </script>";
      	      
              // header("Location: ViewRating.php");
      } 
    else 
      {
      	    echo "<script> alert('Rating Failed to add') </script>";
      	      
            //header("Location: AddRating.php");
      }   
$conn->close();
?>

<div class="footer"> 

<div> <h3>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h3> </div>
 </div>
</body>
</html>