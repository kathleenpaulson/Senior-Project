 
<!DOCTYPE html>
<html>
<head>
	
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
<h1>View/Delete Appointments</h1>
</div>

<div class="navbar" style="clear:both">
  <a href="index.html">Home</a>
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
    
    //echo "Welcome back '$username'";
          
  }
  else echo "Please <a href=clientlogin_form.html>click here</a> to log in.";
  
  
  $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);
 
 $queryUserName="Select firstName,lastName,UserID FROM Users where UserName='$username'";
 $resultUser=mysqli_query($conn,$queryUserName);
 
 $rowName = mysqli_fetch_array($resultUser);
	$UserID = $rowName['UserID'];
        $UserName=$rowName['firstName'].' '.$rowName['lastName'];
        //echo $UserID."<br>";
        //echo $UserName."<br>";

echo "Appointments - $UserName<br><br>";
 $queryApt="Select Appointment.AppointmentID,Vet.vetFirstName,Vet.vetLastName,Pet.PetName,Appointment.Date_visit,Appointment.Time_visit,Appointment.VetID,Invoices.InvoiceID FROM Appointment JOIN Vet ON Appointment.VetID=Vet.VetID  JOIN Pet ON Appointment.PetID=Pet.PetID LEFT JOIN Invoices ON Appointment.AppointmentID=Invoices.AppointmentID WHERE Appointment.UserID='$UserID';";
$resultApt=mysqli_query($conn,$queryApt);
$rowCount = $resultApt->num_rows;
//echo $rowCount."<br>";
if($rowCount >0)
{
 echo "<table id='tbl' border ='1'>";
            echo "<tr>";
            	//echo "<th>AppointmentID</th>";
                echo "<th>Vet First Name</th>";
                echo "<th>Vet Last Name</th>";
                echo "<th>Pet</th>";
                echo "<th>Appointment Date</th>";
                echo "<th>Appointment Time</th>"; 
                echo "<th>Invoice Received</th>"; 
                 echo "<th>Cancel Appointment</th>";                 
                echo "</tr>";
                
        for($i=0;$i<$rowCount;$i++)
        {
        $row = mysqli_fetch_array($resultApt);
         echo "<tr>";
         $AppointmentID=$row['AppointmentID'];
         $VetID=$row['VetID'];
         $Hours=$row['Time_visit'];
         $DateVisit=$row['Date_visit'];
         $vetFirstName=$row['vetFirstName'];
         $vetLastName=$row['vetLastName'];
         $vetname="Dr.". $vetFirstName." ". $vetLastName;

         //echo "<td>".$row['AppointmentID']."</td>";
         echo "<td>".$vetFirstName."</td>";
         echo "<td>".$vetLastName."</td>";
         echo "<td>".$row['PetName']."</td>";
         echo "<td>".$row['Date_visit']."</td>";
         echo "<td>".$row['Time_visit']."</td>";
         if($row['InvoiceID']==NULL)
         {
         echo "<td>Not Received</td>";

         }
         else
         {
          echo "<td>Received</td>";

         }
                  
          if($row['InvoiceID']==NULL)
         {

         ?>
          	 	   <td><form name="form" method="POST" action="userAppointmentViewPart2.php">
     <input value="<?php echo $AppointmentID;?>" type="hidden" name="AppointmentID">
     <input value="<?php echo $UserID;?>" type="hidden" name="UserID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
     <input value="<?php echo $vetname;?>" type="hidden" name="VetName">


     <input value="<?php echo $UserName;?>" type="hidden" name="UserName">
      <input value="<?php echo $Hours;?>" type="hidden" name="Hours">
      <input value="<?php echo $DateVisit;?>" type="hidden" name="DateVisit">

     <input type="submit"  value="Delete Appointment">
  	   </form></td>
         
         <?php
         }
         else
         {
          echo "<td>Appointment Completed</td>";


         }

	echo "</tr>";


        
   
        }

echo "</table>";
}
else
{
echo "No appointments found for '$UserName'<br>";
}
 
 
 
 
 
 
 
  $resultUser->close();
  $resultApt->close();
  $conn->close();

?>



<div style="margin-bottom: 100px"></div>


<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
 <div style="margin-bottom: 100px"></div>
</body>
</html>