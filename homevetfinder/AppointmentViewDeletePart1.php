<html>
<head>
<title>Appointment View Delete</title>
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
<h1>Delete Appointment</h1>
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

  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    
    //echo "Welcome back '$username'";
          
  }
  else echo "Please <a href=clientlogin_form.html>click here</a> to log in.";
  
  
  $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);
 
 $queryVetName="Select vetFirstName,vetLastName,VetID FROM Vet where VetUserName='$username'";
 $resultVet=mysqli_query($conn,$queryVetName);
 
 $rowName = mysqli_fetch_array($resultVet);
	$VetID = $rowName['VetID'];
        $VetName=$rowName['vetFirstName'].' '.$rowName['vetLastName'];
        //echo $VetID."<br>";
        //echo $VetName."<br>";
echo "<br>";
echo "Appointments for Dr. $VetName<br>";
echo "<br>";

 $queryApt="Select  Appointment.AppointmentID,Users.firstName,Users.lastName,Pet.PetName,Appointment.Date_visit,Appointment.Time_visit,Invoices.InvoiceID FROM Appointment JOIN Users ON Appointment.UserID=Users.UserID  JOIN Pet ON Appointment.PetID=Pet.PetID LEFT JOIN Invoices ON Appointment.AppointmentID=Invoices.AppointmentID WHERE Appointment.VetID='$VetID'";
$resultApt=mysqli_query($conn,$queryApt);
$rowCount = $resultApt->num_rows;
//echo $rowCount."<br>";
if($rowCount >0)
{
 echo "<table id='tbl' border ='1'>";
            echo "<tr>";
            	//echo "<th>AppointmentID</th>";
                echo "<th>Client First Name</th>";
                echo "<th>Client Last Name</th>";
                echo "<th>Client Pet Name</th>";
                echo "<th>Appointment Date</th>";
                echo "<th>Appointment Time</th>"; 
                echo "<th>Invoice Sent</th>"; 
                 echo "<th>Cancel Appointment</th>";                 
                echo "</tr>";
                
        for($i=0;$i<$rowCount;$i++)
        {
        $row = mysqli_fetch_array($resultApt);
         echo "<tr>";
         $AppointmentID=$row['AppointmentID'];
         $Hours=$row['Time_visit'];
         $DateVisit=$row['Date_visit'];
         //echo "<td>".$row['AppointmentID']."</td>";
         echo "<td>".$row['firstName']."</td>";
         echo "<td>".$row['lastName']."</td>";
         echo "<td>".$row['PetName']."</td>";
         echo "<td>".$row['Date_visit']."</td>";
         echo "<td>".$row['Time_visit']."</td>";
         if($row['InvoiceID']==NULL)
         {
         echo "<td>Not Sent</td>";

         }
         else
         {
          echo "<td>Sent</td>";

         }
                  
          if($row['InvoiceID']==NULL)
         {

         ?>
          	 	   <td><form name="form" method="POST" action="AppointmentViewDeletePart2.php">
     <input value="<?php echo $AppointmentID;?>" type="hidden" name="AppointmentID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
     <input value="<?php echo $VetName;?>" type="hidden" name="VetName">
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
echo "No appointments found for Dr. '$VetName'<br>";
}
 
 
 
 
 
 
 
  $resultVet->close();
  $resultApt->close();
  $conn->close();

?>

<br>
<div style=“margin-bottom:100px;”></div>

<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>