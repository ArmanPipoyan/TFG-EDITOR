<?php
session_start();
include_once __DIR__ . "/Model/constants.php";

if (isset($_GET["code"])) {
    $_SESSION["code"] = $_GET["code"];
    print_r($_SESSION);
}

$query = $_GET["query"] ?? VIEW_SUBJECT_LIST;

if (isset($_SESSION["email"])) {
    # If the user is a Student the views are restricted
    if ($_SESSION['user_type'] == STUDENT && !in_array($query, STUDENT_VIEWS)) {
        header("Location:/index.php");
    }
} else {
    # If the user is anonymous he can only log in or register
    if (!in_array($query, ANONYMOUS_USER_VIEWS)) {
        header("Location:/index.php?err=1");
    }
}

switch ($query) {
    case VIEW_PROBLEMS_LIST:
        include __DIR__ . "/Controller/problemList.php";
        break;
    case VIEW_LOGIN_FORM:
        include __DIR__ . "/View/html/login.php";
        break;
    case VIEW_REGISTER_FORM:
        include __DIR__ . "/View/html/register.php";
        break;
    case VIEW_PROBLEM_CREATE:
        include __DIR__ . "/View/html/problemNew.php";
        break;
    case VIEW_PROBLEM_CREATED:
        include __DIR__ . "/View/html/problemCreationSuccessful.php";
        break;
    case VIEW_PROBLEM_ERROR_CREATING:
        include __DIR__ . "/View/html/problemCreationError.php";
        break;
    case VIEW_EDITOR:
        include __DIR__ . "/Controller/editor.php";
        break;
    case VIEW_SUBJECT_CREATE:
        include __DIR__ . "/View/html/subjectNew.php";
        break;
    case VIEW_SOMETHING:
        include __DIR__ . "/Model/zipFolder.php";
        break;
    case VIEW_PROBLEM_EDIT:
        include __DIR__ . "/Controller/problemEdit.php";
        break;
    default:
        include __DIR__ . "/Controller/subjectList.php";
        break;
}
