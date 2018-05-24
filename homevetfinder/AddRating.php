<!DOCTYPE html>

<head>

	<title>Add Vet Rating</title>
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<link rel="stylesheet" type="text/css" href="petfinder.css">
	   
	<script>

	function myFunction() {
  
    		 document.getElementById("a1").style.backgroundColor = "black";
			}
	</script>
</head>

<body>
<div class="header">
<p><img src="images/homevetfinder.png" alt="Picture of a dog and cat" /></p>
<h1>Add Vet Ratings</h1>
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
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
 echo "<div>";
if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];        
  }
$queryID="Select UserID FROM Users WHERE UserName='$username'";
$resultID=mysqli_query($conn,$queryID);
  $rowID = mysqli_fetch_array($resultID);
  $UserID=$rowID['UserID'];
$query = "Select Invoices.InvoiceID, Vet.VetID, Vet.vetFirstName, Vet.vetLastName, Appointment.Date_visit, Appointment.Time_Visit, Users.firstName, Users.lastName, Ratings.Rating FROM Invoices LEFT JOIN Ratings ON Invoices.InvoiceID=Ratings.InvoiceID JOIN Appointment ON Invoices.AppointmentID=Appointment.AppointmentID JOIN Users ON Appointment.UserID=Users.UserID JOIN Vet ON Appointment.VetID=Vet.VetID WHERE Invoices.UserID='$UserID' and RatingID is null;";
$query2 = "Select * from Ratings;";
$result = $conn->query($query);
$result2 = $conn->query($query2);
 if (!$result) die($conn->error);
 if (!$result2) die($conn->error);
  $rows = $result->num_rows;
  $rows2 = $result2->num_rows;
 $r=mysqli_fetch_array($result); 
$result->data_seek(0);
$result2->data_seek(0);
$entered = false;
if ($rows == 0) {
echo "<script> alert('no unrated invoices to rate')</script> ";
echo "<script>window.location.href='clientmenu.php'; </script>";
$result->close();
$result2->close();
  $conn->close();
  $entered = true;
  
}

?>
<div style="margin-top: 20px;"></div>
<select id="filter">
<option disabled selected value> -- select an invoice to rate -- </option>
<?php 

while ($row = $result->fetch_array()){

?>
<option name="invoiceID" id = <?php echo $row['VetID']?>><?php echo $row['InvoiceID'];?></option>
<?php

// close while loop 
}

?>

</select>
<table id = "myTable" hidden>
   		<tr>
    			<th>FirstName</th>
     			<th>LastName</th>
  			<th>DateVisited</th>
  			<th>TimeVisited</th>
  			<th>Rating</th>
  		</tr>
   		<?php
   				
   				$result->data_seek(0);
   				while ($row2 = $result->fetch_assoc()) {
   				
   			 	$InvoiceID = $row2['InvoiceID'];
   				$VetFirstName = $row2['vetFirstName'] ;
   				$VetLastName = $row2['vetLastName'];
   				$VetID = $rows2['VetID'];
   				$DateVisited = $row2['Date_visit'];
   				$TimeVisited = $row2['Time_Visit'];
				$FirstName = $row2['firstName'];
				$LastName = $row2['lastName'];
				$Rating = $row2['Rating'];
				$Pet = $row2['Pet_type'];
				echo "<tr data-status='$InvoiceID'>";
				echo "<td>$VetFirstName</td>";
				echo "<td>$VetLastName</td>";
				echo "<td>$DateVisited</td>";
				echo "<td>$TimeVisited</td>";
				echo "<td>$Pet</td>";
				echo "<td><select id = 'textRating' name='selectRating'>
				<option name = 'Rating' value = '0'>0</option>
				<option name = 'Rating' value = '1'>1</option>
				<option name = 'Rating' value = '2'>2</option>
				<option name = 'Rating' value = '3'>3</option>
				<option name = 'Rating' value = '4'>4</option>
				<option name = 'Rating' value = '5'>5</option></td>";
				echo "</tr>";
				}	
		?>
	</table>
	
	<?php
	// Find the RatingID to add
	$ratingID = 0;
	$temp = $rows2 + 1;
	if ($temp < 10)
	{
		$ratingID = 'R0' . $temp;
	}
	else
	{
		$ratingID = 'R' . $temp;
	}
	
		?>
		<td><form name="form" method="POST" action="AddRating2.php">
     <input id="invoiceID" value="" type="hidden"  name="InvoiceID">
     <input id="vetID" value="" type="hidden"  name="VetID">
     <input id = "userID" value="<?php echo $UserID;?>" type="hidden"  name="UserID">
     <input id ="rating" value="" type="hidden"  name="Rating">
     <input id = "ratingID" value="<?php echo $ratingID;?>" type="hidden"  name="RatingID">
      <input type="submit"  value="Make Rating">
  	   </form></td>
<?php
 
$result->close();
$result2->close();
  $conn->close();
?>


 <div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>

</body>
</html>

<script>
// Whenever the selection of the filter drop-down changes:
document.getElementById('filter').onchange = function() {
	document.getElementById('myTable').hidden = false;
    var filter = this.options[this.selectedIndex].value;
    // Iterate over all rows that have a data-status attribute
    [].forEach.call(document.querySelectorAll('tr[data-status]'), function (tr) {
        // Show/hide this row based on filter:
        tr.style.display = tr.getAttribute('data-status') === filter
            ? ''
            : 'none';
            
            
    });
    document.getElementById('invoiceID').value = filter;
    document.getElementById('vetID').value = this.options[this.selectedIndex].id
}
document.getElementById('textRating').onchange = function() {
	var value = this.value;
	document.getElementById('rating').value = value;
}
</script>


<?php
// the variables to use for the insert are $ratingID, $InvoiceID, $UserID, vetID is the selectedIndex of the dropdown, rating is
// whatever is in the text box which must be concatenated with a /5 and probably some error checking for is a number and between 0 and 5
?>