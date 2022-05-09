<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";

$subjects = getSubjects();

// Group the subjects by courses
$classified_subjects = [];
foreach ($subjects as $subject) {
    $classified_subjects[$subject['course']][] = $subject;
}
// Sort the courses by number
ksort($classified_subjects);

include_once __DIR__ . "/../View/html/subjectsList.php";
