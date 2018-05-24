<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Location</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<h1>Add Location</h1>
</div>

<div class="navbar" style="clear:both">
  <a href="index.html">Home</a>
  <a href="vetmenu.php">Main Menu</a>
  <a href="logout.php">Logout</a>  
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
    
  $conn = new mysqli($hn, $un, $pw, $db);

  if ($conn->connect_error) die($conn->connect_error); 
  
      

    $LocationName = mysql_entities_fix_string($conn, $_POST['LocationName']);  
    
       
    //Get the Vet User Name from session control    
    $VetUserName = $_SESSION['username'];  
    
    
    //Find the VetID from the Vet table using VetUserName
    
    $sql = "SELECT * FROM Vet WHERE VetUserName='$VetUserName'";
    $result = $conn->query($sql);
    if (!$result) die ($conn->error);
    else if ($result->num_rows)
    {
    
      $row = $result->fetch_array(MYSQLI_NUM);
      $result->close();
      $VetID = $row[3];      
        
    }
    else echo "No records were found for VetID.";
    
    //Check the vetlocation table to make sure the Location does not already exist for this user
   
    $sql = "SELECT * FROM vetlocation WHERE VetID='$VetID' and LocationName='$LocationName'";
    $result = $conn->query($sql);
    if (!$result) die ($conn->error);
    
    $rowsFound = $result->num_rows;
    
    if ($rowsFound > 0)
    {
    	echo "This location is already part of your record." . "<br>";
    }
    else 
    {
      $stmt = $conn->prepare("INSERT INTO vetlocation (LocationName, VetID) 
      VALUES (?, ?)");
      $stmt->bind_param("ss", $LocationName, $VetID);		

      $stmt->execute();		          
          
      echo "$LocationName has been added to your records.";
          echo "<br>";
          $stmt->close();  
          
        
    }
        
		
		    	    
    
    
    
    

  
  //********************************************************
  //          **FUNCTIONS TO SANITIZE STRINGS**
  //********************************************************                           
    function mysql_entities_fix_string($connection, $string)
    {
        return htmlentities(mysql_fix_string($connection, $string));
    }
    
    function mysql_fix_string($connection, $string)
    {
        if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return $connection->real_escape_string($string);
    }	

?>

<div class="footer"> 

<div> <h3>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h3> </div>
 </div>
</body>
</html>