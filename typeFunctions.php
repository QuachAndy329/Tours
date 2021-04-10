<?php

//print locations from the database
function printtype() {
    global $db;
            $stmt = $db->query("SELECT * FROM `tour types`");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            echo '<td>' . $row['Id'] . '</td>';
            echo '<td>' . $row['Type'] . '</td>';
            if($_SESSION['Type'] == 0){
            echo '<td>' . '<form action="addtype.php" method="post">';
            echo '<input name="editId" type="hidden" value="'.$row['Id'].'"/>';
            echo '<input name="Edit" type="submit" value="Edit"/> </form> </td>';
            echo '<td>' . '<form action="type.php" method="post">';
            echo '<input name="removeId" type="hidden" value="'.$row['Id'].'"/>';
            echo '<input name="Remove" type="submit" value="Remove"/> </form> </td>';
            }
            echo '</tr>';
        }
}

//get information of the location being edited from database so form fields can be prefilled
function getFromDatabase(){
    global $db;
    global $newType;
if(isset($_POST['editId'])){
    $_SESSION['editId'] = $_POST['editId'];
    $editId = $_POST['editId'];
    $stmt = $db->query("SELECT * FROM `tour types` WHERE `Id` = '$editId'");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
        $newType = $row['Type'];
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
    global $newType;
    
global $errorMassage;

    if(empty($_POST["newType"])) {
        $errorMessage .= '<p><label class="text-danger">
            Please enter Type. </label></p>';
    }
    else {
        $newType = trim_content($_POST["newType"]);
    }


}

//write new information to the database
function writeToDatabase() {
    global $db;
    global $newType;
global $errorMessage;

    if($errorMessage == '')
    {

        if(!empty($_SESSION['editId'])){
            $editId = $_SESSION['editId'];
            echo $editId;
            echo "UPDATE `tour types` SET  `Type` = '$newType' WHERE `tour types`.`Id` = '$editId'";
            $db->query("UPDATE `tour types` SET `Type` = '$newType' WHERE `tour types`.`Id` = '$editId'");
            $_SESSION['editId'] = '';
        }
        else{
            $db->query("INSERT INTO `tour types` (`Type`) VALUES ('$newType')");
        }

        $errorMessage = '<label class="text-success">Input Success</label>';

       
        $$newType = '';


    }
}




?>
