<?php 
  require_once 'login.php'; 
  require_once 'vet_sessioncontrol.php'; 
  
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error) die($connection->connect_error);  
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Vet Location Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<h1>Add a Location</h1>
</div>

<div class="navbar" style="clear:both">
  <a href="index.html">Home</a>
  <a href="vetmenu.php">Main Menu</a>
  <a href="logout.php">Logout</a>  
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


<p class="center">Please complete this form to add a location to your profile.</p>

<form class="w3-container" action="addvetlocation_process.php" method="post"><pre>

<label>Location</label>
<select name="LocationName" size="3" required>
<option value="Eastern Suffolk">Eastern Suffolk</option>
<option value="Western Suffolk">Western Suffolk</option>
<option value="Eastern Nassau">Eastern Nassau</option>
<option value="Western Nassau">Western Nassau</option>

</select>
      
<input type="submit" value="Submit"></input>     
  </pre></form>

<div style="margin-bottom:100px;"</div>

<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>    
  </body>
</html>
