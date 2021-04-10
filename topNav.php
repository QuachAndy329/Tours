
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link id='stylecss' type="text/css" rel="stylesheet" href="style.css">
<div class="topbar">
    <h1>Logo Name</h1>
    </div>

    <div class="topnav">
  <a  href="Home.php">Home</a>
  <a href="location.php">Location</a>
  <a href="tour.php">Tour</a>
  <a href="#data">Data</a>
<a href="#contact">Contact</a>
    <a href="#settings">Settings</a>
        <?php
        if($_SESSION['Type'] == 0){
   echo "<a href='user.php'>Users</a>";
        }
        ?>
    <a href="login.php">Sign Out</a>
</div>

</head>


