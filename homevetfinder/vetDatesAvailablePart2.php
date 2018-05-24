<html>
<head>
	<title>Home Vet Finder</title>
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
<h1>Vets Available</h1>
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
session_start();
require_once 'login.php';
require_once 'vet_sessioncontrol.php';

$conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

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
  
$VetID=$_POST['VetID'];
$duplicate=array('B','C','E');

$VetName=$_POST['VetName'];
$Year=$_POST['Year'];
$Month=$_POST['Month'];
$Day=$_POST['Day'];
$timepick=$_POST['timepick'];

//check day(DayShift) is there
   if(isset($_POST['day']))
 {
     $day=$_POST['day'];
 }
//Instantiate checkers 
$error='FALSE';
$canMake='FALSE';

$checkDateNUM=0;
//check if the user didnt even pick anything for day 
 if($day=='-')
 {
$error='TRUE';
 }
 //check if year has any characters
 if(preg_match("/[a-z]/i",$Year))
 {
 $error='TRUE';
 $checkDateNUM++;
 echo "error found on year<br>";
 
 }
 //check if month has any characters
  if(preg_match("/[a-z]/i",$Month))
 {
 $error='TRUE';
 $checkDateNUM++;
  echo "error found on month<br>";
 
 }
 //set month to a int value
 $checkMonth=intval($Month);
 //check if month is greater than 12
 if($checkMonth > 12)
 {
 $checkDateNUM++;
 }
 //check if day has characters
   if(preg_match("/[a-z]/i",$Day))
 {
 $error='TRUE';
 $checkDateNUM++;
  echo "error found on day<br>";
 
 }
 
 //start of checking if date is old or new
$testDate=$Year.'-'.$Month.'-'.$Day;
$actualDate=date("Y-m-d");
if($testDate < $actualDate)
{
$checkDateNUM++;
}
else
{
echo "|Notification:Date is new|<br>";
}
//end of checking if date is old or new
//start of comparing day that date is selected
$compareDay1= date(strtotime("$Year-$Month-$Day"));
$dayChecker= date('l', $compareDay1);
$combineDate=$testDate.'-'.$dayChecker;
$testDate2=$testDate.'-'.$day;
//echo $testDate2."<br>";
if($testDate2 != $combineDate)
{
$checkDateNUM++;
echo "|Error:Date does not match with day selected|<br>";
}
else
{
echo "|Notification:Date matches with Day selected|<br>";
}
//end of checking if date matches day that is selected



//checking if there were any errors in date checking(even 1 will make an error)
 
if($checkDateNUM==0)
{
$newDate=$Year.'-'.$Month.'-'.$Day;
echo "|Notification:Correct Date INPUTED| <br>";
}
elseif($checkDateNUM>0)
{
echo "|Error Message:Incorrect Date entered|<br>";
$error='TRUE';
}
//end of checking date and day

//start of checking time shift

if($timepick==R)
{
$actualtime='Regular(9am-5pm)';
}
elseif($timepick==L)
{
$actualtime='Late Nights(5pm-Midnight)';
}
elseif($timepick==M)
{
$actualtime='Early Mornings(Midnight-7am)';
}
else
{
$error='TRUE';
}

//end of checking time shift


 //making query to cross reference table
   $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);
 
 $query2="Select TimeID,DayShift,TimeShift,AptDate FROM DatesAvailable";
  $result2=mysqli_query($conn,$query2);
  $rowCheck2 = $result2->num_rows;
//if no errors found check if there is a duplicate  
  if($error=='FALSE')
  {
  for($i=0;$i<$rowCheck2;$i++)
  {
    		$marked=0;
  		$row = mysqli_fetch_array($result2);
  		if($day==$row['DayShift'])
  		{
  		$marked++;
  		}
  		 if($actualtime==$row['TimeShift'])
  		{
  		$marked++;
  		//echo "Duplicate found<br>";
  		}
  		 if($newDate==$row['AptDate'])
  		{
  		$marked++;
  		//echo "Date already present<br>";
  		}
  		
  		if($marked==3)
  		{
  		//echo "Duplicate overall found<br>";
  		$canMake='FALSE';
  		$duplicateID=$row['TimeID'];
  		break;
  		}
  		else
  		{
  		//echo "unique shift can be made<br>";
  		$canMake='TRUE';
  		
  		}
  		
  		
  }
  }
  else
  {
  echo "|Error Message:Cannot check since errors found|<br>";
  }
  
