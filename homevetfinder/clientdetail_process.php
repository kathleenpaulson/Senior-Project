<!DOCTYPE html>
<html lang="en">
<head>
    <title>Client Detail Process</title>
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
  require_once 'client_sessioncontrol.php';  
    
  $conn = new mysqli($hn, $un, $pw, $db);

  if ($conn->connect_error) die($conn->connect_error); 
  
      

    $Email = mysql_entities_fix_string($conn, $_POST['Email']);  
    $lastName = mysql_entities_fix_string($conn, $_POST['lastName']);
    $firstName = mysql_entities_fix_string($conn, $_POST['firstName']);
    $ZipCode = mysql_entities_fix_string($conn, $_POST['ZipCode']);
    $City = mysql_entities_fix_string($conn, $_POST['City']);    
    $STATE = mysql_entities_fix_string($conn, $_POST['STATE']);
    $Street_Address = mysql_entities_fix_string($conn, $_POST['Street_Address']);
    

		//Find the UserId to insert from the User table
			
		$queryCount="Select UserID FROM Users";
		$resultCount=mysqli_query($conn,$queryCount);
		$rows2=$resultCount->num_rows;
		
		$newID=$rows2+1;
		$check=$newID+1;
		if($newID < 10)
		{
		$ID='U0'.$newID;
		}
		elseif($newID >= 10)
		{
		$ID='U'.$newID;
		}
		
		for($x=0;$x<$rows2;$x++)
		{
			$rowI=mysqli_fetch_array($resultCount);
			$IDCheck=$rowI['UserID'];
			if($ID==$IDCheck)
			{
			
				$ChangeID=$check+1;
				if($ChangeID < 10)
				{
				$ID='U0'.$ChangeID;
				}
				elseif($ChangeID >=10)
				{
				$ID='U'.$ChangeID;
		
				}
				$check++;
			}
                 }
		// $ID is the UserID to be inserted.   
		    
		    $UserID = $ID;
		    $UserName = $_SESSION['username'];		    
		    $stmt = $conn->prepare("INSERT INTO Users (firstName, lastName, UserName, UserID, Email, Street_Address, City, 
                    STATE, ZipCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		    $stmt->bind_param("ssssssssi", $firstName, $lastName, $UserName, $UserID, $Email, $Street_Address, $City, 
                    $STATE, $ZipCode);
		
		
		    $stmt->execute();
		          
		          
		    printf("You have completed the registration process, $firstName $lastName.\n");
		          echo "<br><br>";
		          $stmt->close();
		          
		    if(isset($_SESSION['username']))
			{
			    $_SESSION = array();
			    setcookie(session_name(), '', time() - 2592000, '/');
			    session_destroy();			      
			}          
		          
		    echo "<a href=\"clientlogin_form.html\">Go to Login Page</a>";	
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

<div> <h3>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h3> </div>
 </div>
</body>
</html>