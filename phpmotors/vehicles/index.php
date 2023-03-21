<?php
// Vehicles Controller
ini_set('display_errors', 1);
// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the PHP Motors account model for use as needed
require_once '../model/vehicles-model.php';
// Get the PHP Motors email function for use as needed
require_once '../library/functions.php';

// require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';

// require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);



$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 if(isset($_COOKIE['firstname'])){
   $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

switch ($action){
 case 'add-classification':
    include '../view/add-classification.php';
     break;

 case 'add-vehicle':
    include '../view/add-vehicle.php';
     break;

 case 'add-classification':

    // Filter and store the data
    $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

   // Check for missing data
   if(empty($classificationName)){
      $message = '<p>Please provide information for all empty form fields.</p><br>';
      include '../view/add-classification.php';
      exit;
   }

   // Send the data to the model
   $claOutcome = carClassification($classificationName);

   // Check and report the result
   if($claOutcome === 1){
    header('Refresh: 0.5');
      exit;

   } else {
      $message = "<p>Sorry, your $classificationName registration failed. Please try again.</p>";
      include '../view/add-registration.php';
      exit;
   }
      break;

    case 'vehicle':

        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
    
       // Check for missing data
       if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
          $message = '<p>Please provide information for all empty form fields.</p></br>';
          include '../view/add-vehicle.php';
          exit;
       }
    
       // Send the data to the model
       $vecOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
    
       // Check and report the result
       if($vecOutcome === 1){
          $message = "<p>Congratulations, the $invMake $invModel was successfully added.</p>";
          include '../view/add-vehicle.php';
          exit;
       } else {
          $message = "<p>Error. The new vehicle was not added.</p>";
          include '../view/add-vehicle.php';
          exit;
       }
          break;
   /* * ********************************** 
   * Get vehicles by classificationId 
   * Used for starting Update & Delete process 
   * ********************************** */ 
   case 'getInventoryItems': 
      // Get the classificationId 
      $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
      // Fetch the vehicles by classificationId from the DB 
      $inventoryArray = getInventoryByClassification($classificationId); 
      // Convert the array to a JSON object and send it back 
      echo json_encode($inventoryArray); 
      break;

   case 'mod':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if(count($invInfo)<1) {
         $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-update.php';
      break;

   case 'updateVehicle':

      $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
      $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
      $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

      if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
      $message = '<p>Please complete all information to update the item! Double check the classification of the item.</p>';
      include '../view/vehicle-update.php';
      exit;
      }

      $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);


      if ($updateResult) {
         $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p><br>";
         $_SESSION['message'] = $message;
         header('location: /phpmotors/vehicles/');
         exit;

      } else {
         $message = "<p>Error. The vehicle couldn't be updated.</p><br>";
         include '../view/vehicle-update.php';
         exit;
      }
      break;

   case 'del':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if(count($invInfo)<1) {
         $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-delete.php';
      break;

   case 'deleteVehicle':
      $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

      $deleteResult = deleteVehicle($invId);

      if ($deleteResult) {
         $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully deleted.</p><br>";
         $_SESSION['message'] = $message;
         header('location: /phpmotors/vehicles/');
         exit;

      } else {
         $message = "<p>Error. The vehicle couldn't be deleted.</p><br>";
         $_SESSION['message'] = $message;
         header('location: /phpmotors/vehicles/');
         exit;
      }
      break;

   case 'classification':

         $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
         $vehicles = getVehiclesByClassification($classificationName);
         if(!count($vehicles)){
          $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
         } else {
          $vehicleDisplay = buildVehiclesDisplay($vehicles);
         }
         include '../view/classification.php';
      break;

   case 'getInfo':

         $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
         $vehicle = getInvItemInfo($invId);

         if(!count($vehicle)){
          $message = "<p class='notice'>Sorry, no vehicle could be found.</p>";
          include '../view/vehicle-detail.php';

         } else {
          $buildVehicleInformation = buildVehiclesInformation($vehicle);
         }
         include '../view/vehicle-detail.php';
      break;
          
 default:

   $classificationList = buildClassificationList($classifications);
   include '../view/vehicle-management.php';
     break;

}

?>
