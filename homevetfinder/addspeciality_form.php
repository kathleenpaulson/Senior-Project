<?php 
  require_once 'login.php'; 
  require_once 'vet_sessioncontrol.php'; 
  
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error) die($connection->connect_error);  
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Vet Speciality Form</title>
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
<h1>Add Speciality</h1>
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


<p class="center">Please complete this form to add a speciality to your profile.</p>

<form class="w3-container" action="addspeciality_process.php" method="post"><pre>

<label>Pet Type</label>
<select name="Pet_type" size="3" required>
<option value="Dog">Dog</option>
<option value="Cat">Cat</option>
<option value="Reptile">Reptile</option>
<option value="Bird">Bird</option>
<option value="Rabbit">Rabbit</option>
<option value="Farm Animal">Farm Animal</option>
</select>

Amount  <input class="w3-input w3-border" type="text" pattern="^\d+\.\d{2}$" name="Amount" title = "USD Price Format (1.00)" required>

<label>Speciality</label>
<select name="Speciality" size="3" required>
<option value="Checkup">Check Up</option>
<option value="Neutering">Neutering</option>
<option value="Surgery">Surgery</option>
<option value="Bloodwork">Bloodwork</option>
<option value="Dentistry">Dentistry</option>
<option value="Emergency Visit">Emergency Visit</option>
</select>

<label>Length of Time</label>
<select name="Length_of_time" size="3" required>
<option value="15 minutes">15 minutes</option>
<option value="30 minutes">30 minutes</option>
<option value="45 minutes">45 minutes</option>
<option value="1 hour">1 hour</option>
<option value="2 hours">2 hours</option>
<option value="3 hours">3 hours</option>

</select>
      
<input type="submit" value="Submit"></input>     
  </pre></form>

<div style="margin-bottom:100px;"</div>

<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>    
  </body>
</html>
