<?php
ob_start();
session_start(); /* Starts the session */
?>

<!doctype html>
<html lang="en">

<head>
    <title>Crayon Factory</title>

    <link rel="apple-touch-icon" sizes="76x76" href="../icon/pple-touch-icon.png">
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
        header("Location: " . $_SERVER['REQUEST_URI'] . "&step=1");
    }
    if (!isset($_GET['boss'])) {
        header("Location: ../");
    }
    //echo $_SERVER['REQUEST_URI']; DEBUG
    if (isset($_GET['step'])) {
        $step = intval($_GET['step']);

        if ($step >= 1 && $step <= $front->finishQuiz($_GET['boss'])) {
        } else {
            echo "<h4 class='text-center' style='color: white'><img src='../assets/forsenCD.webp' alt='Noted'><br>No cheating!</h4>";
            header("Refresh: 1.5; ?step=1");
            exit();
        }
    } else {
        echo "Fallback error!";
    }
    ?>
    <div class="container">
        <?php $front->sendAnswer($_GET['step'], $_GET['boss']); ?>
        <div class="question ml-sm-5 pl-sm-5 pt-2" id="main">
            <form action="" method="POST" enctype="multipart/form-data" class="col-lg-12">
                <?php
                /*
                $boss = basename(getcwd());
                $user = $_SESSION['character'];
                $id = $_GET['step'];
                $query = "SELECT * FROM questions, userinput WHERE questions.question_number = '$id' AND questions.boss = '$boss' AND userinput.boss = questions.boss AND userinput.question_id = questions.question_number AND userinput.name = '$user'";
                if ($result = $connection->query($query)) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_array()) {
                            header("Location: ../result/?player=" . $_SESSION['character'] . "&boss=" . basename(getcwd()));
                            die();
                        }
                    }
                }
                */
                ?>
                <?php $front->getQuestion($_GET['boss'], $_GET['step']) ?>
                <input type="hidden" class="form-control" name="question_id" value="<?= $_GET['step'] ?>">
                <input type="hidden" class="form-control" name="character" value="<?= $_SESSION['character'] ?>">
                <input type="hidden" class="form-control" name="boss" value="<?= $_GET['boss'] ?>">
                <div class="btnnext">
                    <?php
                    if ($_GET['step'] == $front->finishQuiz($_GET['boss'])) {
                        echo '<button id="control" name="finish" class="btn btn-success">Finish</button>';
                    } else {
                        echo '<button id="control" name="next" class="btn btn-success">Next</button>';
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>



    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const step = urlParams.get('step');
        const controlButton = document.getElementById('control');

        if (step === '1' && controlButton.textContent === 'Finish') {
            controlButton.remove();

            const soonParagraph = document.createElement('h3');
            const soonText = document.createTextNode('Soon, YEP');
            soonParagraph.appendChild(soonText);

            const controlContainer = document.getElementById('main');
            controlContainer.insertBefore(soonParagraph, controlButton.nextSibling);
        }

        console.log(controlButton.textContent)
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>