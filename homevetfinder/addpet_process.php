<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add a Pet</title>
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
  
      

    $PetName = mysql_entities_fix_string($conn, $_POST['PetName']);  
    $DOB = mysql_entities_fix_string($conn, $_POST['DOB']);
    $Pet_type = mysql_entities_fix_string($conn, $_POST['Pet_type']);
    
    $UserName = $_SESSION['username'];
    
    
    
    //Find the UserID from the session control username
    
    $sql = "SELECT * FROM Users WHERE UserName='$UserName'";
    $result = $conn->query($sql);
    if (!$result) die ($conn->error);
    else if ($result->num_rows)
    {
    
      $row = $result->fetch_array(MYSQLI_NUM);
      $result->close();
      $UserId = $row[0];
      
        
    }
    else echo "No records were found for UserID.";
    
    
    $Status = "Alive";

		//Find the PetId to insert from the Pet table
			
		$queryCount="Select PetID FROM Pet";
		$resultCount=mysqli_query($conn,$queryCount);
		$rows2=$resultCount->num_rows;
		
		$newID=$rows2+1;
		$check=$newID+1;
		if($newID < 10)
		{
		$ID='P0'.$newID;
		}
		elseif($newID >= 10)
		{
		$ID='P'.$newID;
		}
		
		for($x=0;$x<$rows2;$x++)
		{
			$rowI=mysqli_fetch_array($resultCount);
			$IDCheck=$rowI['PetID'];
			if($ID==$IDCheck)
			{
			
				$ChangeID=$check+1;
				if($ChangeID < 10)
				{
				$ID='P0'.$ChangeID;
				}
				elseif($ChangeID >=10)
				{
				$ID='P'.$ChangeID;
		
				}
				$check++;
			}
                 }
		// $ID is the PetID to be inserted.   
		
		    $PetID = $ID;	    
		    $stmt = $conn->prepare("INSERT INTO Pet (PetID, UserID, PetName, Pet_type, DOB, Status) 
		    VALUES (?, ?, ?, ?, ?, ?)");
		    $stmt->bind_param("ssssss", $PetID, $UserId, $PetName, $Pet_type, $DOB, $Status);
		
		
		    $stmt->execute();
		          
		          
		    echo "Your pet $PetName has been added to your records.";
		          echo "<br>";
		          $stmt->close();
		    
		    

               




  
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