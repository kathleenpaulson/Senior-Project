<html>
<head>
	<title>Home Vet Finder</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
    	<link rel="stylesheet" type="text/css" href="clientformstyle.css">
    	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
<h1>Add Work Spots</h1>
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
session_start();
require_once 'login.php';
require_once 'vet_sessioncontrol.php';

$conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

if(!(isset($_SESSION['username'])))
{
header("Location:index.html");
exit();
}
  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    
    //echo "Welcome back '$username'";
          
  }
  else echo "Please <a href=clientlogin_form.html>click here</a> to log in.";
  

date_default_timezone_set('America/New_York');
 
   $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);
 $queryID="Select VetID,vetFirstName,vetLastName FROM Vet WHERE VetUserName='$username'";
$resultID=mysqli_query($conn,$queryID);
  
  $rowID = mysqli_fetch_array($resultID);
  $VetID=$rowID['VetID'];
  $VetName=$rowID['vetFirstName'].' '.$rowID['vetLastName'];
  
  
  $query2="Select TimeID,DayShift,TimeShift,AptDate FROM DatesAvailable";
  $result2=mysqli_query($conn,$query2);
  $rowCheck2 = $result2->num_rows;
//echo $rowCheck2;
echo "Work shifts - Dr. ".$VetName."<br>";

  if($rowCheck2 >0)
  {
  
  	 echo "<table id='tbl' border ='1'>";
                echo "<tr>";
            	//echo "<th>TimeID</th>";
            	
                echo "<th>Day Available</th>";
                echo "<th>Times Available</th>";
                echo "<th>Date</th>";
                
                     
                echo "</tr>";
         
        for($i=0;$i<$rowCheck2;$i++)
  	{
  		
  		$row = mysqli_fetch_array($result2);
  		/*
  		$TimeID=;
  		$DayShift=;
  		$TimeShift=;
  		$AptDate=;
  		*/
                echo "<tr>";
               // echo "<td>".$row['TimeID']."</td>";
                echo "<td>".$row['DayShift']."</td>";
                echo "<td>".$row['TimeShift']."</td>";
                echo "<td>".$row['AptDate']."</td>";
                echo "</tr>";
        
        }
        



        
        
   
   echo "</table>";
   
  }
  else
  {
  echo "No times found<br>";
  }
  ?>

<form method="POST" action="vetDatesAvailablePart2.php">


<?php
  echo "Please enter the information for the work spot you wish to add (DO NOT add a duplicate of any of the spots as listed above)<br>";
  echo "Day: <br>";
  ?>
   <td><select name=day size=1>
        <option value=->-</option>
        <option value=Monday>Mon</option>
        <option value=Tuesday>Tues</option>
        <option value=Wednesday>Wed</option>
        <option value=Thursday>Thurs</option>
        <option value=Friday>Fri</option>
        <option value=Saturday>Sat</option>
        <option value=Sunday>Sun</option>

         </select></td><br>
  
  
  <?php
  echo "Time - enter R for Regular(9am-5pm), L for Late Nights(5pm-Midnight) and M for Early Mornings(Midnight-7am) <br>";
  
  ?>
 
  Time (R,L,OR M) :<input type = "text" name = "timepick"><br>
  <?php
echo "Date (must be after ".date("Y-m-d").")<br>";
?>
Year(YYYY)- :<input type = "text" name = "Year" value=2018>
Month(MM)- :<input type = "text" name = "Month" value=04>
-Day(DD) :<input type = "text" name = "Day" value=01><br>
<input value="<?php echo $VetName;?>" type="hidden" name="VetName">
<input value="<?php echo $VetID;?>" type="hidden" name="VetID">


<input type = "submit" value="Check Selection">
</form>

<?php




$result2->close();
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