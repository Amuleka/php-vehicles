<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>

<?php if(isset($message)){
 echo $message; }
 ?>

<?php if(isset($buildVehicleInformation)){
 echo $buildVehicleInformation;
} ?>

<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>