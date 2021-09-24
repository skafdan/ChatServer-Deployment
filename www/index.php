<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page metadata -->
    <meta charset="utf-8">
    <title>Chat Server - Home</title>
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

        .title {
            animation: fadeInAnimationTitle ease 1s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }

        .content {
            animation: fadeInAnimationContent ease 2s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }

        @keyframes fadeInAnimationTitle {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        
        @keyframes fadeInAnimationContent {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <?php $page_name = "Home";
    include "header.php"; ?>

    <div class="container">
        <div class="row title">
            <div class="twelve columns" style="text-align:center; ">
                <h2>Welcome to the Open Source Chat Server</h2>
            </div>
        </div>
        <div class="row content">
            <a href="download.php">
                <div class="five columns button">Download the Client</div>
            </a>
            <a href="register.php">
                <div class="five columns offset-by-two columns button">Register an Account</div>
            </a>
        </div>

    </div>


</body>

</html>