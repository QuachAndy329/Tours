
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
</head>
<body>
    
</body>
</html>

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
<body>
