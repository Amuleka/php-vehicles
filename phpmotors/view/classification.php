<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>

<h1><?php echo $classificationName; ?> Vehicles</h1>

<?php if(isset($message)){
 echo $message; }
 ?>

<?php if(isset($vehicleDisplay)){
 echo $vehicleDisplay;
} ?>


<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>