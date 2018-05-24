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
<h1>View/Send Invoices</h1>
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
 
date_default_timezone_set('America/New_York');

 $queryVetName="Select vetFirstName,vetLastName,VetID FROM Vet where VetUserName='$username'";
 $resultVet=mysqli_query($conn,$queryVetName);
 
 $rowName = mysqli_fetch_array($resultVet);
	$VetID = $rowName['VetID'];
        $VetName=$rowName['vetFirstName'].' '.$rowName['vetLastName'];
        //echo $VetID."<br>";
        //echo $VetName."<br>";
 $testDate='2018-04-05';
 date_default_timezone_set('America/New_York');
echo "<br>";
echo "Appointments and Invoices - Dr. $VetName<br><br>";
 $queryApt="Select Appointment.UserID,Appointment.Amount,Appointment.CareID,Appointment.AppointmentID,Users.firstName,Users.lastName,Pet.PetName,Appointment.Date_visit,Appointment.Time_visit,Invoices.InvoiceID FROM Appointment JOIN Users ON Appointment.UserID=Users.UserID  JOIN Pet ON Appointment.PetID=Pet.PetID LEFT JOIN Invoices ON Appointment.AppointmentID=Invoices.AppointmentID WHERE Appointment.VetID='$VetID'";
$resultApt=mysqli_query($conn,$queryApt);
$rowCount = $resultApt->num_rows;
//echo $rowCount."<br>";
if($rowCount >0)
{
 echo "<table id='tbl' border ='1'>";
            echo "<tr>";
            	//echo "<th>AppointmentID</th>";
            	//echo "<th>CareID</th>";
                echo "<th>Client First Name</th>";
                echo "<th>Client Last Name</th>";
                echo "<th>Pet Name</th>";
                echo "<th>Appointment Date</th>";
                echo "<th>Appointment Time</th>"; 
                echo "<th>Amount</th>"; 
                echo "<th>Invoice ID</th>"; 
                 echo "<th>Send Invoice</th>";                 
                echo "</tr>";
                
        for($i=0;$i<$rowCount;$i++)
        {
        $row = mysqli_fetch_array($resultApt);
         echo "<tr>";
         $AppointmentID=$row['AppointmentID'];
         $Hours=$row['Time_visit'];
         $UserID=$row['UserID'];
         $DateVisit=$row['Date_visit'];
         $CareID=$row['CareID'];
         $Amount=$row['Amount'];
         $Date=$row['Date_visit'];
          $UserName=$row['firstName'].' '.$row['lastName'];
         //echo "<td>".$row['AppointmentID']."</td>";
         //echo "<td>".$row['CareID']."</td>";

         echo "<td>".$row['firstName']."</td>";
         echo "<td>".$row['lastName']."</td>";
         echo "<td>".$row['PetName']."</td>";
         echo "<td>".$Date."</td>";
         echo "<td>".$row['Time_visit']."</td>";
          echo "<td>".$row['Amount']."</td>";

         if($row['InvoiceID']==NULL)
         {
         echo "<td>Not Sent</td>";

         }
         else
         {
          echo "<td>".$row['InvoiceID']."</td>";


         }
                  
          if(($row['InvoiceID']==NULL)&&($Date <= date("Y-m-d")))
         {

         ?>
          	 	   <td><form name="form" method="POST" action="vetSendInvoicePart2.php">
     <input value="<?php echo $AppointmentID;?>" type="hidden" name="AppointmentID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
     <input value="<?php echo $UserID;?>" type="hidden" name="UserID">
     <input value="<?php echo $CareID;?>" type="hidden" name="CareID">
     <input value="<?php echo $VetName;?>" type="hidden" name="VetName">
     <input value="<?php echo $UserName;?>" type="hidden" name="UserName">
      <input value="<?php echo $Amount;?>" type="hidden" name="Amount">

      <input value="<?php echo $Hours;?>" type="hidden" name="Hours">
      <input value="<?php echo $DateVisit;?>" type="hidden" name="DateVisit">

     <input type="submit"  value="Send Invoice">
  	   </form></td>
         
         <?php
         }
         elseif(($row['InvoiceID']==NULL)&&($Date > date("Y-m-d")))
         {
          echo "<td>Invoice cannot be sent until: $Date</td>";
	}
	else
	{
	echo "<td>Invoice Already sent</td>";
	}

	echo "</tr>";


        
   
        }
        echo "</table>";


}
else
{
echo "No Appointments found for Dr. '$VetName'<br>";
}
 
 
 
 
 
 
 
  $resultVet->close();
  $resultApt->close();
  $conn->close();

?>

<div style="margin-bottom: 100px;"></div>

 

<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
 
</body>
</html>