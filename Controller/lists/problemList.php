<?php
include_once __DIR__ . "/../../Model/constants.php";
include_once __DIR__ . "/../../Model/redirectionUtils.php";
include_once __DIR__ . "/../../Model/connection.php";
include_once __DIR__ . "/../../Model/problemsGet.php";

$subjectId = $_GET['subject'];
$problems = getProblemsWithSubject($subjectId);

$listPage['title'] = 'Problemes';
$listPage['customJS'] = 'problemsList.js';
if ($_SESSION['user_type'] == PROFESSOR) {
    $listPage['headerButtons'] = [
        array('href' => buildUrl(VIEW_PROBLEM_CREATE, array('subject' => $subjectId)), 'classes' => 'add-object', 
            'img' => 'problem', 'alt' => 'Afegir problema'),
        array('href' => buildUrl(VIEW_PROBLEM_CREATE_GIT, array('subject' => $subjectId)), 'classes' => 'github', 
            'img' => 'problem', 'alt' => 'Afegir problema GitHub'),
    ];
}

if (isset($_GET['err'])) {
    $listPage['errorMessage'] = "Inicia sessió o registra't";
}

// Classify the items and create a list for each element of the list
foreach ($problems as $problem) {
    // If the problem is hidden and the user is a student skip the problem
    if ($_SESSION['user_type'] === STUDENT && $problem['visibility'] === "Private") {
        continue;
    }

    $problemId = $problem['id'];
    $item = array('id' => $problemId, 'href' => buildUrl(VIEW_EDITOR, array('problem' => $problemId)),
        'title' => $problem['title']);
    if ($_SESSION['user_type'] === PROFESSOR) {
        $item['buttons'][] = array('type' => 'a',
            'href' => buildUrl(VIEW_PROBLEM_EDIT, array('problem' => $problemId)),
            'image' => 'configure', 'alt' => 'Editar problema');
        $item['buttons'][] = array('type' => 'a',
            'href' => buildUrl(VIEW_EDITOR, array('problem' => $problemId, 'edit' => 1)),
            'image' => 'edit-source', 'alt' => 'Editar codi');
        $visibilityImage = $problem['visibility'] == 'Private'? 'not-visible': 'visible';
        $item['buttons'][] = array('type' => 'js', 'classes' => 'change_visibility','title' => 'Canviar visibilitat',
            'image' => $visibilityImage, 'alt' => 'Canviar visibilitat');
        $item['buttons'][] = array('type' => 'modalToggle', 'title' => 'Esborrar', 'target' => 'delete_problem_modal',
            'image' => 'trash', 'alt' => 'Esborrar problema');
    }
    $listPage['items'][] = $item;
}

$listPage['modals'] = [
    array('id' => 'delete_problem_modal', 'title' => "Estàs segur?",
        'content'=> "L'operació serà immediata i sense possibilitat de retorn.",
        'buttonTitle' => 'Esborrar', 'buttonOnClick' => 'deleteProblem()', 'buttonText' => 'Esborrar',
        'dismissButtonText' => 'Cancel·lar')
];

require_once __DIR__ . "/../../View/html/genericList.php";
