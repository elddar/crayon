<?php
class frontSite
{
    function getQuestion($boss, $id)
    {
        require 'connect.php';

        $query = "SELECT * FROM questions WHERE question_number = '$id' AND boss = '$boss'";

        if ($result = $connection->query($query)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
?>
                    <div class="number">(<?= $_GET['step'] ?> of 400)</div>
                    <div class="quest"><?= $row['question'] ?></div>
                    <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options">
                        <label class="options"><?= $row['answer1'] ?>
                            <input type="radio" name="radio" value="<?= $row['answer1'] ?>">
                            <span class="checkmark"></span>
                        </label>
                        <label class="options"><?= $row['answer2'] ?>
                            <input type="radio" name="radio" value="<?= $row['answer2'] ?>">
                            <span class="checkmark"></span>
                        </label>
                        <label class="options"><?= $row['answer3'] ?>
                            <input type="radio" name="radio" value="<?= $row['answer3'] ?>">
                            <span class="checkmark"></span>
                        </label>
                        <label class="options"><?= $row['answer4'] ?>
                            <input type="radio" name="radio" value="<?= $row['answer4'] ?>">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                <?php
                }
            }
        }
    }
    function showAnswers($name, $boss)
    {
        require 'connect.php';

        $query = "SELECT userinput.question_id AS question_id, userinput.answer AS answer, questions.correct AS correct FROM userinput, questions WHERE userinput.boss = '$boss' AND name = '$name' AND questions.question_number = userinput.question_id AND questions.boss = userinput.boss";
        if ($result = $connection->query($query)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
                ?>
                    <div class="quest">
                        <p class="small">Question number: <?= $row['question_id'] ?></p>
                        <p>Answer: <?= $row['answer'] ?> <br> (CORRECT: <?=$row['correct'] ?>)</p>
                        <?php
                        if($row['answer'] == $row['correct']){
                            echo "<span class='result correct'>Good job!</span>";
                        }else{
                            echo "<span class='result incorrect'>You stupid!</span>";
                        }
                        ?>
                    </div>
<?php
                }
            }
        }
    }
    function sendAnswer()
    {
        if (isset($_POST['next'])) {
            if (isset($_POST['radio'])) {
                if (!empty($_POST['radio'])) {

                    $character   = $_POST['character'];
                    $answer = $_POST['radio'];
                    $boss   = $_POST['boss'];
                    $questionid   = $_POST['question_id'];

                    require 'connect.php';

                    $q = "INSERT INTO userinput (name, boss, question_id, answer) VALUES ('{$character}', '{$boss}', '{$questionid}', '{$answer}')";

                    if ($connection->query($q) === TRUE) {
                        echo "<h4 class='text-center border-bottom'><img src='../assets/noted.webp' alt='Noted'></h4>";
                        header("Refresh: 1; ?step=" . ((int)$_GET['step'] + 1));
                        exit();
                    } else {
                        echo "Error" . $q . "<br>" . $connection->error;
                    }
                    $connection->close();
                } else
                    echo "<span class='text-center'><img src='../assets/lolwut.webp' alt='Noted'></span>";
            } else {
                echo "<span class='wrong'><img src='../assets/lolwut.webp' alt='Noted'></span>";
                echo "<span class='wrong'>Pick something BOZO</span>";
            }
        }
        if (isset($_POST['finish'])) {
            echo "<h4 class='text-center border-bottom'><img src='../assets/thinkge.webp' alt='Thinking'><br>Preparing results!</h4>";
            header("Refresh: 2.5; ../result/?player=" . $_SESSION['character'] . "&boss=" . basename(getcwd()));
            die();
        }
    }
    function finishQuiz($boss)
    { /* checks how many questions are in the mysql table and adds 1 extra step to finish the quiz */
        require 'connect.php';

        $query = "SELECT * FROM questions WHERE boss = '$boss'";

        if ($result = $connection->query($query)) {
            if ($result->num_rows > 0) {
                $number = $result->num_rows;
                return $number + 1;
            }
        }
    }
}


$front = new frontSite();
?>