<?php
    //check if the user posted with the submit button or tried to enter this page fraudulently.
    function customErrorHandle($errorNo, $errorMessage, $errorFile, $errorLine) {
        echo "<p>Error Message: [$errorNo] $errorMessage</p>";
        echo "<p>Error on line $errorLine in $errorFile</p>";
      }
      set_error_handler("customErrorHandle");
    
    if(isset($_POST['submit'])){
        $message = '';

        // The first step is to ensure that each field is filled in, we check each and pass back a super get to error check against what is not filled in.
        //This ensures all necessary field are entered (idk if this is how it ought to be done, but I return their filled in answers with which to reenter into the form.)
        if(empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm']) || !isset($_POST['legal'])){
            if(!isset($_POST['legal'])){
                $message .= "legal=0&";
            }else{
                $message .= 'legal=1&';
            }
            if(empty($_POST['firstName'])){
                $message.='firstName=&';
            }else{
                $message .= 'firstName='.$_POST['firstName'].'&';
            }
            if(empty($_POST['lastName'])){
                $message.='lastName=&';
            }else{
                $message .= 'lastName='.$_POST['lastName'].'&';
            }
            if(empty($_POST['username'])){
                $message.='username=&';
            }else{
                $message .= 'username='.$_POST['username'].'&';
            }
            if(empty($_POST['email'])){
                $message.='email=&';
            }else{
                $message .= 'email='.$_POST['email'].'&';
            }
            if(empty($_POST['password'])){
                $message.='password=0&';
            }else{
                $message .= 'password=1&';
            }
            if(empty($_POST['confirm'])){
                $message.='confirm=0&';
            }else{
                $message .= 'confirm=1&';
            }
            header("Location: ../index.php?".$message.'return=1');
            exit();
        }

        

        //check if the password matches the confirmation pass
        if($_POST["password"] != $_POST['confirm']){
            $message.="confirmErr=1&";
        }
        
        $uppercase = preg_match('/[A-Z]/', $_POST['password']);
        $lowercase = preg_match('/[a-z]/', $_POST['password']);
        $number    = preg_match('/[0-9]/', $_POST['password']);
        $specialChars = preg_match('/[^\w]/', $_POST['password']);

        //if any of these categories are not met, or the length of the password is 8 or less
        //then the password is too weak and should be declined.

        if(!$uppercase || !$lowercase || !$number || !$specialChars ||strlen($_POST['password']) <= 8){
            $message.="passStrengthERR=1&";
        }

        //Clean our inputs for entry into the database should the tests pass.
        include 'database.php';
        $db = new database();

        $firstName = $db -> conn -> real_escape_string($_POST['firstName']);
        $lastName = $db -> conn -> real_escape_string($_POST['lastName']);
        $username = $db -> conn -> real_escape_string($_POST['username']);
        $email = $db -> conn -> real_escape_string($_POST['email']);
        $email = strtolower($email);
        $password = $db -> conn -> real_escape_string($_POST['password']);
        $password = hash('sha512', $password);

        

        if(!preg_match('/^[a-zA-Z0-9\-\_]+$/', $username) || strlen($username) < 5){
            $message.="usernameErr=1&";
        }

        $pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        if(!preg_match($pattern, $email)){
            $message .= 'emailErr=1&';
        }

        //check if the username or email are currently in use.
        $query = "SELECT username, email from family WHERE username = '$username' or email = '$email';";
        $res = $db -> conn -> query($query);
        $rows = array();
        while($row = $res -> fetch_assoc()){
            $rows[] = $row;
        }

        if($rows){
            if($rows['email'] == $email){
                $message .= "emailInUseErr=1&";
            }
            if($rows['username'] == $username){
                $message .= "usernameInUseErr=1&";
            }
        }
        
        if(isset($_POST['mail-list'])){
            $mailList = 'YES';
        }else{
            $mailList = 'NO';
        }

        
        if(empty($message)){

            $res = $db -> create($firstName, $lastName, $username, $email, $password, $mailList);
            mysqli_close($db -> conn);
            $db = null;

            if(!$res){
                header("Location: ../index.php?signupUnexpectedErr=1");
                exit();
            }else{
                header("Location: ../index.php?signupSuccess=1");
                exit();
            }
        } else{
            mysqli_close($db -> conn);
            $db = null;

            $message .= 'legal=1&';
            $message .= 'firstName='.$_POST['firstName'].'&';
            $message .= 'lastName='.$_POST['lastName'].'&';
            $message .= 'username='.$_POST['username'].'&';
            $message .= 'email='.$_POST['email'].'&';
            header("Location: ../index.php?".$message.'return=1');
            exit();
        }

        
    }else{
        header("Location: ../index.php?NotThatEasy");
        exit();
    }