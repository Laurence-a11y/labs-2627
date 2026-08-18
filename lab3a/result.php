<?php

require "helpers.php";

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}


// Get submitted information
$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$answers = $_POST['answers'] ?? '';


// Calculate score
$score = compute_score($answers);


// Check if the score is perfect
$is_perfect = ($score === MAX_QUESTION_NUMBER);


// Perfect score = green
// Anything below perfect = red
$hero_class = $is_perfect ? 'is-success' : 'is-danger';


// Get questions and correct answers
$questions = get_all_questions();
$correct_answers = get_answers();


// Format birthdate from YYYY-MM-DD to "Month dd, YYYY"
$formatted_birthdate = $birthdate;

if (!empty($birthdate)) {
    $date_obj = DateTime::createFromFormat('Y-m-d', $birthdate);

    if ($date_obj) {
        $formatted_birthdate = $date_obj->format('F d, Y');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IPT10 Quiz | Result</title>

    <!-- Bulma -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css"
    />

    <!-- Confetti CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/site/site.min.css"
    />

    <!-- Confetti JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js">
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css" />
</head>


<body>


<?php if ($is_perfect): ?>

    <!-- Confetti only appears for a perfect score -->
    <canvas id="confetti-canvas"></canvas>

<?php endif; ?>


<!-- Result Hero -->
<section class="hero <?php echo $hero_class; ?>">

    <div class="hero-body">

        <p class="step-label-inverted">
            Step 4 of 4
        </p>


        <p class="title">
            Your Score:
            <?php echo $score; ?>
            /
            <?php echo MAX_QUESTION_NUMBER; ?>
        </p>


        <p class="subtitle">

            <?php
            if ($is_perfect) {
                echo 'Perfect score! 🎉';
            } else {
                echo 'Better luck next time.';
            }
            ?>

        </p>

    </div>

</section>



<!-- Main Content -->
<section class="section">

    <div class="container quiz-container">


        <!-- User Information -->
        <div class="box">

            <h2 class="title is-5">
                Your Information
            </h2>


            <div class="table-container">

                <table class="table is-bordered is-hoverable is-fullwidth">

                    <tbody>

                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>


                        <tr>
                            <td>Complete Name</td>

                            <td>
                                <?php
                                echo htmlspecialchars($complete_name);
                                ?>
                            </td>
                        </tr>


                        <tr class="is-selected">

                            <td>Email</td>

                            <td>
                                <?php
                                echo htmlspecialchars($email);
                                ?>
                            </td>

                        </tr>


                        <tr>

                            <td>Birthdate</td>

                            <td>
                                <?php
                                echo htmlspecialchars($formatted_birthdate);
                                ?>
                            </td>

                        </tr>


                        <tr>

                            <td>Contact Number</td>

                            <td>
                                <?php
                                echo htmlspecialchars($contact_number);
                                ?>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>



        <!-- Answer Review -->
        <div class="box">

            <h2 class="title is-5">
                Answer Review
            </h2>


            <div class="table-container">

                <table class="table is-bordered is-hoverable is-fullwidth">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Correct Answer</th>
                            <th>Your Answer</th>
                            <th>Result</th>
                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($questions as $index => $question): ?>

                            <?php

                            $qnum = $index + 1;

                            $correct_key =
                                $correct_answers[$index] ?? '';

                            $user_key =
                                $answers[$index] ?? '';

                            $is_correct =
                                ($correct_key === $user_key
                                && $user_key !== '');

                            ?>


                            <tr
                                class="<?php
                                    echo $is_correct
                                        ? 'has-background-success-light'
                                        : 'has-background-danger-light';
                                ?>"
                            >

                                <!-- Question Number -->
                                <td>
                                    <?php echo $qnum; ?>
                                </td>


                                <!-- Question -->
                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $question['question']
                                    );
                                    ?>
                                </td>


                                <!-- Correct Answer -->
                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        get_option_text(
                                            $qnum,
                                            $correct_key
                                        )
                                    );
                                    ?>
                                </td>


                                <!-- User Answer -->
                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        get_option_text(
                                            $qnum,
                                            $user_key
                                        )
                                    );
                                    ?>
                                </td>


                                <!-- Result -->
                                <td>

                                    <?php if ($is_correct): ?>

                                        <span class="tag is-success">
                                            Correct
                                        </span>

                                    <?php else: ?>

                                        <span class="tag is-danger">
                                            Incorrect
                                        </span>

                                    <?php endif; ?>

                                </td>

                            </tr>


                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>


    </div>

</section>



<?php if ($is_perfect): ?>

<script>

    var confettiSettings = {
        target: 'confetti-canvas'
    };

    var confetti =
        new ConfettiGenerator(confettiSettings);

    confetti.render();

</script>

<?php endif; ?>


</body>

</html>
