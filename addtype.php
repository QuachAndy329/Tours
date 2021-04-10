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
$newType = '';



include 'typeFunctions.php';

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
            <button onclick="window.location.href='type.php';">Go Back</button>
        </div>

        <h2>New Type</h2>
        <br>

        <form method="post">
            <?php echo $errorMessage; ?>

           
            <p>Type: <input type="text" name="newType" value="<?php echo $newType; ?>"></p>
        
            <br>
            <br>

            <input type="submit" name="submit">
        </form>
    </div>
</body>
</html>
<script src="tour.js"></script>
