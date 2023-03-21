<?php

if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
}
?><?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>

<?php
// Check to see if a variable message exists to display it
if (isset($message)) {
    echo $message;
}
$clientName = $_SESSION['clientData']['clientFirstname'];
$clientLName = $_SESSION['clientData']['clientLastname'];
$clientNewEmail = $_SESSION['clientData']['clientEmail'];
$clientID = $_SESSION['clientData']['clientId'];
?>
        <h1>Manage Account</h1><br>

        <h3>Update Account</h3><br>

        <form class="form" action="/phpmotors/accounts/"  method="post">
            <label for="clientFirstname">First Name </label><br>
            <input type="text" id="clientFirstname" name="clientFirstname" required <?php if (isset($_SESSION['clientData']['clientFirstname'])) {echo "value='$clientName'";}  ?>><br><br>
            <label for="clientLastname">Last Name </label><br>
            <input type="text" id="clientLastname" name="clientLastname" required <?php if (isset($_SESSION['clientData']['clientLastname'])) {echo "value='$clientLName'";}?>><br><br>
            <label for="clientEmail">Email </label><br>
            <input type="email" id="clientEmail" name="clientEmail" required <?php if (isset($_SESSION['clientData']['clientEmail'])) {echo "value='$clientNewEmail'";}?>><br><br>

            <!-- Add the hidden action -->
            <input type="hidden" name="action" value="updateAccount">
            <input type="submit" id="submit" value="Update info"><br><br>
            <input type="hidden" name="clientId" value="
            <?php if(isset($clientID)){ echo $clientID;} ?>">
        </form>
        <hr><br>


        <h3>Update Password</h3><br>
        <form class="form" action="/phpmotors/accounts/"  method="post">
            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span><br><br>
            <span>* note your original password will be changed.</span><br><br>
            <label for="clientPassword">Password </label><br>
            <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>

            <!-- Add the hidden action -->
            <input type="hidden" name="action" value="updatePassword">
            <input type="submit" id="submit2" value="Update password"><br><br>
            <input type="hidden" name="clientId" value="
            <?php if(isset($clientID)){ echo $clientID;} ?>">
        </form>


<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>
