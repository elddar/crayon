<?php
/*
SELECT * FROM questions WHERE question_number NOT IN (SELECT question_id FROM userinput WHERE user_id = '$user_id')
*/
class frontSite
{
    function getQuestion($boss, $id)
    {
        function checkIfAnswered($boss, $id, $user)
        {
            require 'connect.php';

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
        }
        require 'connect.php';

        $query = "SELECT * FROM questions WHERE question_number = '$id' AND boss = '$boss'";

        if ($result = $connection->query($query)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
                    checkIfAnswered($boss, $id, $user);
?>
                    <div class="number">(<?= $_GET['step'] ?> of 400)</div>
                    <div class="quest"><?= $row['question'] ?></div>
                    <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options">
                        <?php
                        if ($result->num_rows > 0) {
                            // iterate through each column of the current row
                            foreach ($row as $key => $value) {
                                // if the current column is one of the answer columns, display its value
                                if (($key == 'answer1' || $key == 'answer2' || $key == 'answer3' || $key == 'answer4') && (!isset($value) || $value !== '')) {
                        ?>
                                    <label class="options"><?= $value?>
                                        <input type="radio" name="radio" value="<?= $value ?>">
                                        <span class="checkmark"></span>
                                    </label>
                        <?php
                                }
                            }
                            echo "<br>";
                        }
                        ?>


                        <?php
                        /* old one in case something breaks
                        if (($row['answer1'])) {
                        ?>
                            <label class="options"><?= $row['answer1'] ?>
                                <input type="radio" name="radio" value="<?= $row['answer1'] ?>">
                                <span class="checkmark"></span>
                            </label>
                        <?php
                        }
                        ?>
                        <?php
                        if (($row['answer2'])) {
                        ?>
                            <label class="options"><?= $row['answer2'] ?>
                                <input type="radio" name="radio" value="<?= $row['answer2'] ?>">
                                <span class="checkmark"></span>
                            </label>
                        <?php
                        }
                        ?>
                        <?php
                        if (($row['answer3'])) {
                        ?>
                            <label class="options"><?= $row['answer3'] ?>
                                <input type="radio" name="radio" value="<?= $row['answer3'] ?>">
                                <span class="checkmark"></span>
                            </label>
                        <?php
                        }
                        ?>
                        <?php
                        if (($row['answer4'])) {
                        ?>
                            <label class="options"><?= $row['answer4'] ?>
                                <input type="radio" name="radio" value="<?= $row['answer4'] ?>">
                                <span class="checkmark"></span>
                            </label>
                        <?php
                        }
                        */
                        ?>
                    </div>
                <?php
                }
            }
        }
    }
    function showGrade()
    {
        require 'connect.php';

        $query = "SELECT * FROM questions WHERE boss = '$boss'";
        if ($result = $connection->query($query)) {
            if ($result->num_rows > 0) {
                $number = $result->num_rows;
                return $number;
            }
        }
    }
    function showAnswers($name, $boss) /* show results */
    {
        require 'connect.php';

        $query = "SELECT questions.question, userinput.question_id AS question_id, userinput.answer AS answer, questions.correct AS correct FROM userinput, questions WHERE userinput.boss = '$boss' AND name = '$name' AND questions.question_number = userinput.question_id AND questions.boss = userinput.boss";
        if ($result = $connection->query($query)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
                ?>
                    <div class="quest">
                        <p class="small">Question <?= $row['question_id'] ?>: <?= $row['question'] ?></p>
                        <?php
                        if ($row['answer'] == $row['correct']) {
                            echo "<p>Answer: " . $row['answer'] . "</p>";
                            echo "<span class='result correct'>Good job!</span>";
                        } else {
                            echo "<p>Answer: " . $row['answer'] . "<br><b>(CORRECT: " . $row['correct'] . ")</b></p>";
                            echo "<span class='result incorrect'>You stupid!</span>";
                        }
                        ?>
                    </div>
                <?php
                }
            }
        }
        $query = "SELECT * FROM questions WHERE boss = '$boss' AND question_number NOT IN (SELECT question_id FROM userinput WHERE userinput.name = '$name')";
        if ($result = $connection->query($query)) {
            if ($result->num_rows > 0) {
                echo "<p class='border-bottom p-2 bozo'><b>You didn't answer these questions, BOZO!</b><br><span class='ml-4'>Click on them!</span></p>";
                while ($row = $result->fetch_array()) {
                ?>
                    <a href="../<?= $_GET['boss'] ?>?step=<?= $row['question_number'] ?>">
                        <div class="quest">
                            <p class="small">Q: <?= $row['question'] ?>
                        </div>
                    </a>
<?php
                }
            }
        }
        echo '<h4 class="py-2 ml-4 back"><a href="../">Click here to go back</a></h4>';
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
            }else{
                return 1; /* if there's 0 questions for specific topic return 1 so it can start adding numbers for next questions */
            }
        }
    }
    function makeQuestion()
    {
        if (isset($_POST['submit'])) {
            if (isset($_POST['boss']) && isset($_POST['question']) && isset($_POST['answer1']) && isset($_POST['answer2']) && isset($_POST['correct']) && isset($_POST['qnumber'])) {
                if (!empty($_POST['boss']) && !empty($_POST['question']) && !empty($_POST['answer1']) && !empty($_POST['answer2']) && !empty($_POST['correct']) && !empty($_POST['qnumber'])) {
                    $question   = $_POST['question'];
                    $answer1    = $_POST['answer1'];
                    $answer2    = $_POST['answer2'];
                    $answer3    = $_POST['answer3'];
                    $answer4    = $_POST['answer4'];
                    $correct    = $_POST['correct'];
                    $boss       = $_POST['boss'];
                    $qnumber    = $_POST['qnumber'];

                    require 'connect.php';

                    $question = $connection->real_escape_string($question);
                    $answer1 = $connection->real_escape_string($answer1);
                    $answer2 = $connection->real_escape_string($answer2);
                    $answer3 = $connection->real_escape_string($answer3);
                    $answer4 = $connection->real_escape_string($answer4);
                    $correct = $connection->real_escape_string($correct);
                    $boss = $connection->real_escape_string($boss);
                    $qnumber = $connection->real_escape_string($qnumber);

                    $q = "INSERT INTO questions (question, answer1, answer2, answer3, answer4, correct, boss, question_number) 
                    VALUES ('{$question}', '{$answer1}', '{$answer2}', '{$answer3}', '{$answer4}', '{$correct}', '{$boss}', '{$qnumber}')";

                    if ($connection->query($q) === TRUE) {
                        echo "<p class='postsuccess'>Posting question for <span class='red'>" . $boss . "</span> this is question number <span class='red'>" . $qnumber . "</span></p>";
                        echo '<div class="w3-light-grey">
                        <div id="myBar" class="w3-green" style="height:24px;width:0"></div>
                      </div>
                      <br>';
                        header("Refresh: 2.5; url=" . $_SERVER['REQUEST_URI']);
                        exit();
                    } else {
                        echo "Error!" . $q . "<br>" . $connection->error;
                    }
                } else {
                    echo "error1";
                }
            } else {
                echo "error2";
            }
        }
    }
}


$front = new frontSite();
?>