<html>
<title>Appointment View Delete</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<link rel="stylesheet" type="text/css" href="clientloginstyle.css">     
	<link rel="stylesheet" type="text/css" href="tablestyle.css">     
	<script>

	function myFunction() {
  
    		 document.getElementById("a1").style.backgroundColor = "black";
			}
	</script>


<body>
<div class="header">
<p><img src="images/homevetfinder.png" alt="Picture of a dog and cat" /></p>
<h1>Appointments</h1>
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
session_start();
if(!(isset($_SESSION['username'])))
{
header("Location:index.html");
exit();
}

  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    
    
          
  }
  else echo "Please <a href=clientlogin_form.html>click here</a> to log in.";

$VetID=$_POST['VetID'];
$TimeID=$_POST['TimeID'];


  $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);




$query="Select UserID FROM Users where UserName = '$username'";
	$result = mysqli_query($conn,$query);
	  
	$rowName = mysqli_fetch_array($result);
	$userID = $rowName['UserID'];
	//echo $userID;


$query2="Select PetID,PetName,Pet_type,DOB,UserID FROM Pet where Pet.UserID='$userID'";
$result2=mysqli_query($conn,$query2);
$rows2=$result2->num_rows;

//echo $rows2;

if($rows2 > 0)
{
echo "<br><br>";

 echo "<table id='tbl' border ='1'>";
            echo "<tr>";
            	//echo "<th>PetID</th>";
                echo "<th>Pet Name</th>";
                echo "<th>Pet Type</th>";
                echo "<th>Birth Date</th>";
                echo "<th>Select Pet</th>";             
                echo "</tr>";
 
        for($i=0;$i<$rows2;$i++)
        {   
        
 	$row = mysqli_fetch_array($result2);
 	
 	$PetID=$row['PetID'];
 	$Pet_type=$row['Pet_type'];
 	//$userID=$row['UserID'];
 	 echo "<tr>";
 	 //echo "<td>".$row['PetID']."</td>";

 	echo "<td>".$row['PetName']."</td>";
 	echo "<td>".$row['Pet_type']."</td>";
 	echo "<td>".$row['DOB']."</td>"; 	

 	?>
 	<td><form name="form" method="POST" action="ApptPart4.php">
     <input value="<?php echo $TimeID;?>" type="hidden" name="TimeID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
     <input value="<?php echo $userID;?>" type="hidden" name="UserID">
      <input value="<?php echo $PetID;?>" type="hidden" name="PetID">
       <input value="<?php echo $Pet_type;?>" type="hidden" name="Pet_type">
	<input type="submit"  value="Choose Pet">
  	   </form></td>
 	
 	<?php
 	
	echo "</tr>";

 	}
 	
 

 
 echo "</table>";
 mysqli_free_result($result2); 
 }
 else
 {
 echo "You have no pets!<br>";
 }
 


  $result->close();
  $result2->close();
  $conn->close();
  



?>
<div class="footer"> 

<div> <h3>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h3> </div>
 </div>
</body>
</html>