<html>
    <head>
        <title>Vet Sign Up Form</title>
  	 <link rel="stylesheet" type="text/css" href="style.css"> 
    	 <link rel="stylesheet" type="text/css" href="clientloginstyle.css">	
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
  $connection = new mysqli($hn, $un, $pw, $db);
  if ($connection->connect_error) die($connection->connect_error); 

  $username = $password = $confirmpwd = "";

  if (isset($_POST['username']))
    $username = fix_string($_POST['username']);
  if (isset($_POST['password']))
    $password = fix_string($_POST['password']);
  if (isset($_POST['confirmpwd']))
    $confirmpwd    = fix_string($_POST['confirmpwd']);

  $fail  = validate_username($username);
  $fail .= validate_password($password);
  $fail .= validate_confirmpwd($password, $confirmpwd);
  
  echo "<!DOCTYPE html>\n<html><head><title>Create Vet Account Form</title>";
  
  if ($fail == "")
  {
  	$fail_useradd = add_user($connection, $username, $password);
  	if ($fail_useradd == "") 
  	{
  	$vet = "V";     
  	session_start();
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['loggedin'] = $vet;
echo <<<_END
	    <style>      
	      .collapse {          
	       border-collapse: collapse;
	       }
	       
	       .center {
	           text-align: center; 
	       }
	       
	       div.border { border-bottom: 1px solid #000; }       
	    </style>
	    </head>
	    <body>
	    <div>
	        <p class="center"><IMG SRC="images/doctordog.gif"></p>
	        <br><br>
	        <<br><br>	        
	    </div>
	    <h3 class="center"><a href="vetdetail_form.php">Click here to complete your registration.</a></h3>
	    
	    </body>
	    </html>

_END;

    		exit;
  	}
  
  }
  
echo <<<_END

    <!-- The HTML/JavaScript section -->

    <style>
      
      .collapse {          
       border-collapse: collapse;
       }
       
       .center {
           text-align: center; 
       }
       
       div.border { border-bottom: 1px solid #000; }
       
    </style>

    <script>
      function validate(form)
      {
        fail += validateUsername(form.username.value)
        fail += validatePassword(form.password.value)
        fail += validateConfirmpwd(form.password.value, form.confirmpwd.value)        
      
        if (fail == "")     return true
        else { alert(fail); return false }
      }

      function validateUsername(field)
      {
        if (field == "") 
        {
            return "No Username was entered.\n";
        }
        else 
        {
          if (field.length < 6)
          {
              return "Usernames must be at least 6 characters.\n";
          }
          if (/[^a-zA-Z0-9_-]/.test(field))
          {
              return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n";
          }          
        }        
        return "";
      }

      function validatePassword(field)
      {
        if (field == "") 
        {
            return "No Password was entered.\n"
        }
        else 
        {
          if (field.length < 8)
          {
              return "Passwords must be at least 8 characters.\n";
          }
          if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||
                 !/[0-9]/.test(field))
          {
              return "Passwords require at least one each of a-z, A-Z and 0-9.\n";
          }          
        }          
      return "";
      }
      
      function validateConfirmpwd(pwd, confirmpwd)
      {
        if (field == "") 
        { 
            return "No confirm password was entered.\n";
        }
        else if (pwd !== confirmpwd)
        {
            return "Password and confirm password do not match.\n";
        }          
        return ""
      }

      
      return "";
      }
    </script>
  </head>
  <body>
    
  <p>Please fill in this form to create an account.</p>

    <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
    <th colspan="2" align="center">Create Account Form</th>
_END;
      if (isset($_POST['submit']))
      { 
          echo"<tr>";
          echo"<td colspan=\"2\">Sorry, the following errors were found";
          echo" in your form: <p><font color=red size=1><i>$fail</i></font></p></td></tr>";
      }
echo <<<_END

      <form method="post" action="vetsignup.php" onSubmit="return validate(this)">
      
        <tr>
            <td><label for="username"><b>User Name</b></label></td>
            <td><input type="text" maxlength="16" name="username" value="$username" required><br></td>
        </tr>          
        <tr>       
            <td><label for="password"><b>Password</b></label></td>
            <td><input type="password" maxlength="12" 
            name="password" value="$password" required></td>
        </tr>
        <tr>
            <td><label for="confirmpwd"><b>Confirm Password</b></label></td>
            <td><input type="password" maxlength="12" 
            name="confirmpwd" value="$confirmpwd" required></td>        
        </tr>    
        <tr class = "collapse">    
            <td><input type="submit" name = "submit" value="Submit"></td>
            <td><input type="reset" value="Reset"></td>
        </tr>
      </form>
    </table>
    <div class="footer"> 

<div> <h4>Copyright &copy;2018 Home Vet Finder, Inc., 22 Happy Cat Way, Islip, New York 11554 (631) 555-1212</h4> </div>
 </div>
  </body>
</html>

_END;

  // The PHP functions

  function validate_username($field)
  {
    if ($field == "") 
    {
        return "No Username was entered<br>";
    }
    else 
    {
        if (strlen($field) < 6)
        {
            return "Usernames must be at least 6 characters<br>";
        }
        if (preg_match("/[^a-zA-Z0-9_-]/", $field))
        {
            return "Only letters, numbers, - and _ in usernames<br>";
        }
    }
    return "";		
  }
  
  function validate_password($field)
  {
    if ($field == "") 
    {
        return "No Password was entered<br>";
    }
    else 
    {
        if (strlen($field) < 8)
        {
            return "Passwords must be at least 8 characters<br>";
        }
        if (!preg_match("/[a-z]/", $field) ||
             !preg_match("/[A-Z]/", $field) ||
             !preg_match("/[0-9]/", $field))
             {
                 return "Passwords require at least one each of a-z, A-Z and 0-9<br>";
             }
    }
    return "";
  }
  
  function validate_confirmpwd($pwd, $conf_pwd)
  {
    if ($conf_pwd == "") return "No confirm password was entered<br>";
    else if ($pwd !== $conf_pwd)
      return "Password and confirm password do not match.<br>";
    return "";
  }
  
  
  
  function fix_string($string)
  {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities ($string);
  }
  
  function add_user($conn, $username, $password)
  {
    $salt1 = bin2hex(openssl_random_pseudo_bytes(5));
    $salt2 = bin2hex(openssl_random_pseudo_bytes(5));  
    $token = hash('sha256', "$salt1$password$salt2"); 
    
    $query = "INSERT INTO accountInfo (username, salt1, salt2, password)
    VALUES ('$username', '$salt1', '$salt2', '$token')";
            
    if ($conn->query($query) === TRUE) 
      {
            return "";
      } 
    else 
      {
            return ("Add user $username was not successful: ");
      }   
  } 
?>

