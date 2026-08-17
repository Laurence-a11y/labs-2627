<?php

define('MAX_QUESTION_NUMBER', 5);

function retrieve_questions() {
    // 1. Open the questions/triviaquiz.json file
    $json_string = file_get_contents(__DIR__ . "/questions/triviaquiz.json");

    // 2. Convert it to an array
    $json_data = json_decode($json_string, true);

    // 3. Return the trivia questions array data
    return $json_data;
}

/**
 * Returns ALL questions (used now that the quiz shows everything at once).
 */
function get_all_questions() {
    $questions = retrieve_questions();
    return $questions['questions'];
}

function get_options_for_question_number($number = 0) {
    $questions = retrieve_questions();
    return $questions['questions'][$number - 1]['options'];
}

/**
 * $answers is expected to be a string where each character (in order)
 * is the selected option key (A/B/C/D) for that question number.
 * e.g. "DBABC"
 */
function compute_score($answers = '') {
    $questions = retrieve_questions();
    $correct_answers = $questions['answers'];

    $score = 0;
    for ($i = 0; $i < MAX_QUESTION_NUMBER; $i++) {
        if (isset($answers[$i]) && $correct_answers[$i] == $answers[$i]) {
            $score += 1; // 1 point per correct answer (5 max) — bug fix: was adding 100
        }
    }
    return $score;
}

function get_answers() {
    $questions = retrieve_questions();
    return $questions['answers'];
}

/**
 * Given an option key (A/B/C/D) and the question number, return the
 * human-readable text of that option. Used on the results page.
 */
function get_option_text($question_number, $key) {
    if (empty($key)) {
        return '(no answer)';
    }
    $options = get_options_for_question_number($question_number);
    foreach ($options as $option) {
        if ($option['key'] === $key) {
            return $option['value'];
        }
    }
    return '(no answer)';
}