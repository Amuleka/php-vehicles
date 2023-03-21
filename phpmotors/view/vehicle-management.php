<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>

        <h1>Vehicle Management</h1>
        <ul>
            <li><a id="add-classification" href="/phpmotors/vehicles/index.php?action=add-classification">Add Classification</a></li>
            <li><a id="add-vehicle" href="/phpmotors/vehicles/index.php?action=add-vehicle">Add Vehicle</a></li>
        </ul><br>
        <?php
            if (isset($message)) { 
                echo $message; 
            } 
            if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2><br>'; 
                echo '<p>Choose a classification to see those vehicles</p><br>'; 
                echo $classificationList; 
            }
        ?>
        <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>
        <table id="inventoryDisplay"></table>


<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>
<?php unset($_SESSION['message']); ?>