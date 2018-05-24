<?php
require_once 'vet_sessioncontrol.php';
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="style.css"> 
   	        <link rel="stylesheet" type="text/css" href="clientformstyle.css">
                <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script>

	function myFunction() {
  
    		 document.getElementById("a1").style.backgroundColor = "black";
			}
	</script>

		<!-- Website CSS style -->
		

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
	

		<title>Vet Detail Form, Part 2</title>
	</head>
	<body>
	    
<div class="header">
<p><img src="images/homevetfinder.png" alt="Picture of a dog and cat" /></p>
<h1>Vet Form Part 2</h1>
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
		<div class="container">
		<div class="login-register">
	
		 </div>
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		
					
	               		
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="vetdetail_process2.php">
						<h2 class="title">Please enter your information below: </h2>
						<div class="form-group">
							<label for="inputLocation" class="col-sm-2 control-label">Location</label>
								<div class="col-md-4">
									<select id="inputLocation" class="form-control">
										<option disabled selected value>Location</option>
										<option>Eastern Nassau</option>
										<option>Western Nassau</option>
										<option>Eastern Suffolk</option>
										<option>Western Suffolk</option>
									</select>
								</div>
						</div>
						
						<div class="form-group">
							<label for="inputInsurance" class="col-md-2 control-label">Insurance Accepted</label>
								<div class="col-md-4">
									<select id="inputInsurance" class="form-control">
										<option disabled selected value>Insurance</option>
										<option>ASPCA</option>
										<option>Nationwide</option>
										<option>Pet Plan</option>
										<option>Healthy Paws</option>
										<option>Trupanion</option>
									</select>
								</div>
						</div>
						 
						 
				
						
						 <div class="form-group ">
							<button type="button" class="btn btn-primary btn-lg btn-block login-button">Submit</button>
						</div>
			
						
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<div class="footer"> 
<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>   
	</body>
</html>