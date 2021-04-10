<?php

//print locations from the database
function printLocations() {
    global $db;
            $stmt = $db->query("SELECT * FROM `locations`");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            echo '<td>' . $row['Id'] . '</td>';
            echo '<td>' . $row['Name'] . '</td>';
            echo '<td>' . $row['Coordinates'] . '</td>';
            echo '<td>' . $row['Description'] . '</td>';
            echo '<td>' . $row['Time'] . '</td>';
            if($_SESSION['Type'] == 0){
            echo '<td>' . '<form action="addentry.php" method="post">';
            echo '<input name="editId" type="hidden" value="'.$row['Id'].'"/>';
            echo '<input name="Edit" type="submit" value="Edit"/> </form> </td>';
            echo '<td>' . '<form action="location.php" method="post">';
            echo '<input name="removeId" type="hidden" value="'.$row['Id'].'"/>';
            echo '<input name="Remove" type="submit" value="Remove"/> </form> </td>';
            }
            echo '</tr>';
        }
}

//get information of the location being edited from database so form fields can be prefilled
function getFromDatabase(){
    global $db;
    global $newLocationName;
    global $newCoordinates;
    global $newDescription;
    global $newTime;
if(isset($_POST['editId'])){
    $_SESSION['editId'] = $_POST['editId'];
    $editId = $_POST['editId'];
    $stmt = $db->query("SELECT * FROM `locations` WHERE `Id` = '$editId'");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $newLocationName = $row['Name'];
        $newCoordinates = $row['Coordinates'];
        $newDescription = $row['Description'];
        $newTime = $row['Time'];
    }
}
}



function trim_content($string_input)
{
    $string_input = trim($string_input);
    $string_input = stripslashes($string_input);
    $string_input = htmlspecialchars($string_input);
    return $string_input;
}

function varifyInputs() {
    global $db;
    global $newLocationName;
    global $newCoordinates;
    global $newDescription;
    global $newTime;
global $errorMassage;
if(isset($_POST["submit"])) {
    if(empty($_POST["newName"])) {

        $errorMessage .= '<p><label class="text-danger">
            Please enter a name. </label></p>';
    }
    else {
        $newLocationName = trim_content($_POST["newName"]);
    }

    if(empty($_POST["newCoordinates"])) {
        $errorMessage .= '<p><label class="text-danger">
            Please enter coordinates. </label></p>';
    }
    else {
        $newCoordinates = trim_content($_POST["newCoordinates"]);
    }

    if(empty($_POST["newDescription"])) {
        $errorMessage .= '<p><label class="text-danger">
            Please enter Description. </label></p>';
    }
    else {
        $newDescription = trim_content($_POST["newDescription"]);
    }

    if(empty($_POST["newTime"])) {
        $errorMessage .= '<p><label class="text-danger">
            Please enter Min Time. </label></p>';
    }
    else {
        $newTime = trim_content($_POST["newTime"]);
    }

}
}

//write new information to the database
function writeToDatabase() {
     global $db;
    global $newLocationName;
    global $newCoordinates;
    global $newDescription;
    global $newTime;
global $errorMessage;

    if($errorMessage == '')
    {

        if(!empty($_SESSION['editId'])){
            $editId = $_SESSION['editId'];
            echo $editId;
            echo "UPDATE `locations` SET `Name` = '$newLocationName', `Coordinates` = '$newCoordinates', `Description` = '$newCoordinates', `Time` = '$newTime' WHERE `locations`.`Id` = '$editId'";
            $db->query("UPDATE `locations` SET `Name` = '$newLocationName', `Coordinates` = '$newCoordinates', `Description` = '$newDescription', `Time` = '$newTime' WHERE `locations`.`Id` = '$editId'");
            $_SESSION['editId'] = '';
        }
        else{
            $db->query("INSERT INTO `locations` (`Name`, `Coordinates`, `Description`, `Time`) VALUES ('$newLocationName', '$newCoordinates', '$newDescription', '$newTime')");
        }

        $errorMessage = '<label class="text-success">Input Success</label>';

        $newLocationName = '';
        $newLocationX = '';
        $newLocationY = '';
        $newDescription = '';
        $newCoordinates = '';
        $newTime = '';
    }
}




?>
