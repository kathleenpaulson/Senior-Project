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
if(!(isset($_SESSION['username'])))
{
header("Location:index.html");
exit();
}
$VetID=$_POST['VetID'];
$DayShift=$_POST['DayShift'];
$TimeShift=$_POST['TimeShift'];
$AptDate=$_POST['AptDate'];
$VetName=$_POST['VetName'];
$TimeID=$_POST['TimeID'];
$timeslots=array(0,0,0,0);

  
  //Check if user is correctly logged in
  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    
    //echo "Welcome back '$username'";
          
  }
  else echo "Please <a href=clientlogin_form.html>click here</a> to log in.";
  /*
  echo "VetID: ".$VetID."<br>";
  echo "TimeID: ".$TimeID."<br>";

    echo "DayShift: ".$DayShift."<br>";
    echo"TimeShift: ".$TimeShift."<br>";
     echo"AptDate: ".$AptDate."<br>";
      echo"VetName: ".$VetName."<br>";
      */
  
 	   	 		   	 	



	   	 	

  

 //connect with database 
  $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);
 
 $query1="select Availability.Hours FROM Availability Join DatesAvailable ON Availability.TimeID=DatesAvailable.TimeID WHERE VetID='$VetID' AND AptDate='$AptDate' AND DayShift='$DayShift' AND TimeShift='$TimeShift'";
 $result1=mysqli_query($conn,$query1);
  $rowCheck1 = $result1->num_rows;

echo "The shift you have selected is $DayShift, $AptDate.<br>";
echo "Please select one of the following times within that shift:<br>";


?>

<form name="form" method="POST" action="vetAvailabilityPart3.php">
         <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
         <input value="<?php echo $DayShift;?>" type="hidden" name="DayShift">
         <input value="<?php echo $TimeShift;?>" type="hidden" name="TimeShift">
         <input value="<?php echo $AptDate;?>" type="hidden" name="AptDate">
         <input value="<?php echo $VetName;?>" type="hidden" name="VetName">
         <input value="<?php echo $TimeID;?>" type="hidden" name="TimeID">




<?php
 
 if($TimeShift=='Regular(9am-5pm)')
 {
 ?>
 <td><select name=timeslot size=1>
        <option value=->-</option>
        <option value=9am-11am >9am-11am</option>
        <option value=11am-1pm>11am-1pm</option>
        <option value=1pm-3pm>1pm-3pm</option>
        <option value=3pm-5pm>3pm-5pm</option>
         </select></td>
         <?php
 }
 elseif($TimeShift=='Late Nights(5pm-Midnight)')
 {
 


 ?>
<td><select name=timeslot size=1>
        <option value=->-</option>
        <option value=5pm-7pm>5pm-7pm</option>
        <option value=7pm-9pm>7pm-9pm</option>
        <option value=9pm-11pm>9pm-11pm</option>
        <option value=11pm-Midnight>11pm-Midnight</option>
         </select></td>
<?php
 }
 elseif($TimeShift=='Early Mornings(Midnight-7am)')
 {
 
  ?>
 <td><select name=timeslot size=1>
        <option value=->-</option>
        <option value=1am-3am>1am-3am</option>
        <option value=3am-5am>3am-5am</option>
        <option value=5am-7am>5am-7am</option>
        <option value=7am-9am>7am-9am</option>
         </select></td>

 <?php
 }
 
$result1->close();
$conn->close();
?>
 
                    
     <input type="submit"  value="Submit Time">
  	   </form>






 <div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>