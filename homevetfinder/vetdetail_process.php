<!DOCTYPE html>
<html lang="en">
<head>
    <title>Vet Detail Process</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <link rel="stylesheet" type="text/css" href="clientformstyle.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
  require_once 'login.php'; 
  require_once 'vet_sessioncontrol.php'; 
    
  $conn = new mysqli($hn, $un, $pw, $db);

  if ($conn->connect_error) die($conn->connect_error); 
  
      

    $Email = mysql_entities_fix_string($conn, $_POST['Email']);  
    $vetLastName = mysql_entities_fix_string($conn, $_POST['vetLastName']);
    $vetFirstName = mysql_entities_fix_string($conn, $_POST['vetFirstName']);
    $vetZipCode = mysql_entities_fix_string($conn, $_POST['vetZipCode']);
    $Phone_Number = mysql_entities_fix_string($conn, $_POST['Phone_Number']);
    $Vet_Bio = mysql_entities_fix_string($conn, $_POST['VetBio']);
    $City = mysql_entities_fix_string($conn, $_POST['City']);    
    $State = mysql_entities_fix_string($conn, $_POST['State']);
    $VetStreet = mysql_entities_fix_string($conn, $_POST['VetStreet']);
    

		//Find the vetId to insert from the Vet table
			
		$queryCount="Select VetID FROM Vet";
		$resultCount=mysqli_query($conn,$queryCount);
		$rows2=$resultCount->num_rows;
		
		$newID=$rows2+1;
		$check=$newID+1;
		
		if($newID < 10)
		{
		$ID='V0'.$newID;
		
		}
		elseif($newID >= 10)
		{
		$ID='V'.$newID;
		
		}
		
		
		
		
		for($x=0;$x<$rows2;$x++)
		{
			$rowI=mysqli_fetch_array($resultCount);
			$IDCheck=$rowI['VetID'];
			
			if($ID==$IDCheck)
			{
			
				$ChangeID=$check+1;
				if($ChangeID < 10)
				{
				$ID='V0'.$ChangeID;
				}
				elseif($ChangeID >=10)
				{
				$ID='V'.$ChangeID;
		
				}
				$check++;
			}
                 }
		// $ID is the VetID to be inserted.   
			
		    $VetID = $ID;
		    $VetUserName = $_SESSION['username'];		    
		    $stmt = $conn->prepare("INSERT INTO Vet (vetFirstName, vetLastName, VetUserName, VetID, Email, VetStreet, City, 
                    State, vetZipCode, Vet_Bio, Phone_Number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		    $stmt->bind_param("ssssssssiss", $vetFirstName, $vetLastName, $VetUserName, $VetID, $Email, $VetStreet, $City, 
                    $State, $vetZipCode, $Vet_Bio, $Phone_Number);
		
		
		    $stmt->execute();
		          
		          
		    echo "You have completed the registration process, " . $vetFirstName. $vetLastName;
		          echo "<br><br>";
		          $stmt->close();
		          
		    if(isset($_SESSION['username']))
			{
			    $_SESSION = array();
			    setcookie(session_name(), '', time() - 2592000, '/');
			    session_destroy();			      
			}          
		          
		    echo "<a href=\"vetlogin_form.html\">Go to Login Page</a>";	
		    echo "<br>";	

               




  
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
<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div> 
</body>
</html>