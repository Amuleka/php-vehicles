<?php 
ini_set('display_errors', 1);

// This is the accounts controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the PHP Motors account model for use as needed
require_once '../model/accounts-model.php';
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
 case 'login':
    include '../view/login.php';
     break;

 case 'register':
    include '../view/registration.php';
     break;

 case 'registerUser':

    // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    // Checking email and password functions from the functions page
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // Check for existing email
    $existingEmail = checkExistingEmail($clientEmail);

   // Check for existing email address in the table
   if($existingEmail){
      $message = '<p class="notice">That email address already exists. Do you want to login instead?</p><br>';
      include '../view/login.php';
      exit;
   }

   // Check for missing data
   if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
      $message = '<p>Please provide information for all empty form fields.</p><br>';
      include '../view/registration.php';
      exit;
   }

   // Hash the checked password
   $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

   // Send the data to the model
   $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

   // Check and report the result
   if($regOutcome === 1){
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.<br>";
      include '../view/login.php';
      exit;

   } else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
   }
      break;
   
case 'Login':
      // // Filter and store the data
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

      // Checking email and password functions from the functions page
      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);

      // Check for missing data
      if(empty($clientEmail) || empty($checkPassword)){
         $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p><br>';
         include '../view/login.php';
         exit;
      }

     
      // A valid password exists, proceed with the login process
      // Query the client data based on the email address
      $clientData = getClient($clientEmail);

      // Compare the password just submitted against
      // the hashed password for the matching client
      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
      
      // If the hashes don't match create an error
      // and return to the login view
      if(!$hashCheck) {
         $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
         include '../view/login.php';
         exit;
      }


      // A valid user exists, log them in
      $_SESSION['loggedin'] = TRUE;
      // Remove the password from the array
      // the array_pop function removes the last
      // element from an array
      array_pop($clientData);
      // Store the array into the session
      $_SESSION['clientData'] = $clientData;
      // Send them to the admin view
      include '../view/admin.php';
      exit;
      break;
      
   case 'admin':
      include '../view/admin.php' ;
      break;

   case 'Logout':
      session_destroy();
      header('Location: /phpmotors/accounts/?action=login');
      break;

   case "updateInfo":
      include "../view/client-update.php";
      break;

   case "updateAccount":
         // Filter and store the data
         $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
         $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
         $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
         $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

         // Check for existing email
         $existingEmail = checkExistingEmail($clientEmail);

         // Check for existing email address in the table
         if($existingEmail){
            $message = '<p class="notice">That email address already exists. Please use another email.</p><br>';
            include '../view/client-update.php';
            exit;
         }

         $updateClient = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);


         // Check and report the result
         if($updateClient){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $message = "<p>Thanks for updating your info $clientFirstname. Your information has been updated.</p><br>";
            $_SESSION['message'] = $message;
            $newClientData = getNewClient($clientId);

            array_pop($newClientData);
            // Store the array into the session
            $_SESSION['clientData'] = $newClientData;
            // header("Location: /phpmotors/accounts/");
            include '../view/admin.php';
            exit;

         } 
         else {
            $message = "<p>Sorry $clientFirstname, but the updated information failed. Please try again.</p><br>";
            include '../view/admin.php';
            exit;
         }

      
      break;

   case "updatePassword":

      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

      // Verify that the password meets the requirements
      $checkPassword = checkPassword($clientPassword);

      // Check for existing password in the table
      if(!$checkPassword){
         $message = '<p class="notice">Please check the password requirements</p><br>';
         include '../view/client-update.php';
         exit;
      }

      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

      $updateHaPassword = updatePassword($hashedPassword, $clientId);

      // Check and report the result
      if($updateHaPassword){
         $message = "<p>Thanks for updating your password. Your password has been saved.</p><br>";
         $_SESSION['message'] = $message;
         include '../view/admin.php';
         exit;
      } 
         else {
         $message = "<p>Sorry, but the updated password failed. Please try again.</p><br>";
         include '../view/admin.php';
         exit;
         }
      break;
 
 default:
     include '../view/admin.php';
     break;

}

?>



