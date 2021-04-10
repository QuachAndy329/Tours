<?php

//print locations from the database
function printUsers() {
    global $db;
            $stmt = $db->query("SELECT * FROM `login`");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            echo '<td>' . $row['Id'] . '</td>';
            echo '<td>' . $row['Username'] . '</td>';
            echo '<td>' . $row['Type'] . '</td>';
            if($_SESSION['Type'] == 0){
            echo '<td>' . '<form action="adduser.php" method="post">';
            echo '<input name="editId" type="hidden" value="'.$row['Id'].'"/>';
            echo '<input name="Edit" type="submit" value="Edit"/> </form> </td>';
            echo '<td>' . '<form action="user.php" method="post">';
            echo '<input name="removeId" type="hidden" value="'.$row['Id'].'"/>';
            echo '<input name="Remove" type="submit" value="Remove"/> </form> </td>';
            }
            echo '</tr>';
        }
}

//get information of the location being edited from database so form fields can be prefilled
function getFromDatabase(){
    global $db;
    global $newUserName;
if(isset($_POST['editId'])){
    $_SESSION['editId'] = $_POST['editId'];
    $editId = $_POST['editId'];
    $stmt = $db->query("SELECT * FROM `login` WHERE `Id` = '$editId'");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $newUserName = $row['Username'];
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
    global $newUserName;
    global $newPassword;
    global $newType;
global $errorMassage;
if(isset($_POST["submit"])) {
    if(empty($_POST["newName"])) {

        $errorMessage .= '<p><label class="text-danger">
            Please enter a name. </label></p>';
    }
    else {
        $newUserName = trim_content($_POST["newName"]);
    }

    if(empty($_POST["newPassword"])) {
        $errorMessage .= '<p><label class="text-danger">
            Please enter password. </label></p>';
    }
    else {
        $newPassword = trim_content($_POST["newPassword"]);
    }

    if(empty($_POST["newType"])) {
        $errorMessage .= '<p><label class="text-danger">
            Please select type. </label></p>';
    }
    else {
        $newType = $_POST["newType"];
    }

}
}

//write new information to the database
function writeToDatabase() {
     global $db;
    global $newUserName;
    global $newPassword;
    global $newType;
global $errorMessage;

    if($errorMessage == '')
    {

        if(!empty($_SESSION['editId'])){
            $editId = $_SESSION['editId'];
            echo $editId;
            echo "UPDATE `login` SET `Username` = '$newUserName', `Password` = '$newPassword', `Type` = '$newType' WHERE `login`.`Id` = '$editId'";
            $db->query("UPDATE `login` SET `Username` = '$newUserName', `Password` = '$newPassword', `Type` = '$newType' WHERE `login`.`Id` = '$editId'");
            $_SESSION['editId'] = '';
        }
        else{
            $db->query("INSERT INTO `login` (`Username`, `Password`, `Type`) VALUES ('$newUserName', '$newPassword', '$newType')");
        }

        $errorMessage = '<label class="text-success">Input Success</label>';

        $newUserName = '';
        $newPassword = '';
        $newType = '';
    }
}




?>
