<?php
ob_start();
session_start(); /* Starts the session */
?>

<!doctype html>
<html lang="en">

<head>
    <title>Crayon Factory</title>

    <link rel="apple-touch-icon" sizes="76x76" href="../icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../icon/favicon-16x16.png">
    <link rel="manifest" href="../icon/site.webmanifest">
    <link rel="mask-icon" href="../icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">

    <script>
        const whTooltips = {
            colorLinks: true,
            iconizeLinks: true,
            renameLinks: true
        };
    </script>
    <script src="https://wow.zamimg.com/js/tooltips.js"></script>

    <script>
        window.addEventListener('load', function() {
            var percentage = document.getElementById('percentage');
            if (percentage.textContent === 'Oh hell nah!') {
                var audio = new Audio('../assets/ohhellnah.ogg');
                audio.play();
            }
        });
    </script>
</head>

<?php require '../inc/functions.php'; ?>
<?php require '../inc/connect.php'; ?>

<body>
    <?php
    // check if logged in 
    if (!isset($_SESSION['character'])) {
        header("Location: ../");
    }
    ?>
    <?= $_SESSION['character'] // DEBUG CHARACTER NAME ON TOP OF THE SCREEN FOR TESTING **************************************************************************
    ?>
    <div class="container">
        <div class="question ml-sm-5 pl-sm-5 pt-2">
            <?php
            if (isset($_GET['boss']) && isset($_GET['player'])) {
                $front->showAnswers($_GET['player'], $_GET['boss']);
            } else {
                header("Location: ../");
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>