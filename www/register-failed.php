<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page metadata -->
    <meta charset="utf-8">
    <title>Chat Server - Register</title>
    <meta name="description" content="COSC349 Assignment 2">
    <meta name="author" content="Hayden McAlister">
    <meta http-equiv="refresh" content="3;url=register-account.php" />

    <!-- CSS references: from SkeletonCSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <style>
        .button {
            border: 2px solid black;
            font-size: large;
        }

        input {
            width: 100%;
            line-height: 150%;
            margin: 1.5rem 0 0 0;
        }
    </style>
</head>

<body>
    <?php $page_name = "Register";
    include "header.php"; ?>

    <div class="container">
        <div class="row">
            <div class="twelve columns" style="text-align:center; ">
                <h2>Your registration has failed!</h2><br>
                <h3>Another user may already have that username</h3>
            </div>
            <div class="twelve columns" style="text-align:center; ">
            <a class="button" href="register.php" style="background-color: #0cc712; color:#000; height:10%; line-height:10%;">
                    <h2 style="margin: 0;">Try Again</h2>
                </a>
            </div>
        </div>
    </div>

</body>

</html>