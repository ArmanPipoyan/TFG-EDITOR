<?php
require_once __DIR__ . '/../Model/constants.php';

$formPage['validationJS'] = 'subjectValidation.js';
$formPage['action'] = '/Controller/subjectNew.php';
$formPage['onSubmit'] = 'validateSubject()';
$formPage['title'] = 'Crear una nova assignatura';
$formPage['subtitle'] = "Crea una nova assignatura indicant el títol, descripció i curs on es realitzarà";
$formPage['fields'] = [
    array('type' => 'text', 'name' => 'title', 'placeholder' => "Títol de l'assignatura", 'required' => 'required'),
    array('type' => 'number', 'name' => 'course', 'placeholder' => 'Curs on es realitzarà', 'min' => 1, 'max' => 10,
        'required' => 'required'),
    array('type' => 'textarea', 'name' => 'description', 'placeholder' => "Descripció de l'assignatura",
        'rows' => 3)
];
$formPage['submitText'] = 'Crear';

require_once __DIR__ . '/../View/html/genericForm.php';
