<?php
     session_start();

$dsn = "mysql:host=localhost;dbname=tour";
$username = "root";
$password = "";
try{
    $db = new PDO($dsn, $username, $password);
    echo "You have connected!";
}catch(PDOException $e){
    $error_message = $e->getMessage();
    exit();
}

set_error_handler("myConsoleLog");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function myConsoleLog($errnum, $errmsg){
    echo
        "<script>
        console.log('PHP Error #$errnum: $errmsg');
        </script>";
}
//Check if there is a location to be removed
if(!empty($_POST['removeId'])){
    $removeId = $_POST['removeId'];
    $db->query("DELETE FROM `locations` WHERE `locations`.`Id` = '$removeId'");
    $_POST['removeId'] = '';
} 

include 'locationFunctions.php';

     ?>

<!DOCTYPE html>
<html>
<?php
include 'topNav.php';
?>
  <head>
    <!-- <link type="text/css" rel="stylesheet" href="loginStyle.css"> -->
    <title>Contact Us</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
  </head>


  <body>

<div class="row">
  <div class="col-xs-6 col-md-1"></div>

  <div class="col-xs-6 col-md-10">
  <h1 class="text-center">Contact Us!</h1>
  
  <hr class="style1">

  <div class="row">
      <div class="col-xs-8 col-sm-6">
        <p class="text-right">For account issues please contact<p>
      </div>
      <div class="col-xs-4 col-sm-6">
      
        <p>Email: super_admin@gmail.com</p>
        <p>Phone: 1234567890</p>

      </div>
    </div>

    <div class="row">
      <div class="col-xs-8 col-sm-6">
        <p class="text-right">For basic queries please contact<p>
      </div>
      <div class="col-xs-4 col-sm-6">
      
        <p>Email: query_master@yahoo.com</p>
        <p>Phone: 0987654321</p>

      </div>
    </div>
    <hr class="style1">
  </div>

  <div class="col-xs-6 col-md-1"></div>


</div>
  </body>
</html>
