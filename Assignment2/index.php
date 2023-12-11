<?php 

$title = "Sign up / Login";
$desc = "Join the team";

include './includes/header.php';
require './includes/database.php';
if(isset($_POST['submit']) && $_POST['submit'] == 'LOGOUT'){
    session_start();
    session_unset();
    session_destroy();
}
?>
<section>
    
    <h1>Welcome Home! </h1>
    <?php
    if(isset($_POST['submit']) && $_POST['submit'] == 'LOGIN'){
        echo '<div class="log-in">
            <h2>Welcome back friend!</h2>
            <form action="./includes/login.php" method="post">
                <label for="loginInfo">Username or Email:</label>
                <input type="text" id="loginInfo" name="loginInfo">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <input type="submit" name="submit" value="Join Now!">';

        if(isset($_GET['loginFailed'])){
            echo '<p>Login info incorrect! Try again or signup.</p>';
        }
        echo    '</form>
        </div>';
    }
    
        echo'<div class="sign-up">
        <h2>Join the team!</h2>
        <form action="./includes/signup.php" method="post">
            <label for="firstName">First name:</label>
            <input type="text" name="firstName" id="firstName" value="';

            $result = (isset($_GET['firstName'])) ? $_GET['firstName'] : "";
                if($result){
                    echo $result;
                }
            // close the value and the input element then echo a message if they did not enter a name otherwise just put the name in for them.
            echo '">';

                $result = (isset($_GET['firstName']) && empty($result)) ? '<p class="firstNameRequired">* Required field</p>': '';
                    if($result){
                        echo $result;
                    }  
                    $result = '';
            
            echo '<label for="lastName">Last name:</label>
            <input type="text" name="lastName" id="lastName" value="';

            $result = (isset($_GET['lastName'])) ? $_GET['lastName'] : "";
            echo $result;
            // close the value and the input element then echo a message if they did not enter a name otherwise just put the name in for them.
            echo '">';

             $result = (isset($_GET['lastName']) && empty($result)) ? '<p class="lastNameRequired">* Required field</p>': '';
                    if($result){
                        echo $result;
                    }  
                    $result = '';
            
            echo '<label for="username">Username:</label>
            <input type="text" name="username" id="username" value="';

            $result = (isset($_GET['username'])) ? $_GET['username'] : "";

            echo $result;
            // close the value and the input element then echo a message if they did not enter a username otherwise just put the username in for them.
            echo '">';

             $result = (isset($_GET['username']) && empty($result)) ? '<p class="usernameRequired">* Required field</p>': '';
                    if($result){
                        echo $result;
                    }                    
                    $result = '';
            
            echo '<label for="email">email:</label>
            <input type="email" name="email" id="email" value="';

            $result = (isset($_GET['email'])) ? $_GET['email'] : "";
            echo $result;
            // close the value and the input element then echo a message if they did not enter an email otherwise just put the email in for them.
            echo '">';

            $result = (isset($_GET['email']) && empty($result)) ? '<p class="emailRequired">* Required field</p>': '';
                    if($result){
                        echo $result;
                    }
                    $result = '';
            
            echo '<label for="password">Password:</label>
            <input type="password" name="password" id="password">';
            
                if(isset($_GET['password']) && $_GET['password'] == 0){
                    echo '<p class="passwordRequired">* Required field</p>';
                }
            
            echo '<label for="confirm">Confirm password:</label>
            <input type="password" name="confirm" id="confirm">';
             
                if(isset($_GET['confirm']) && $_GET['confirm'] == 0){
                    echo '<p class="confirmRequired">* Required field</p>';
                }
            
            echo '<label for="legal">Accept our <span>terms</span> and <span>conditions</span>: </label>
            <input type="checkbox" name="legal" id="legal"';

            $result = (isset($_GET['legal']) && $_GET['legal'] == "1")? 'checked': '';

            echo $result;
            // close the input element then echo a message if they did not check the legal box otherwise just mark checked in for them.
            echo '>';

             $result = (isset($_GET['legal']) && empty($result)) ? '<p class="legalRequired">* Required field</p>': '';
                    if($result){
                        echo $result;
                    }
                    $result = '';
            echo '
            <label for="mail-list">Would like to receive our weekly newsletter:</label>
            <input type="checkbox" name="mail-list" id="mail-list" checked>
            <input type="submit" name="submit" value="Join Now!">';
            //Help the user understand the rules for signing up 
        if(isset($_GET['NotThatEasy'])){
            echo '<p class="ERR">Don\'t navigate to a page without submitting a form!</p>';
        }
        if(isset($_GET['confirmErr'])){
            echo '<p class="ERR">Passwords did not match!</p>';
        }
        if(isset($_GET['passStrengthERR'])){
            echo '<p class="ERR">Ensure password contains an upper and lowercase letter a number</p>';
            echo '<p class="ERR">and a special character! min length of password should be 9 characters</p>';
        }  
        if(isset($_GET['usernameErr'])){
            echo '<p class="ERR">usernames must be 5 letters long and contain only letters, numbers, hyphens and underscore characters!</p>';
        }  
        if(isset($_GET['emailErr'])){
            echo '<p class="ERR">Not a valid email!</p>';
        }
        if(isset($_GET['emailInUseErr'])){
            echo '<p class="ERR">That email is already in use here!</p>';
        }
        if(isset($_GET['usernameInUseErr'])){
            echo '<p class="ERR">That username is already in use here!</p>';
        }

    echo    '</form>
    </div>
    <?php '; ?>
</section>

<?php
    
include './includes/footer.php';
?>