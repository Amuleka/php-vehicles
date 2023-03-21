<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>

<h1><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1><br>
<?php
// Check to see if a variable message exists to display it
if (isset($message)) {
    echo $message;
}
?>
<p>Confirm Vehicle Deletion. The delete is permanent</p>
        <form class="form" action="/phpmotors/vehicles/index.php" method="post">
            <?php 
                if (!empty($classificationList)){
                    echo $classificationList;
                } 
            ?><br><br>
            <label for="invMake">Make </label><br>
            <input type="text" name="invMake" id="invMake" readonly <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br><br>
            <label for="invModel">Model </label><br>
            <input type="text" name="invModel" id="invModel" readonly <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br><br>
            <label for="invDescription">Description </label><br>
            <textarea name="invDescription" id="invDescription" readonly rows="4" cols="30" ><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br>

            <!-- Add the action name - value pair -->
            <input type="submit" id="submit" value="Delete Vehicle"><br>
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="
            <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
            ?>">

        </form>




<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>  