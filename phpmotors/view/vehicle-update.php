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
    } elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
         $classificationList .= ' selected ';
        }
    }                
    $classificationList .= ">$classification[classificationName]</option>";
}
    $classificationList .= '</select>';

?><?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>

<h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	 echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?></h1><br>
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
            <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br><br>
            <label for="invModel">Model </label><br>
            <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br><br>
            <label for="invDescription">Description </label><br>
            <textarea name="invDescription" id="invDescription" rows="4" cols="30" required><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br>
            <label for="invImage">Image </label><br>
            <input type="text" id="invImage" name="invImage" required <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>><br><br>
            <label for="invThumbnail">Thumbnail </label><br>
            <input type="text" id="invThumbnail" name="invThumbnail" <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>><br><br>
            <label for="invPrice">Price </label><br>
            <input type="text" id="invPrice" name="invPrice" <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>><br><br>
            <label for="invStock">Stock </label><br>
            <input type="text" id="invStock" name="invStock" <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>><br><br>
            <label for="invColor">Color </label><br>
            <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>><br><br>

            <!-- Add the action name - value pair -->

            <input type="submit" id="submit" value="Update Vehicle"><br>
            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="
            <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
            elseif(isset($invId)){ echo $invId; } ?>
            ">

        </form>




<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>  