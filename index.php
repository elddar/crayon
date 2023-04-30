<?php
// Start the session on every page at the top first
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Crayon Factory</title>

    <link rel="apple-touch-icon" sizes="76x76" href="icon/pple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
    <link rel="manifest" href="icon/site.webmanifest">
    <link rel="mask-icon" href="icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <title>Crayon Factory</title>

    <style>
        body {
            background-color: #333;
            color: #ddd;
        }

        .card {
            border-radius: 0;
        }

        .btn-color {
            background-color: #0e1c36;
            color: #fff;

        }

        .btn-color:hover {
            color: grey;
        }

        .profile-image-pic {
            height: 200px;
            width: 200px;
            object-fit: cover;
        }

        .boss {
            background-color: #222;
            border-color: #555;
            border-width: 2px;
            transition-duration: .2s;
        }

        .cardbody-color {
            background-color: #555;
        }

        a {
            text-decoration: none;
        }

        .welcome {
            text-align: center;
        }

        .inactive{
            filter: opacity(20%);
        }

        .active:hover{
            filter: brightness(140%);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card my-5">
                    <form method="post" action="" class="card-body cardbody-color p-lg-5">
                        <div class="text-center">
                            <?php
                            if(isset($_SESSION['character'])){
                                echo '<a href="de.php"><img src="assets/pepem.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile"></a>';
                            }else{
                                echo '<img src="assets/pepem.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">';
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <?php
                            if (isset($_POST['session_name'])) {
                                $_SESSION['character'] = $_POST['session_name'];
                            }
                            ?>
                            <?php
                            if (!isset($_SESSION['character'])) {
                                echo '<label for="session_name">Character name:</label>
                                <input type="text" class="form-control" id="session_name" name="session_name">';
                                echo '<br><div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Okayeg</button></div>';
                            } else {
                                echo "<div class='welcome'>Yo, " . $_SESSION['character'] . "</div>";
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            if (isset($_SESSION['character'])) { ?>
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <a href="kazzara" class="p-1">
                            <img data-toggle="tooltip" data-placement="top" title="KAZZARA, THE HELLFORGED" src="assets/kazzara.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss active" width="200px" alt="profile">
                        </a>
                        <a href="amalgamation" class="p-1">
                            <img data-toggle="tooltip" data-placement="top" title="THE AMALGAMATION CHAMBER" src="assets/theamalgamationchamber.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                        </a>
                        <a href="experiments" class="p-1">
                            <img data-toggle="tooltip" data-placement="top" title="THE FORGOTTEN EXPERIMENTS" src="assets/theforgottenexperiments.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                        </a>
                        <a href="assault" class="p-1">
                            <img data-toggle="tooltip" data-placement="top" title="ASSAULT OF THE ZAQALI" src="assets/assaultofthezaqali.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                        </a>
                        <a href="rashok" class="p-1">
                            <img data-toggle="tooltip" data-placement="top" title="RASHOK, THE ELDER" src="assets/rashoktheelder.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                        </a>
                        <a href="zskarn" class="p-1">
                            <img data-toggle="tooltip" data-placement="top" title="THE VIGILANT STEWARD, ZSKARN" src="assets/thevigilantstewardzskarn.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                        </a>
                        <a href="magmorax" class="p-1">
                            <img data-toggle="tooltip" data-placement="top" title="MAGMORAX" src="assets/magmorax.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                        </a>
                        <a href="neltharion" class="p-1">
                            <img data-toggle="tooltip" data-placement="top" title="ECHO OF NELTHARION" src="assets/echoofneltharion.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                        </a>
                        <a href="sarkareth" class="p-1">
                            <img data-toggle="tooltip" data-placement="top" title="SCALECOMMANDER SARKARETH" src="assets/scalecommandersarkareth.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                        </a>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

</body>

</html>