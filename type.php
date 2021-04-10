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
    $db->query("DELETE FROM `tour types` WHERE `tour types`.`Id` = '$removeId'");
    $_POST['removeId'] = '';
}

include 'typeFunctions.php';

     ?>

<!DOCTYPE html>
<html>
<?php
include 'topNav.php';
?>
<body>

<div class="containers" id="tourList" style="padding-left:16px">

    <div class = "locButtons">
    <br>
    <button onclick="window.location.href='addtype.php';">New</button>
    <button onclick="window.location.href='tour.php';">back</button>
    </div>
    <br>
    <p>table here</p>

    <table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Type</th>
            <th> </th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
        <?php
printtype();

        ?>
    </tbody>
    </table>

</div>

</body>
</html>
<script src="tour.js"></script>
