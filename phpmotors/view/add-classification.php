<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>

<h1>Add Car Classification</h1><br>

 <?php
// Check to see if a variable message exists to display it
if (isset($message)) {
    echo $message;
}
?>

        <form class="form" action="/phpmotors/vehicles/index.php" method="post">
            <label for="classificationName">Classification Name </label><br>
            <span>The limit for the Car Classification is 30 characters</span><br>
            <input type="text" id="classificationName" name="classificationName" maxlength="30" <?php if(isset($classificationName)){echo "value='$classificationName'";}  ?>  required><br><br>
            <!-- Add the action name - value pair -->
             <input type="hidden" name="action" value="add-classification">
             <input type="submit" id="submit" value="Add Classification"><br>
        </form>


<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>