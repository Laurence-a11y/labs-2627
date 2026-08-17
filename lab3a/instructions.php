<?php
// Bug fix: must exit after redirect, otherwise the rest of the script still runs.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';

$sepName = explode(" ", trim($complete_name));
$first_name = $sepName[0] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPT10 Quiz | Instructions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<section class="section">
    <div class="container quiz-container">
        <div class="box">
            <p class="step-label">Step 2 of 4</p>
            <h1 class="title is-4">Hello, <?php echo htmlspecialchars($first_name); ?> 👋</h1>
            <p class="subtitle is-6 has-text-grey">Please read the instructions before you start.</p>

            <form method="POST" action="quiz.php">
                <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
                <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
                <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />

                <div class="content instructions-box">
                    <p>
                        This quiz consists of 5 multiple-choice questions about Philippine history and
                        geography. All questions will be shown on a single page — answer each one, then
                        submit. The quiz will also auto-submit after 60 seconds, so don't leave it idle.
                    </p>
                </div>

                <div class="field">
                    <label class="label">Terms and Conditions</label>
                    <div class="control">
                        <textarea class="textarea" rows="4" readonly>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="agree" id="agree" value="yes">
                            I agree to the <a href="#">terms and conditions</a>
                        </label>
                    </div>
                </div>

                <div class="field mt-5">
                    <div class="control">
                        <button type="submit" id="submit" class="button is-dark is-fullwidth" disabled>
                            Start Quiz
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const checkBox = document.getElementById('agree');
    const submitBtn = document.getElementById('submit');

    function toggleSubmitButton() {
        submitBtn.disabled = !checkBox.checked;
    }

    checkBox.addEventListener('input', toggleSubmitButton);
    toggleSubmitButton();
</script>
</body>
</html>