//if no errors or duplicates than proceed to send data for insertion  
  if($canMake=='TRUE')
  {
  echo "|Message:Addition can be made|<br><br>";
 //function to make ID

  $queryCount="Select TimeID FROM DatesAvailable";
$resultCount=mysqli_query($conn,$queryCount);
$rows2=$resultCount->num_rows;
//echo $rows2."<br>";
$newID=$rows2+1;
$check=$newID+1;
if($newID < 10)
{
$ID='DA0'.$newID;
}
elseif($newID >=10)
{
$ID='DA'.$newID;
}

for($x=0;$x<$rows2;$x++)
{
	$rowI=mysqli_fetch_array($resultCount);
	$IDCheck=$rowI['TimeID'];
	if($ID==$IDCheck)
	{
	
		$ChangeID=$check+1;
		if($ChangeID < 10)
		{
		$ID='DA0'.$ChangeID;
		}
		elseif($ChangeID >=10)
		{
		$ID='DA'.$ChangeID;

		}
		$check++;
	}
}
//end of making new ID
echo "New ID to be made is: $ID<br>";
echo "New Date is: $newDate<br>";
echo "new Day to be added is: $day<br>";
echo "New time slot to be added is: $actualtime<br>"; 
?>
<form name="form" method="POST" action="vetDatesAvailablePart3.php">
     <input value="<?php echo $ID;?>" type="hidden" name="TimeID">
     <input value="<?php echo $newDate;?>" type="hidden" name="newDate">
     <input value="<?php echo $day;?>" type="hidden" name="newDay">

     <input value="<?php echo $actualtime;?>" type="hidden" name="TimeShift">
      <input value="<?php echo $VetName;?>" type="hidden" name="VetName">


     <input type="submit"  value="Add into Shifts">
  	   </form>

<?php

  }
elseif($canMake=='FALSE')
{
$over="FALSE";
   $queryCount="Select TimeID FROM DatesAvailable";
   $resultCount=mysqli_query($conn,$queryCount);
   $rows2=$resultCount->num_rows;
    $dupID=$duplicateID.$duplicate[0];

    $int=1;
    	for($x=0;$x<$rows2;$x++)
	{
		$rowI=mysqli_fetch_array($resultCount);
		$IDCheck=$rowI['TimeID'];
		if($dupID==$IDCheck)
		{
	    	     $pos=strpos($dupID,'E');
	    	 	if($pos!==false)
	    		{
	    	 	$over="TRUE";
	         	break;
	   	 	}
	   	 	else
	   	 	{
	   	 	$dupID=$duplicateID.$duplicate[$int];
	   	 	$int++;
	   	 	}
	   	 	
		}
		
	}


    if($over=="TRUE")
    {
     echo "|Error Message:Addition cannot be made|<br><br>";
    }
    elseif($over=="FALSE")
    {
    echo "Duplicate found! make an exception?<br>";
    echo "Exception ID: $dupID<br>";
    ?>
    

<form action="vetmenu.php">
    <input type="submit" value="Cancel Duplicate" />
</form>

<form name="form" method="POST" action="vetDatesAvailablePart3.php">
     <input value="<?php echo $dupID;?>" type="hidden" name="TimeID">
     <input value="<?php echo $newDate;?>" type="hidden" name="newDate">
     <input value="<?php echo $day;?>" type="hidden" name="newDay">

     <input value="<?php echo $actualtime;?>" type="hidden" name="TimeShift">
      <input value="<?php echo $VetName;?>" type="hidden" name="VetName">


     <input type="submit"  value="Continue with duplicate">
  	   </form>





    <?php

    }
  
    


}
  

$resultCount->close();
 $result2->close();
$conn->close();
?>

<form action="vetmenu.php">
    <input type="submit" value="Return to menu" />
</form>
<div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
</body>
</html>