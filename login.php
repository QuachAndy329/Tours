<?php
session_start();
//connect to the data base
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

//error handler
set_error_handler("myConsoleLog");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//error reporting
function myConsoleLog($errnum, $errmsg){
    echo
        "<script>
        console.log('PHP Error #$errnum: $errmsg');
        </script>";
}

$_SESSION['Id'] = '';
$_SESSION['Type'] = '';

function user_auth($username, $password) {
    global $db;
  $stmt = $db->query("SELECT * FROM `login` WHERE `Username` = '$username'");
    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       // echo $row['Id']. '<br>'. $row['Password'];
        if($row['Password'] == $password) {
            $_SESSION['Id'] = $row['Id'];
            $_SESSION['Type'] = $row['Type'];
            header("Location: location.php");
        }
        else {
            echo "Wrong password";
        }
    }
    else {
        echo "User does not exist!";
    }
    //return $result;
    //return true;
}

if (empty($_POST) == false) {

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        user_auth($_POST['username'], $_POST['password']);
    }
    else {
        echo "username and password cannot be empty";
    }

}


?>

<!DOCTYPE html>
<html>
  <head>
    <link type="text/css" rel="stylesheet" href="style.css">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }
    </style>

  </head>
  <body>
      <?php
    //  echo user_exists("Aemon");
      ?>
    <div class="container">

      <form action="login.php" method="post">
           <label>Username:
                 <input name="username" id="username" type="text"/>
            </label>
          <br>
          <label>Password:
                 <input name="password" id="password" type="password"/>
            </label>
        <div> <label>
                 <input name="Login" id="SB" type="submit" value="Log in"/>
            </label></div>

      </form>
    </div>
  </body>
</html>
