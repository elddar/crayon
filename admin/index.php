<?php
// Start the session on every page at the top first
session_start();
$secretstuff = "Edo";
?>
<!DOCTYPE html>
<html>

<?php require '../inc/functions.php'; ?>
<?php require '../inc/connect.php'; ?>

<head>
    <title>Crayon Factory - Admin</title>

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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <title>Crayon Factory</title>
    <link rel="stylesheet" href="admin.css">

    <script>
        window.onload = function move() {
            var elem = document.getElementById("myBar");
            var width = 1;
            var id = setInterval(frame, 20);

            function frame() {
                if (width >= 100) {
                    clearInterval(id);
                } else {
                    width++;
                    elem.style.width = width + '%';
                }
            }
        }
    </script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card my-5">
                    <form method="post" action="" class="card-body cardbody-color p-lg-5">
                        <div class="text-center">
                            <?php
                            if (isset($_SESSION['character'])) {
                                echo '<a href="de.php"><img src="../assets/power.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile"></a>';
                            } else {
                                echo '<img src="../assets/power.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">';
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <?php
                            if (isset($_POST['session_name'])) {
                                $_SESSION['character'] = $_POST['session_name'];
                            }
                            if (!isset($_SESSION['character'])) {
                                echo '<label for="session_name">Super secret password:</label>
                                <input type="password" class="form-control" id="session_name" name="session_name">';
                                echo '<br><div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Adminayeg</button></div>';
                            } else {
                                if ($_SESSION['character'] != $secretstuff) {
                                    echo "<div class='welcome'>Go away, BOZO!</div>";
                                    header("Refresh: 1; ../");
                                    die();
                                } else {
                                    echo "<div class='welcome'>Admin, " . $_SESSION['character'] . "</div>";
                                }
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            if (isset($_SESSION['character']) && $_SESSION['character'] == $secretstuff) {
                if (!isset($_GET['boss'])) {
            ?>
                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            <a href="?boss=kazzara" class="p-1">
                                <img data-toggle="tooltip" data-placement="top" title="KAZZARA, THE HELLFORGED" src="../assets/kazzara.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss active" width="200px" alt="profile">
                            </a>
                            <a href="?boss=amalgamation" class="p-1">
                                <img data-toggle="tooltip" data-placement="top" title="THE AMALGAMATION CHAMBER" src="../assets/theamalgamationchamber.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                            </a>
                            <a href="?boss=experiments" class="p-1">
                                <img data-toggle="tooltip" data-placement="top" title="THE FORGOTTEN EXPERIMENTS" src="../assets/theforgottenexperiments.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                            </a>
                            <a href="?boss=assault" class="p-1">
                                <img data-toggle="tooltip" data-placement="top" title="ASSAULT OF THE ZAQALI" src="../assets/assaultofthezaqali.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                            </a>
                            <a href="?boss=rashok" class="p-1">
                                <img data-toggle="tooltip" data-placement="top" title="RASHOK, THE ELDER" src="../assets/rashoktheelder.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                            </a>
                            <a href="?boss=zskarn" class="p-1">
                                <img data-toggle="tooltip" data-placement="top" title="THE VIGILANT STEWARD, ZSKARN" src="../assets/thevigilantstewardzskarn.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                            </a>
                            <a href="?boss=magmorax" class="p-1">
                                <img data-toggle="tooltip" data-placement="top" title="MAGMORAX" src="../assets/magmorax.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                            </a>
                            <a href="?boss=neltharion" class="p-1">
                                <img data-toggle="tooltip" data-placement="top" title="ECHO OF NELTHARION" src="../assets/echoofneltharion.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                            </a>
                            <a href="?boss=sarkareth" class="p-1">
                                <img data-toggle="tooltip" data-placement="top" title="SCALECOMMANDER SARKARETH" src="../assets/scalecommandersarkareth.webp" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3 boss inactive" width="200px" alt="profile">
                            </a>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <?php $front->makeQuestion(); ?>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="boss">Question</label>
                                        <input type="text" class="form-control" id="question" aria-describedby="question" name="question">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-3">
                                            <label for="boss">Answer 1</label>
                                            <input type="text" class="form-control answer" id="answer1" aria-describedby="question" name="answer1">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="boss">Answer 2</label>
                                            <input type="text" class="form-control answer" id="answer2" aria-describedby="question" name="answer2">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="boss">Answer 3</label>
                                            <input type="text" class="form-control answer" id="answer3" aria-describedby="question" name="answer3">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="boss">Answer 4</label>
                                            <input type="text" class="form-control answer" id="answer4" aria-describedby="question" name="answer4">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="boss">Correct</label>
                                        <input type="text" class="form-control" id="correct" aria-describedby="question" name="correct">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                                    <input type="text" class="invisible" id="boss" aria-describedby="boss" name="boss" value="<?= $_GET['boss'] ?>">
                                    <input type="text" class="form-control" id="qnumber" aria-describedby="qnumber" name="qnumber" value="<?= $front->finishQuiz($_GET['boss']); ?>">
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
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
    <script>
        // Get all the input elements with class "answer"
        const answerInputs = document.querySelectorAll('.answer');

        // Loop through each input element and add a "dblclick" event listener
        answerInputs.forEach(input => {
            input.addEventListener('dblclick', function() {
                // Get the value of the input element that was double clicked
                const answerValue = input.value;

                // Find the form element with id "correct" and set its value to the answer value
                const correctForm = document.getElementById('correct');
                correctForm.value = answerValue;
            });
        });
    </script>
</body>

</html>