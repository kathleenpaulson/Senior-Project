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
<h1>View Invoice</h1>
</div>

<div class="navbar" style="clear:both">
  <a href="index.html">Home</a>
  <a href="ViewRating.php">View Vet Ratings</a>
  <a href="logout.php">Logout</a>
  <div class="dropdown">
    <button class="dropbtn" onclick="myFunction()">Log In/Sign Up
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" id="myDropdown">
      <a href="clientsignup.php">Client Sign Up</a>
      <a href="clientlogin_form.html">Client Sign In</a>
      <a href="vetsignup.php">Vet Sign Up</a>
      <a href="vetlogin_form.html">Vet Sign In</a>      
    </div>
    
    
    
  </div> 
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
   
    $queryInvoice="Select Invoices.InvoiceID,Invoices.UserID,Invoices.AppointmentID,Invoices.Amount,Invoices.CareID,Invoices.Paid,Users.firstName,Users.lastName FROM Invoices Join Appointment ON Invoices.AppointmentID=Appointment.AppointmentID Join Users ON Appointment.UserID=Users.UserID Where Invoices.VetID='$VetID'";
    
    echo "Here is the Invoices you have sent for appointments Dr.$VetName<br>";
    $resultInvoice=mysqli_query($conn,$queryInvoice);
    $rowCount = $resultInvoice->num_rows;
    //echo $rowCount."<br>";
 
if($rowCount >0)
{

echo "<table id='tbl' border ='1'>";
            echo "<tr>";
            	echo "<th>InvoiceID</th>";
                echo "<th>AppointmentID</th>";
                echo "<th>UserID</th>";
                echo "<th>Client First Name</th>";
                echo "<th>Client Last Name</th>";
                echo "<th>Amount</th>";
                echo "<th>CareID</th>"; 
                echo "<th>Paid</th>";
                echo "<th>Cancel Invoice</th>"; 
                echo "<th>Confirm Payment</th>";
                            
                echo "</tr>";

               
        for($i=0;$i<$rowCount;$i++)
        {

        $row = mysqli_fetch_array($resultInvoice);

        $InvoiceID=$row['InvoiceID'];
        $AppointmentID=$row['AppointmentID'];

        $UserID=$row['UserID'];
        $userFirstName=$row['firstName'];

        $userLastName=$row['lastName'];
        $Amount=$row['Amount'];
        $CareID=$row['CareID'];
        $paid=$row['Paid'];
      
         echo "<tr>";
         echo "<td>".$InvoiceID."</td>";
         echo "<td>".$AppointmentID."</td>";
        echo "<td>".$UserID."</td>";
         echo "<td>".$userFirstName."</td>";
         echo "<td>".$userLastName."</td>";
         echo "<td>".$Amount."</td>";
     echo "<td>".$CareID."</td>";
     echo "<td>".$row['Paid']."</td>";
     
     if($row['Paid']=='No')
     {
     ?>
       <td><form name="form" method="POST" action="vetCancelInvoicePart1.php">
          <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
          <input value="<?php echo $InvoiceID;?>" type="hidden" name="InvoiceID">
          <input value="<?php echo $UserID;?>" type="hidden" name="UserID">
          <input value="<?php echo $userFirstName;?>" type="hidden" name="firstName">
          <input value="<?php echo $userLastName;?>" type="hidden" name="lastName">
           <input value="<?php echo $Amount;?>" type="hidden" name="Amount">
            <input value="<?php echo $CareID;?>" type="hidden" name="CareID">
           <input value="<?php echo $VetName;?>" type="hidden" name="VetName">

           <input type="submit"  value="Cancel Invoice">
  	   </form></td>

     
     <?php
	echo "<td>Invoice not Paid</td>";

     }
     elseif($row['Paid']=='Pending')
     {
      //echo "<td>Invoice awaiting confirmation</td>";
     ?>
            <td><form name="form" method="POST" action="vetCancelInvoicePart1.php">
          <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
          <input value="<?php echo $InvoiceID;?>" type="hidden" name="InvoiceID">
          <input value="<?php echo $UserID;?>" type="hidden" name="UserID">
          <input value="<?php echo $userFirstName;?>" type="hidden" name="firstName">
          <input value="<?php echo $userLastName;?>" type="hidden" name="lastName">
           <input value="<?php echo $Amount;?>" type="hidden" name="Amount">
            <input value="<?php echo $CareID;?>" type="hidden" name="CareID">
           <input value="<?php echo $VetName;?>" type="hidden" name="VetName">

           <input type="submit"  value="Cancel Invoice">
  	   </form></td>


	  <td><form name="form" method="POST" action="vetConfirmInvoicePart1.php">
          <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
          <input value="<?php echo $InvoiceID;?>" type="hidden" name="InvoiceID">
          <input value="<?php echo $UserID;?>" type="hidden" name="UserID">
          <input value="<?php echo $userFirstName;?>" type="hidden" name="firstName">
          <input value="<?php echo $userLastName;?>" type="hidden" name="lastName">
           <input value="<?php echo $Amount;?>" type="hidden" name="Amount">
            <input value="<?php echo $CareID;?>" type="hidden" name="CareID">
           <input value="<?php echo $VetName;?>" type="hidden" name="VetName">
		<input value="1" type="hidden" name="confirm">
		<input type="submit"  value="Confirm Invoice">
  	   	</form> </td>

     <?php     
     }
     elseif($row['Paid']=='Paid')
     {
     echo "<td>Invoice Already Paid</td>";
     echo"<td>Payment Already Processed</td>";

     }
     
        
     
    //echo "<td>Invoice Pending</td>";

     echo "</tr>";

        }
        
              
echo "</table>";
//mysqli_free_result($resultInvoice); 

}

elseif($rowCount==0)
{
echo "No Invoices sent!<br>";
}



//$resultVet->close();
$resultInvoice->close();

$conn->close();
    
?>
    

<div style="margin-top:30px;"></div>
<form action="vetmenu.php">
    <input type="submit" value="Return to menu" />
</form>
<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
 <div style="margin-bottom: 100px;"></div>
</body>
</html>
