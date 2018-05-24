<html>
<head>
	<title>View/Pay Invoices</title>
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
<h1>View/Pay Invoice</h1>
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
  
  //Check if user is correctly logged in
  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    
    //echo "Welcome back, '$username'.";
          
  }
  else echo "Please <a href=clientlogin_form.html>click here</a> to log in.";
  
 //connect with database 
  $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);


$queryID="Select UserID,firstName,lastName FROM Users WHERE UserName='$username'";
$resultID=mysqli_query($conn,$queryID);
  $rowID = mysqli_fetch_array($resultID);
  $UserID=$rowID['UserID'];
  $Name=$rowID['firstName'].' '.$rowID['lastName'];
 // echo $UserID."<br>";
 // echo $Name."<br>";
  
$queryInvoice="Select Vet.vetFirstName,Vet.vetLastName,Appointment.AppointmentID,Appointment.Date_visit,Appointment.Time_visit,VetPetSpecial.Speciality,Invoices.Amount,Invoices.InvoiceID,Invoices.Paid FROM Invoices JOIN Appointment ON Invoices.AppointmentID=Appointment.AppointmentID JOIN Vet ON Appointment.VetID=Vet.VetID JOIN VetPetSpecial ON Appointment.CareID=VetPetSpecial.CareID WHERE Invoices.UserID='$UserID'";

$resultInvoice=mysqli_query($conn,$queryInvoice);
$rowCount = $resultInvoice->num_rows;
echo "<br>";
echo "Invoices - $Name<br><br>";
if($rowCount >0)
{
echo "<table id='tbl' border ='1'>";
            echo "<tr>";
            	//echo "<th>AppointmentID</th>";
                echo "<th>Name of Vet</th>";
                echo "<th>Date</th>";
                echo "<th>Time</th>";
                 echo "<th>Type of Care</th>";  
                  echo "<th>Amount</th>";  
                     echo "<th>Invoice Paid?</th>";  
                      echo "<th>Pay Invoice</th>";  
                               
                echo "</tr>";
        
         for($i=0;$i<$rowCount;$i++)
        {
            echo "<tr>";

            $row = mysqli_fetch_array($resultInvoice);
            $InvoiceID=$row['InvoiceID'];
	    $UserName=$row['firstName'].' '.$row['lastName'];
	    $Amount=$row['Amount'];
	    $Paid=$row['Paid'];
            $VetName='Dr.'.$row['vetFirstName'].' '.$row['vetLastName'];
        //echo "<td>".$row['AppointmentID']."</td>";
        echo "<td>".$VetName."</td>";
        echo "<td>".$row['Date_visit']."</td>";
        echo "<td>".$row['Time_visit']."</td>";
        echo "<td>".$row['Speciality']."</td>";
        echo "<td>".$row['Amount']."</td>";
         echo "<td>".$Paid."</td>";

        

                
         if($Paid =='No')
         {

         ?>
          	 	   <td><form name="form" method="POST" action="ViewPayInvoicePart2.php">
     <input value="<?php echo $InvoiceID;?>" type="hidden" name="InvoiceID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
     <input value="<?php echo $UserID;?>" type="hidden" name="UserID">
     <input value="<?php echo $VetName;?>" type="hidden" name="VetName">
     <input value="<?php echo $Name;?>" type="hidden" name="UserName">
     <input value="<?php echo $Amount;?>" type="hidden" name="Amount">
      <input type="submit"  value="Pay Bill">
  	   </form></td>
         
         <?php
         }
         elseif($Paid=='Paid')
         {
          echo "<td>Already Paid</td>";
	 }
	 elseif($Paid=='Pending')
	 {
	  echo "<td>Waiting for Vet Confirmation</td>";

	 }

	echo "</tr>";


        
   
        }
echo "</table>";

}
else
{
echo "No invoices to pay.<br>";
}


  $resultInvoice->close();
  $resultID->close();
  $conn->close();
?>


<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
 <div style="margin-bottom: 100px;"></div>
</body>
</html>