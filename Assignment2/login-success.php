<?php 
include './includes/header.php';
session_start();
if(isset($_SESSION['userID'])){
    ?>
    <section class="reward">
        <div>
            <h1>Thank you for signing in!</h1>
            <p>Here is your background of the year!</p>
            <figure>
                <img src="./img/reward2.jpeg" alt="Good boy brings home duck.">
                <figcaption>and here is a duck</figcaption>
            </figure>
        </div>
    </section>
    <?php

}else{
    header("Location: index.php?NotSignedIn");
}

include './includes/footer.php';