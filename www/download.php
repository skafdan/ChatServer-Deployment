<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page metadata -->
    <meta charset="utf-8">
    <title>Chat Server - Download</title>
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

        .content {
            animation: fadeInAnimationContent ease 1s;
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
    </style>
</head>

<body>
    <?php $page_name = "Download";
    include "header.php"; ?>

    <div class="container">
        <div class="row">
            <div class="twelve columns" style="text-align:center; ">
                <a class="button" href="Client.jar" download style="background-color: #0cc712; color:#000; height:10%; line-height:10%;font-family: 'Lucida Console', 'Courier New', monospace;">
                    <h2 style="margin: 0;">Download the Client</h2>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="twelve columns" style="text-align:center; ">
                <h4>Requires Java 16 to run</h4>
            </div>
        </div>

        <div class="row content">
            <div class="eight columns offset-by-two" style="text-align: center;">
                <details>
                    <summary>
                        <h3 class="button">Checksums ▼</h3>
                    </summary>
                    <ul style="text-align: left;">
                        <?php
                        $checksum_file = "/vagrant/Client-Checksums";
                        $json = json_decode(file_get_contents($checksum_file), true);
                        foreach ($json as $key => $val) {
                            echo ("<li><b>" . $key . "</b>: " . $val . "</li>");
                        }
                        ?>
                    </ul>
                </details>
            </div>
        </div>
    </div>

</body>

</html>