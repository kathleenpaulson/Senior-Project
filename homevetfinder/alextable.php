<!--I certify that this submission is my own original work.  Kathleen Paulson-->
<?php
require_once 'login.php';
require_once 'sessioncontrol.php';

  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $query  = "SELECT * FROM book";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>List Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="bookstyles.css">
    
</head>

<body>

<div class="header">
  <p><img src="images/Pages_logo.png" alt="Pages Bookstore Logo"/></p>
</div>

<div class="topnav">
  <a href = "logout.php">Log Out</a>
  <a href = "mainmenu.php">Main Menu</a>
</div>
    
    <div class="center2">
    <p style="color: grey;" class="center">This page shows a list of all of our books currently for sale.</p>
    <br>    
    </div>
    
<?php
    
    echo "<table id=\"books\"> <tr> <th>ISBN</th> <th>Title</th> <th>Author</th> <th>Publisher</th> <th>Publication Date</th> <th>Price (in USD$)</th> </tr>";

    for ($j = 0 ; $j < $rows ; ++$j)
    {
        $result->data_seek($j);
  	$row = $result->fetch_array(MYSQLI_NUM);
       
  	echo "<tr>"; 	        
        echo "<td>$row[0]</td>";
        echo "<td>$row[1]</td>";
        
        $query_author  = "SELECT * FROM author where author_id = $row[2]";
        $result_author = $conn->query($query_author);
        if (!$result_author) 
        {
            die ("Database access failed: " . $conn->error);
        }
        else 
        {
            $author_row = $result_author->fetch_array(MYSQLI_NUM);
            echo "<td>$author_row[2] $author_row[1] </td>";
        }
        
        $query_publisher  = "SELECT * FROM publisher where publisher_id = $row[3]";
        $result_publisher = $conn->query($query_publisher);
        
        if (!$result_publisher) 
        {
            die ("Database access failed: " . $conn->error);
        }
        else 
        {
            $publisher_row = $result_publisher->fetch_array(MYSQLI_NUM);
            echo "<td>$publisher_row[1]</td>";            
        }
        
        echo "<td>$row[4]</td>";
        echo "<td>$row[5]</td>";
        
        echo "<tr>"; 
        
    }      
    echo "</table>";
    
?>

    
<footer>
<p>
    Pages Bookstore &bull; 22 East Main Street &bull; Port Jefferson, NY 11777
</p>
</footer>
    
    
  </body>
</html>



