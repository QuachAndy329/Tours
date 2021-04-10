<?php

//print locations from the database
function printtour() {
    global $db;
            $stmt = $db->query("SELECT * FROM `tour`");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            echo '<td>' . $row['Id'] . '</td>';
            echo '<td>' . $row['Name'] . '</td>';
            echo '<td>' . $row['Type'] . '</td>';
            echo '<td>' . $row['min'] . '</td>';
            if($_SESSION['Type'] == 0){
            echo '<td>' . '<form action="addtour.php" method="post">';
            echo '<input name="editId" type="hidden" value="'.$row['Id'].'"/>';
            echo '<input name="Edit" type="submit" value="Edit"/> </form> </td>';
            echo '<td>' . '<form action="tour.php" method="post">';
            echo '<input name="removeId" type="hidden" value="'.$row['Id'].'"/>';
            echo '<input name="Remove" type="submit" value="Remove"/> </form> </td>';
            }
            echo '</tr>';
        }
}

//get information of the location being edited from database so form fields can be prefilled
function getFromDatabase(){
    global $db;
    global $newName;
    global $newType;
    global $newmin;
if(isset($_POST['editId'])){
    $_SESSION['editId'] = $_POST['editId'];
    $editId = $_POST['editId'];
    $stmt = $db->query("SELECT * FROM `tour` WHERE `Id` = '$editId'");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $newName = $row['Name'];
        $newType = $row['Type'];
        $newmin = $row['min'];
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
    global $newName;
    global $newType;
    global $newmin;
    
global $errorMassage;
if(isset($_POST["submit"])) {
    if(empty($_POST["newName"])) {

        $errorMessage .= '<p><label class="text-danger">
            Please enter a name. </label></p>';
    }
    else {
        $newName = trim_content($_POST["newName"]);
    }

    if(empty($_POST["newType"])) {
        $errorMessage .= '<p><label class="text-danger">
            Please enter Type. </label></p>';
    }
    else {
        $newType = trim_content($_POST["newType"]);
    }


    if(empty($_POST["newmin"])) {
        $errorMessage .= '<p><label class="text-danger">
            Please enter Minute. </label></p>';
    }
    else {
        $newmin = trim_content($_POST["newmin"]);
    }

}
}

//write new information to the database
function writeToDatabase() {
    global $db;
    global $newName;
    global $newType;
    global $newmin;
global $errorMessage;

    if($errorMessage == '')
    {

        if(!empty($_SESSION['editId'])){
            $editId = $_SESSION['editId'];
            echo $editId;
            echo "UPDATE `tour` SET `Name` = '$newName', `Type` = '$newType', `Time` = '$newmin' WHERE `tour`.`Id` = '$editId'";
            $db->query("UPDATE `tour` SET `Name` = '$newName', `Type` = '$newType', `Time` = '$newmin' WHERE `tour`.`Id` = '$editId'");
            $_SESSION['editId'] = '';
        }
        else{
            $db->query("INSERT INTO `tour` (`Name`, `Type`, `min`) VALUES ('$newName', '$newType', '$newmin')");
        }

        $errorMessage = '<label class="text-success">Input Success</label>';

        $newName = '';
        $newType = '';
        $newmin = '';
    }
}




?>
