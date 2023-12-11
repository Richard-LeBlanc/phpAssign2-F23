<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title and Description are generated in the individual pages -->
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale= 1">
        <meta name="robots" content="nofollow, noindex">
        <meta name="description" content="<?php echo $desc; ?>">
        <!-- our css -->
        <link rel="stylesheet" href="./css/style.css">

    </head>
    <!-- just need  the start of each page -->
    <body>

        <header>
            <div><img src="./img/logo.jpg" alt="Our original logo"></div>
            <nav>
                <form action="index.php" method="post">
                    <input type="submit" name="submit" value="LOGOUT">
                </form>
                <form action="index.php" method="post">
                    <input type="submit" name="submit" value="LOGIN">
                </form>
            </nav>
        </header>
        <main>