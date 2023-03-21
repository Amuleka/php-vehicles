<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>


<h2>Registration Form</h2><br>

<?php
// Check to see if a variable message exists to display it
if (isset($message)) {
    echo $message;
}
?>

        
        <form class="form" action="/phpmotors/accounts/index.php" method="post">
            <label for="clientFirstname">First Name </label><br>
            <input type="text" id="clientFirstname" name="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br>
            <label for="clientLastname">Last Name </label><br>
            <input type="text" id="clientLastname" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required><br>
            <label for="clientEmail">Email </label><br>
            <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
            <label for="clientPassword">Password </label><br>
            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
            <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>

            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="registerUser">

            <input type="submit" id="submit" value="Register"></br><br>

        </form>


<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>