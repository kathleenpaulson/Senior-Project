<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Insurance</title>
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
<h1>Add Insurance</h1>
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
      

    $Insurance_Type = mysql_entities_fix_string($conn, $_POST['Insurance_Type']);  
    
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
    
    
    //Find the Insurance_ID from Insurance_Type    
    $sql = "SELECT * FROM Insurance WHERE Insurance_Type='$Insurance_Type'";
    $result = $conn->query($sql);
    if (!$result) die ($conn->error);
    else if ($result->num_rows)
    {
    
      $row = $result->fetch_array(MYSQLI_NUM);
      $result->close();
      $Insurance_ID = $row[0];  
        
    }
    else echo "No records were found for Insurance_ID.";
    
    
		//Create the VetInsuranceID to insert from the Vet Insurance table
			
		$queryCount="Select VetInsuranceID FROM VetInsurance";
		$resultCount=mysqli_query($conn,$queryCount);
		$rows2=$resultCount->num_rows;
		
		$newID=$rows2+1;
		$check=$newID+1;
		if($newID < 10)
		{
		$ID='VI0'.$newID;
		}
		elseif($newID >= 10)
		{
		$ID='VI'.$newID;
		}
		
		for($x=0;$x<$rows2;$x++)
		{
			$rowI=mysqli_fetch_array($resultCount);
			$IDCheck=$rowI['VetInsuranceID'];
			if($ID==$IDCheck)
			{
			
				$ChangeID=$check+1;
				if($ChangeID < 10)
				{
				$ID='VI0'.$ChangeID;
				}
				elseif($ChangeID >=10)
				{
				$ID='VI'.$ChangeID;
		
				}
				$check++;
			}
                 }
		// $ID is the VetInsuranceID to be inserted.   
		
		   
		    
		    
    //Check the VetInsurance table to make sure the Insurance_ID does not already exist for this VetID
    
    $sql = "SELECT * FROM VetInsurance WHERE VetID='$VetID' and Insurance_ID='$Insurance_ID'";
    $result = $conn->query($sql);
    if (!$result) die ($conn->error);
    
    $rowsFound = $result->num_rows;
    
    if ($rowsFound > 0)
    {
    	echo "This insurance is already part of your record." . "<br>";
    }
    else 
    {
    
       	    $VetInsuranceID = $ID;	    
	    $stmt = $conn->prepare("INSERT INTO VetInsurance (VetInsuranceID, VetID, Insurance_ID) 
	    VALUES (?, ?, ?)");
	    $stmt->bind_param("sss", $VetInsuranceID, $VetID, $Insurance_ID);		
	
	    $stmt->execute();		          
	          
	    echo "$Insurance_Type  has been added to your records.";
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