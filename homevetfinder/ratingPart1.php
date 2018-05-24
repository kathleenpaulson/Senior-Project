<html>
<head>
	
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
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
<h1></h1>
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
//use functions to connect to database and start session to access username this is to be done for Clients
require_once 'login.php';
session_start();
  
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


$queryID="Select UserID FROM Users WHERE UserName='$username'";
$resultID=mysqli_query($conn,$queryID);
  $rowID = mysqli_fetch_array($resultID);
  $UserID=$rowID['UserID'];
 

	//echo $UserID;
        



$query="Select Vet.vetFirstName,Vet.vetLastName,Appointment.AppointmentID,Users.firstName,Users.lastName,Invoices.Paid,Invoices.InvoiceID,Ratings.RatingID FROM Invoices LEFT JOIN Ratings ON Invoices.InvoiceID=Ratings.InvoiceID JOIN Appointment ON Invoices.AppointmentID=Appointment.AppointmentID JOIN Users ON Appointment.UserID=Users.UserID JOIN Vet ON Appointment.VetID=Vet.VetID WHERE Invoices.UserID='$UserID'";
 $result=mysqli_query($conn,$query);
  //$rowInfo = mysqli_fetch_array($result);




$rowCount = $result->num_rows;
if($rowCount >0)
{
echo "<table id='tbl' border ='1'>";
            echo "<tr>";
            	echo "<th>AppointmentID</th>";
                echo "<th>Vets Name</th>";
                echo "<th>InvoiceID</th>";
                echo "<th>Rating Possible?</th>";
                 echo "<th>Start Rating</th>";                 
                echo "</tr>";
        
         for($i=0;$i<$rowCount;$i++)
        {
            echo "<tr>";

            $row = mysqli_fetch_array($result);
	    $UserName=$row['firstName'].' '.$row['lastName'];

            $VetName='Dr.'.$row['vetFirstName'].' '.$row['vetLastName'];
        echo "<td>".$row['AppointmentID']."</td>";
        echo "<td>".$VetName."</td>";
        echo "<td>".$row['InvoiceID']."</td>";
        
        if($row['Paid']=='Paid')
         {
         echo "<td>Can Send Rating</td>";

         }
         else         
	 {
          echo "<td>Pay Invoice before rating!</td>";
	 }
                
         if($row['RatingID']==NULL)
         {

         ?>
          	 	   <td><form name="form" method="POST" action="ratingPart2.php">
     <input value="<?php echo $InvoiceID;?>" type="hidden" name="InvoiceID">
     <input value="<?php echo $VetID;?>" type="hidden" name="VetID">
     <input value="<?php echo $UserID;?>" type="hidden" name="UserID">
     <input value="<?php echo $VetName;?>" type="hidden" name="VetName">
     <input value="<?php echo $UserName;?>" type="hidden" name="UserName">
      <input type="submit"  value="Make Rating">
  	   </form></td>
         
         <?php
         }
         else
         {
          echo "<td>Rating Completed</td>";
	 }

	echo "</tr>";


        
   
        }
echo "</table>";

}
else
{
echo "No invoices to make a rating<br>";
}


//Method to make and ID for Rating put in part2
/*
$queryCount="Select RatingID FROM Ratings";
$resultCount=mysqli_query($conn,$queryCount);
$rows2=$resultCount->num_rows;
//echo $rows2."<br>";
$newID=$rows2+1;
$check=$newID+1;
if($newID < 10)
{
$ID='R0'.$newID;
}
elseif($newID >10)
{
$ID='R'.$newID;
}

for($x=0;$x<$rows2;$x++)
{
	$rowI=mysqli_fetch_array($resultCount);
	$IDCheck=$rowI['InvoiceID'];
	if($ID==$IDCheck)
	{
	
		$ChangeID=$check+1;
		if($check < 10)
		{
		$ID='R0'.$ChangeID;
		}
		elseif($newID >10)
		{
		$ID='R'.$ChangeID;

		}
		$check++;
	}
}





*/



$resultID->close();
$result->close();
$conn->close();
?>





<form action="clientmenu.php">
    <input type="submit" value="Return to menu" />
</form>
</body>
</html>

