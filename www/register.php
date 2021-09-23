<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page metadata -->
    <meta charset="utf-8">
    <title>Chat Server - Register</title>
    <meta name="description" content="COSC349 Assignment 2">
    <meta name="author" content="Hayden McAlister">

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
                <h2>Register your account below</h2>
            </div>
        </div>
        
        <form action="register-account.php" method="POST">
            <div class="row">
                <div class="four columns">
                    <h3>Username</h3>
                </div>
                <div class="eight columns"><input id="username" name="username"></div>
            </div>
            <div class="row">
                <div class="four columns">
                    <h3>Password</h3>
                </div>
                <div class="eight columns"><input id="password" name="password" type="password"></div>
            </div>
            <div class="twelve columns"><input type="submit"></div>
        </form>
    </div>

</body>

</html>