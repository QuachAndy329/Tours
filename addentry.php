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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$errorMessage = '';
$newLocationName = '';
$newCoordinates = '';
$newDescription = '';
$newTime = '';

include 'locationFunctions.php';

//get information of the location being edited from database so form fields can be prefilled
getFromDatabase();

//check inputs
varifyInputs();

//write new information to the database
if(isset($_POST['submit'])){
writeToDatabase();
}

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
            <button onclick="window.location.href='location.php';">Go Back</button>
        </div>

        <h2>New Location</h2>
        <br>

        <form method="post">
            <?php echo $errorMessage; ?>

            <p>Name: <input type="text" name="newName" value="<?php echo $newLocationName; ?>"></p>
            <p>Coordinates: <input type="text" name="newCoordinates" value="<?php echo $newCoordinates; ?>"></p>
            <p>Description: <input type="text" name="newDescription" value="<?php echo $newDescription; ?>"></p>
            <p>Min Time: <input type="test" name="newTime" value="<?php echo $newTime; ?>"></p>
            <br>
            <br>

            <input type="submit" name="submit">
        </form>
    </div>

</body>
</html>
<script src="tour.js"></script>
