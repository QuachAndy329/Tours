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

<div class="containers" id="locationList" style="padding-left:16px">

    <div class = "locButtons">
    <br>
    <button onclick="window.location.href='addentry.php';">New</button>
    <button id="dupLocation" type="button">Duplicate</button>
    </div>
    <br>
    <p>table here</p>

    <table>
    <thead>
        <tr>
            <th>Number</th>
            <th>Name</th>
            <th>Coordinates</th>
            <th>Description</th>
            <th>Min Time</th>
            <th> </th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
        <?php
printlocations();

        ?>
    </tbody>
    </table>

</div>

</body>
</html>
<script src="tour.js"></script>
