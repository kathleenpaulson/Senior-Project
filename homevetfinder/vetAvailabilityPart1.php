<html>
<head>

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
<h1>Vet Work Shifts</h1>
</div>

<div class="navbar" style="clear:both">
  <a href="index.html">Home</a>
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
  
  $query1="Select TimeID FROM Availability WHERE VetID='$VetID'";
  $result1=mysqli_query($conn,$query1);
  $rowCheck1 = $result1->num_rows;
  //echo $rowCheck1."<br>";
  //$arrayAlpha=array();
  echo "<br>";
  echo "Work shifts for Dr. ".$VetName."<br><br>";
    for($x=0;$x<$rowCheck1;$x++)
    {
                 $row2=mysqli_fetch_array($result1);
                $arrayAlpha[$x]=$row2['TimeID'];
                //echo $arrayAlpha[$x];
                 
    }
       //print_r($arrayAlpha);
  
  $query2="Select TimeID,DayShift,TimeShift,AptDate FROM DatesAvailable";
  $result2=mysqli_query($conn,$query2);
  $rowCheck2 = $result2->num_rows;
  
  if($rowCheck2 >0)
  {
  	 echo "<table id='tbl' border ='1'>";
            echo "<tr>";
            	//echo "<th>TimeID</th>";
                echo "<th>Day Available</th>";
                echo "<th>Times Available</th>";
                echo "<th>Date</th>";
                echo "<th>Already Selected?</th>";
                echo "<th>Pick Time Slot</th>";         
                echo "</tr>";

  	for($i=0;$i<$rowCheck2;$i++)
  	{
  		$marked=0;
  		$row = mysqli_fetch_array($result2);
  		$TimeID=$row['TimeID'];
  		$DayShift=$row['DayShift'];
  		$TimeShift=$row['TimeShift'];
  		$AptDate=$row['AptDate'];




                echo "<tr>";
                for($x=0;$x<$rowCheck1;$x++)
                {
                 if($arrayAlpha[$x]==$TimeID)
                 {
                 $marked++;
                 break;
                 }

                }
                //echo "<td>".$TimeID."</td>";
                echo "<td>".$DayShift."</td>";
                echo "<td>".$TimeShift."</td>";
                echo "<td>".$AptDate."</td>";
                if($marked > 0)
                {
                echo "<td>Yes</td>";
                
                }
                elseif($marked==0)
                {
                echo "<td>No</td>";
                }
                
                    if($marked==0)
         {

         ?>
         <td><form name="form" method="POST" action="vetAvailabilityPart2.php">
         <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
         <input value="<?php echo $DayShift;?>" type="hidden" name="DayShift">
         <input value="<?php echo $TimeShift;?>" type="hidden" name="TimeShift">
         <input value="<?php echo $AptDate;?>" type="hidden" name="AptDate">
         <input value="<?php echo $VetName;?>" type="hidden" name="VetName">
         <input value="<?php echo $TimeID;?>" type="hidden" name="TimeID">
         



    
     <input type="submit"  value="Select Shift">
  	   </form></td>
         
         <?php
         }
         else
         {
          echo "<td>Shift Occupied By you</td>";


         }


                            
               // $marked=0;
		echo "</tr>";


  	
  	}
  	
echo "</table>";
  }
  else
  {
  echo "No times found<br>";
  }


  $result1->close();
  $result2->close();
  $resultID->close();
  $conn->close();
 
 ?>
 

 <div style="margin-bottom:100px;"></div>


<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
 
</body>
</html>