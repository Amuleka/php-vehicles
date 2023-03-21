<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><?php
// Build the select list
$classificationList = '<select name="classificationId">';
$classificationList .= '<option>Please select an option </option>';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)) {
        if($classification['classificationId'] == $classificationId) {
                    $classificationList .= ' selected ';
        }
    }
                    
    $classificationList .= ">$classification[classificationName]</option>";
}
    $classificationList .= '</select>';

?><?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>

<h1>Add Vehicle</h1><br>
<?php
// Check to see if a variable message exists to display it
if (isset($message)) {
    echo $message;
}
?>
        <form class="form" action="/phpmotors/vehicles/index.php" method="post">
            <?php 
                if (!empty($classificationList)){
                    echo $classificationList;
                } 
            ?><br><br>
            <label for="invMake">Make </label><br>
            <input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";}  ?> required><br><br>
            <label for="invModel">Model </label><br>
            <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";}  ?> required><br><br>
            <label for="invDescription">Description </label><br>
            <textarea name="invDescription" id="invDescription" rows="4" cols="30" required><?php if(isset($invDescription)){ echo $invDescription; } ?></textarea><br>
            <label for="invImage">Image </label><br>
            <input type="text" id="invImage" name="invImage" placeholder="/phpmotors/images/upgrades/no-image.php" <?php if(isset($invImage)){echo "value='$invImage'";}  ?> required><br><br>
            <label for="invThumbnail">Thumbnail </label><br>
            <input type="text" id="invThumbnail" name="invThumbnail" placeholder="/phpmotors/images/upgrades/no-image.php" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> required><br><br>
            <label for="invPrice">Price </label><br>
            <input type="text" id="invPrice" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required><br><br>
            <label for="invStock">Stock </label><br>
            <input type="text" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> required><br><br>
            <label for="invColor">Color </label><br>
            <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";}  ?> required><br><br>

            <!-- Add the action name - value pair -->

            <input type="submit" id="submit" value="Register"><br>
            <input type="hidden" name="action" value="vehicle">

        </form>




<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>  