<html>
<head>
	<title>Home Vet Finder</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
    	<link rel="stylesheet" type="text/css" href="clientloginstyle.css">
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
<h1>Vet Schedule</h1>
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
 $queryID="Select VetID,vetFirstName,vetLastName FROM Vet WHERE VetUserName='$username'";
$resultID=mysqli_query($conn,$queryID);
  
  $rowID = mysqli_fetch_array($resultID);
  $VetID=$rowID['VetID'];
  $VetName=$rowID['vetFirstName'].' '.$rowID['vetLastName'];
  //echo $VetID."<br>";
  //echo $VetName."<br>";
  
  $query1="Select DatesAvailable.DayShift,DatesAvailable.TimeShift,DatesAvailable.AptDate,Availability.Hours,Availability.Occupied,Availability.TimeID FROM Availability JOIN DatesAvailable ON Availability.TimeID=DatesAvailable.TimeID WHERE VetID='$VetID'";
  $result1=mysqli_query($conn,$query1);
  $rowCheck1 = $result1->num_rows;
 echo "Schedule for Dr. $VetName<br>";
 if($rowCheck1 >0)
 {
  echo "<table id='tbl' border ='2'>";
            echo "<tr>";
            		//echo "<th>TimeID</th>";
                echo "<th>Hours</th>";
                echo "<th>Day</th>";
                echo "<th>TimeShift</th>";
                echo "<th>Date</th>";
                echo "<th>Occupied?</th>";
                echo "<th>Delete Appointment Time?</th>";

                             
                echo "</tr>";

    for($i=0;$i<$rowCheck1;$i++)
    {
   
        $row = mysqli_fetch_array($result1);
        
        //$occupied=$row['Occupied'];
        
        $TimeID=$row['TimeID'];
        
        $Hours=$row['Hours'];
        
        $DayShift=$row['DayShift'];
        
        $TimeShift=$row['TimeShift'];
        $AptDate=$row['AptDate'];
        
        echo "<tr>";
        //echo "<td>".$TimeID."</td>";
 	echo "<td>".$Hours."</td>";
 	
 	echo "<td>".$DayShift."</td>";
 	echo "<td>".$TimeShift."</td>";
 	
        echo "<td>".$AptDate."</td>";
        echo "<td>".$row['Occupied']."</td>";
        
        if($row['Occupied']=='No')
        {
        
        ?>
          <td><form name="form" method="POST" action="vetScheduleDeletePart1.php">
          <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
          <input value="<?php echo $TimeID;?>" type="hidden" name="TimeID">
          <input value="<?php echo $Hours;?>" type="hidden" name="Hours">
          <input value="<?php echo $TimeShift;?>" type="hidden" name="TimeShift">
          <input value="<?php echo $DayShift;?>" type="hidden" name="DayShift">
           <input value="<?php echo $AptDate;?>" type="hidden" name="AptDate">
           <input value="<?php echo $VetName;?>" type="hidden" name="VetName">

           <input type="submit"  value="Delete appointment spot">
  	   </form></td>
	

        
       <?php
        }
        else
        {
        echo "<td>Cannot delete</td>";
        }


        echo "</tr>";
        
        
    }
    echo "</table>";
 }
 else
 {
 echo "You have no schedule";
 } 
  
   
   
   
   $result1->close();
$resultID->close();
  $conn->close();

?>
 


<div style="margin-bottom:100px;"></div>

<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>