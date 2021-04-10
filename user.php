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

$userId = $_SESSION['Id'];
$stmt = $db->query("SELECT * FROM `login` WHERE `login`.`Id` = '$userId'");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
if($row['Type'] == 1){
    echo '<script language="javascript">';
echo 'alert("message successfully sent")';
echo '</script>';
    header("Location: location.php");

}
}

//Check if there is a location to be removed
if(!empty($_POST['removeId'])){
    $removeId = $_POST['removeId'];
    $db->query("DELETE FROM `login` WHERE `login`.`Id` = '$removeId'");
    $_POST['removeId'] = '';
}

include 'userFunctions.php';

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
    <button onclick="window.location.href='adduser.php';">New</button>
    </div>
    <br>
    <p>table here</p>

    <table>
    <thead>
        <tr>
            <th>Number</th>
            <th>Name</th>
            <th>Type</th>
            <th> </th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
        <?php
        //print locations to the screen
        printUsers();
        ?>
    </tbody>
    </table>

</div>

</body>
</html>
<script src="tour.js"></script>
