<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	    echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	  elseif(isset($invMake) && isset($invModel)) { 
		  echo "Modify $invMake $invModel"; }?> <?php if(isset($invInfo['invMake'])){ 
        echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?>PHP Motors</title>
</head>
<body>
    <div class="container">
      <header>
        <div class="my-account">
          <img src="/phpmotors/images/site/logo.png" alt="PHP Motors">
          <?php 
    
          if (isset($_SESSION['loggedin'])) {
            if(isset($cookieFirstname)){
              $name = $_SESSION['clientData']['clientFirstname'];
              echo "<span><a class='acc' href='/phpmotors/accounts/index.php?action=admin'>Welcome $name </a></span>";
              }
          echo "<p><a class='acc' href='/phpmotors/accounts/index.php?action=Logout' title='Login or Register with PHP Motors'>Log out</a></p>";

          }

          else {
            echo "<p><a class='acc' href='/phpmotors/accounts/index.php?action=login' title='Login or Register with PHP Motors'>My Account</a></p>";
          }
          ?>
          <!-- <a id="acc" href="/phpmotors/accounts/index.php?action=login" title="Login or Register with PHP Motors">My Account</a> -->
        </div>

      </header>
      <nav>
         <?php include $_SERVER['DOCUMENT_ROOT'] 
         . '/phpmotors/snippets/nav.php';?>
      </nav>
      <main>