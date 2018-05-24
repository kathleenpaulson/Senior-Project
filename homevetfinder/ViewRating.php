<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Vet Ratings</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<h1>View Ratings</h1>
</div>

<div class="navbar" style="clear:both">
  <a href="index.html">Home</a>
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
 session_start();
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
 echo "<div>";
$query = "Select * from Vet;";
$query2 = "Select * from Ratings join Invoices on Ratings.InvoiceID = Invoices.InvoiceID join Appointment on Appointment.AppointmentID = Invoices.AppointmentID join Users on Users.UserID = Invoices.UserID join Pet on Users.UserID = Pet.UserID where Pet.PetID = Appointment.PetID;";
$result = $conn->query($query);
$result2 = $conn->query($query2);
 if (!$result) die($conn->error);
 if (!$result2) die($conn->error);
  $rows = $result->num_rows;
  $rows2 = $result2->num_rows;
 $r=mysqli_fetch_array($result); 
 $r2=mysqli_fetch_array($result2);
$result->data_seek(0);
$result2->data_seek(0);
?>
<div>
<h2>Please choose a vet from the dropdown menu below:</h2>
</div>



<select id="filter">
<?php 


while ($row = $result->fetch_assoc()){

?>
<option id = <?php echo $row['VetID']?>><?php echo $row['vetFirstName'] . " " . $row['vetLastName'];?></option>


<?php

// close while loop 
}
?>

</select>


<h2>Ratings</h2>
  	<table id="tbl">
   		<tr>
    			<th>First Name</th>
     			<th>Last Name</th>
  			<th>Rating</th>
  			<th>Type of Pet</th>
  		</tr>
  		<tr>
  			<td id ="insertHere"></td>
  		</tr>
   		<?php
   			while ($row2 = $result2->fetch_assoc()) {
   				$VetName = $row2['vetFirstName'] . " " . $row2['vetLastName'];
   				$VetID = $row2['VetID'];
				$FirstName = $row2['firstName'];
				$LastName = $row2['lastName'];
				$Rating = $row2['Rating'];
				$Pet = $row2['Pet_type'];
				echo "<tr data-status='$VetID'>";
				echo "<td>$FirstName</td>";
				echo "<td>$LastName</td>";
				echo "<td>$Rating</td>";
				echo "<td>$Pet</td>";
				echo "</tr>";
				}
				
				
		?>
	</table>

<script>
// Whenever the selection of the filter drop-down changes:
document.getElementById('filter').onchange = function() {
    var found = false;
    var filter = this.options[this.selectedIndex].id;
    // Iterate over all rows that have a data-status attribute
    [].forEach.call(document.querySelectorAll('tr[data-status]'), function (tr) {
        // Show/hide this row based on filter:
        tr.style.display = tr.getAttribute('data-status') === filter
            ? ''
            : 'none';
        if (tr.style.display != 'none')
        {
        	found = true;
        }	
        if (found == false)
        {
        
        var insert = document.getElementById('insertHere');
        insert.innerHTML = "There are no ratings for this vet";
        }
        else
        {
        var insert = document.getElementById('insertHere');
        insert.innerHTML = "";
        }
    });
}

</script>


<?php
 
$result->close();
$result2->close();
  $conn->close();
?>

<br>
<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>    
 <div style="margin-bottom: 100px"></div>
</body>
</html>