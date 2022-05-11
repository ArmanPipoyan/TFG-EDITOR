<?php
require_once __DIR__ . "/../Model/connection.php";
require_once __DIR__ . "/../Model/session.php";

$subject_id = $_GET['subject'];
$sessions = getActiveSessions(subject_id: $subject_id);

$listPage['title'] = 'Sessions actives';
$listPage['customJS'] = 'session.js';

// Classify the items and create a list for each element of the list
foreach ($sessions as $session) {
    $sessionId = $session['id'];
    $item = array('id' => $sessionId, 'href' => "/index.php?query=15&session=$sessionId", 'name' => $session['name']);
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == PROFESSOR) {
        $item['buttons'][] = array('type' => 'modalToggle', 'title' => 'Duplicate',
            'target' => 'duplicate_session_modal', 'image' => 'clone', 'alt' => 'Duplicar Sessió');
        $item['buttons'][] = array('type' => 'js', 'title' => 'Delete', 'onClick' => "deleteSession($sessionId)",
            'image' => 'trash', 'alt' => 'Esborrar Sessió');
    }
    $listPage['items'][] = $item;
}

$listPage['modals'] = [
    array('id' => 'duplicate_session_modal', 'title' => 'Duplicar Sessió',
        'field' => array('type' => 'text', 'name' => 'new_session_name', 'placeholder' => 'Nom de la sessió',
            'required' => 'required'),
        'buttonTitle' => 'Duplicar', 'buttonOnClick' => 'duplicateSession()', 'buttonText' => 'Duplicar')
];

require_once __DIR__ . "/../View/html/genericList.php";
