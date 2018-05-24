
<?php
session_start();
if(!(isset($_SESSION['username'])))
{
    header("Location: index.html");
    exit();
}

if ($_SESSION['loggedin'] == "V")
{
    header("Location: index.html");
}
?>

