<?php
ob_start();
session_start(); /* Starts the session */
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Crayon Factory</title>
</head>

<?php require '../inc/functions.php'; ?>
<?php require '../inc/connect.php'; ?>

<body>
    <?php
    // check if logged in 
    if (!isset($_SESSION['character'])) {
        header("Location: ../");
    }
    // check if user is on step, if not back to step 1
    if (!isset($_GET['step'])) {
        header("Location: ?step=1");
    }
    if (isset($_GET['step'])) {
        $step = intval($_GET['step']);

        if ($step >= 1 && $step <= $front->finishQuiz(basename(getcwd()))) {
        } else {
            echo "<h4 class='text-center' style='color: white'><img src='../assets/forsenCD.webp' alt='Noted'><br>No cheating!</h4>";
            header("Refresh: 1.5; ?step=1");
            exit();
        }
    } else {
        echo "Fallback error!";
    }
    ?>
    <?= $_SESSION['character'] // DEBUG CHARACTER NAME ON TOP OF THE SCREEN FOR TESTING **************************************************************************?>
    <div class="container">
        <?php $front->sendAnswer(); ?>
        <div class="question ml-sm-5 pl-sm-5 pt-2">
            <form action="" method="POST" enctype="multipart/form-data" class="col-lg-12">
                <?php $front->getQuestion('kazzara', $_GET['step']) ?>
                <input type="hidden" class="form-control" name="question_id" value="<?= $_GET['step'] ?>">
                <input type="hidden" class="form-control" name="character" value="<?= $_SESSION['character'] ?>">
                <input type="hidden" class="form-control" name="boss" value="kazzara">
                <div class="btnnext">
                    <?php
                    if ($_GET['step'] == $front->finishQuiz(basename(getcwd()))) {
                        echo '<button name="finish" class="btn btn-success">Finish</button>';
                    } else {
                        echo '<button name="next" class="btn btn-success">Next</button>';
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <?php
    if ($_GET['step'] == "2") {
    ?>
        <script>
            const radio3 = document.querySelector('input[value="I kill myself"]');
            radio3.addEventListener('click', function() {
                if (this.checked) {
                    const audio = new Audio('../assets/kys.ogg');
                    audio.play();
                }
            });
        </script>
    <?php
    } elseif($_GET['step'] == "1") {
    ?>
        <script>
            const radio = document.querySelector('input[value="Benni"]');
            const radio2 = document.querySelector('input[value="Aeoni"]');
            radio.addEventListener('click', function() {
                if (this.checked) {
                    const audio = new Audio('../assets/scrub.ogg');
                    audio.play();
                }
            });
            radio2.addEventListener('click', function() {
                if (this.checked) {
                    const audio = new Audio('../assets/nodisrespect.ogg');
                    audio.play();
                }
            });
        </script>
    <?php
    }
    ?>
</body>

</html>