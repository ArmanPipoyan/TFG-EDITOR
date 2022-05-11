<?php
require_once __DIR__ . "/../Model/connection.php";
require_once __DIR__ . "/../Model/problemsGet.php";

$subjects = getSubjects();

// Group the subjects by courses
$classified_subjects = [];
foreach ($subjects as $subject) {
    $classified_subjects[$subject['course']][] = $subject;
}
// Sort the courses by number
ksort($classified_subjects);

$listPage['title'] = "Assignatures";
$listPage['headerButtons'] = [
    array('href' => '/index.php?query=10', 'classes' => 'add-object', 'img' => 'subject',
        'alt' => 'Afegir assignatura'),
];
if (isset($_GET['err'])) {
    $listPage['errorMessage'] = "Inicia sessió o registra't";
}

// Classify the items and create a list for each element of the list
foreach ($classified_subjects as $group => $items) {
    $groupItems = [];

    foreach ($items as $item) {
        $groupItem = array('title' => $item['title'], 'description' => $item['description'],
            'buttons'=> [
                array('type' => 'a', 'href' => "/index.php?query=1&subject=" . $item['id'], 'classes' => '',
                    'image' => 'problems', 'alt' => 'Problemes')
            ]);
        if ($item['has_active_sessions']) {
            $groupItem['buttons'][] = array('type' => 'a', 'href' => "/index.php?query=14&subject=" . $item['id'],
                'classes' => '', 'image' => 'session', 'alt' => 'Sessions actives');
        }
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == PROFESSOR) {
            $groupItem['buttons'][] = array('type' => 'a', 'href' => "/index.php?query=13&subject=" . $item['id'],
                'classes' => 'add-object', 'image' => 'session', 'alt' => 'Crear sessió');
        }
        $groupItems[] = $groupItem;
    }

    $listPage['groups'][] = array('name' => 'Curs ' . $group, 'items' => $groupItems);
}

require_once __DIR__ . "/../View/html/genericList.php";
