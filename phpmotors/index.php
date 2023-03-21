<?php 
// This is the main controller
ini_set('display_errors', 1);
// Create or access a Session
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the PHP Motors email function for use as needed
require_once 'library/functions.php';

// include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';

// include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);


$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
   $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

 switch ($action){
 case 'something':
    break;
 
 default:
     include 'view/home.php';
     break;

}

?>



