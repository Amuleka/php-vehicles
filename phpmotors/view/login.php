<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>

<h2>Login Page</h2><br>

<?php
// Check to see if a variable message exists to display it
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
   }
?>

        
        <form class="form" action="/phpmotors/accounts/"  method="post">
            <label for="email">Email </label><br>
            <input type="email" id="email" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required ><br><br>
            <label for="password">Password </label><br>
            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br> 
            <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>

            <!-- Add the hidden action -->
            <input type="hidden" name="action" value="Login">

            <input type="submit" id="submit" value="Sign-in"><br><br>


            <a id="acc" href="/phpmotors/accounts/index.php?action=register">Not yet a member?</a>
        </form>


<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>