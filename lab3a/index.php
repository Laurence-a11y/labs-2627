<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPT10 Quiz | Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<section class="section">
    <div class="container quiz-container">
        <div class="box">
            <p class="step-label">Step 1 of 4</p>
            <h1 class="title is-4">Create your account</h1>
            <p class="subtitle is-6 has-text-grey">
                Register below to start the IPT10 PHP Quiz Web Application.
            </p>

            <form method="POST" action="instructions.php">
                <div class="field">
                    <label class="label">Complete Name</label>
                    <div class="control">
                        <input class="input" type="text" name="complete_name" id="complete_name"
                               placeholder="Juan Dela Cruz" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Email Address</label>
                    <div class="control">
                        <input class="input" name="email" id="email" type="email"
                               placeholder="juan@example.com" required>
                    </div>
                    <p class="help" id="email-help"></p>
                </div>

                <div class="field">
                    <label class="label">Birthdate</label>
                    <div class="control">
                        <input class="input" name="birthdate" type="date" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Contact Number</label>
                    <div class="control">
                        <input class="input" name="contact_number" type="tel"
                               placeholder="09XXXXXXXXX">
                    </div>
                </div>

                <div class="field mt-5">
                    <div class="control">
                        <button type="submit" class="button is-dark is-fullwidth" id="submit" disabled>
                            Proceed Next
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const name = document.getElementById('complete_name');
    const email = document.getElementById('email');
    const emailHelp = document.getElementById('email-help');
    const submitBtn = document.getElementById('submit');

    // Simple, practical email validation pattern
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    function isValidEmail(value) {
        return emailPattern.test(value.trim());
    }

    function toggleSubmitButton() {
        const nameFilled = name.value.trim() !== '';
        const emailValid = isValidEmail(email.value);

        emailHelp.textContent = (email.value.trim() !== '' && !emailValid)
            ? 'Please enter a valid email address.'
            : '';
        emailHelp.className = 'help is-danger';

        submitBtn.disabled = !(nameFilled && emailValid);
    }

    name.addEventListener('input', toggleSubmitButton);
    email.addEventListener('input', toggleSubmitButton);

    toggleSubmitButton();
</script>
</body>
</html>