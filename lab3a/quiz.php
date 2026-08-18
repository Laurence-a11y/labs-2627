<?php

require "helpers.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$agree = $_POST['agree'] ?? '';

// Bug fix: only proceed if the user actually agreed to the terms.
if ($agree !== 'yes') {
    header('Location: index.php');
    exit;
}

$questions = get_all_questions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPT10 Quiz | Quiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<section class="section">
    <div class="container quiz-container">
        <div class="box">
            <p class="step-label">Step 3 of 4</p>
            <div class="quiz-header">
                <h1 class="title is-4">Answer all questions</h1>
                <div class="timer-pill" id="timer">01:00</div>
            </div>
            <p class="subtitle is-6 has-text-grey">
                The quiz auto-submits when the timer reaches zero.
            </p>

            <form method="POST" action="result.php" id="quiz-form">
                <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
                <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
                <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />
                <input type="hidden" name="agree" value="<?php echo htmlspecialchars($agree); ?>" />

                <!-- Single hidden field holding all answers as one string, e.g. "DBABC" -->
                <input type="hidden" name="answers" id="answers-field" value="" />

                <?php foreach ($questions as $index => $question):
                    $qnum = $index + 1; ?>
                    <div class="question-block">
                        <p class="question-title">
                            <span class="question-number"><?php echo $qnum; ?></span>
                            <?php echo htmlspecialchars($question['question']); ?>
                        </p>
                        <?php foreach ($question['options'] as $option): ?>
                            <div class="field">
                                <div class="control">
                                    <label class="radio">
                                        <input type="radio"
                                               class="answer-radio"
                                               data-question="<?php echo $qnum; ?>"
                                               name="q<?php echo $qnum; ?>"
                                               value="<?php echo htmlspecialchars($option['key']); ?>" />
                                        <?php echo htmlspecialchars($option['value']); ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <hr>
                <?php endforeach; ?>

                <div class="field mt-5">
                    <div class="control">
                        <button type="submit" class="button is-dark is-fullwidth">Submit Quiz</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const TOTAL_QUESTIONS = <?php echo MAX_QUESTION_NUMBER; ?>;
    const form = document.getElementById('quiz-form');
    const answersField = document.getElementById('answers-field');
    const timerEl = document.getElementById('timer');

    // Build the "answers" hidden field from whichever radios are currently checked.
    function buildAnswersString() {
        let answers = '';
        for (let q = 1; q <= TOTAL_QUESTIONS; q++) {
            const checked = document.querySelector(`input[name="q${q}"]:checked`);
            answers += checked ? checked.value : '';
        }
        return answers;
    }

    form.addEventListener('submit', function () {
        answersField.value = buildAnswersString();
    });

    // 60 second auto-submit
    let secondsLeft = 60;

    function updateTimerDisplay() {
        const m = Math.floor(secondsLeft / 60).toString().padStart(2, '0');
        const s = (secondsLeft % 60).toString().padStart(2, '0');
        timerEl.textContent = `${m}:${s}`;
        if (secondsLeft <= 10) {
            timerEl.classList.add('timer-warning');
        }
    }

    updateTimerDisplay();

    const timerInterval = setInterval(function () {
        secondsLeft--;
        updateTimerDisplay();
        if (secondsLeft <= 0) {
            clearInterval(timerInterval);
            answersField.value = buildAnswersString();
            form.submit();
        }
    }, 1000);
</script>
</body>
</html>
