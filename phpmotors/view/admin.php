<?php

if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
}
?><?php include $_SERVER['DOCUMENT_ROOT']
. '/phpmotors/snippets/header.php';?>

<?php

if (isset($message)) {
    echo $message;
}

if (isset($_SESSION['loggedin'])) 
    $firstName = $_SESSION['clientData']['clientFirstname'];
    $lastName = $_SESSION['clientData']['clientLastname'];
    $email = $_SESSION['clientData']['clientEmail'];
    $clientLevel = $_SESSION['clientData']['clientLevel'];
    $fullName = "<h1> $firstName $lastName </h1><br>
    <h3> You are logged in.</h3><br>
    <ul>
    <li><b>$firstName</b></li>
    <li><b>$lastName</b></li>
    <li><b>$email</b></li>
    </ul><br>
    <h3>Account Management.</h3><br>
    <p>Use this link to update account information.</p><br>
    <p><a href='/phpmotors/accounts/index.php?action=updateInfo'>Update account information</a></p><br>
    ";
    
    

    if ($clientLevel > 1) {
        $admin = "<hr><br>
        <h3>Inventory Management.</h3><br>
        <p>Use this link to manage the inventory.</p><br>
        <p><a id='acc' href='/phpmotors/vehicles/index.php'>Go to the vehicles controller</a></p>";
        echo $fullName;
        echo $admin;
    } else {
        echo $fullName;
    }


?>



<?php include $_SERVER['DOCUMENT_ROOT']
. '/phpmotors/snippets/footer.php';?>