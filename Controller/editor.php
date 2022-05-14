<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/redirectionUtils.php";
include_once __DIR__ . "/../Model/dockerUtils.php";
include_once __DIR__ . "/../Model/problemsGet.php";
include_once __DIR__ . "/../Model/constants.php";

# If only the query is set without indicating a problem return to the homepage
if (!isset($_GET["problem"])) {
    redirectLocation();
}
$problem_id = $_GET["problem"];
$problem = getProblemWithId($problem_id);
// If a student is trying to access a private problem send him to the front page
if ($problem['visibility'] === 'Private' && isset($_SESSION['user_type']) && $_SESSION['user_type'] === STUDENT) {
    redirectLocation();
}

// Get the session id if it's set
$session_id = null;
if (isset($_GET["session"])) {
    $session_id = $_GET["session"];
}

# The email will be the user's, unless the user is a professor spectating a student
$email = $_SESSION["email"];

if (isset($_GET["view-mode"]) && isset($_GET["user"])) {
    # If the view_mode doesn't exist redirect to the homepage
    $view_mode = $_GET["view-mode"];
    if (!in_array($view_mode, [VIEW_MODE_EDIT, VIEW_MODE_READ_ONLY])) {
        redirectLocation();
    }

    $email = $_GET["user"];

    if ($view_mode == VIEW_MODE_EDIT) {
        setSolutionAsEditing(problem_id: $problem_id, student_email: $email, editing_before: 0, editing_after: 1);
    }
}

# Get the problem files from the machine
$subject = $problem["subject_id"];
$problem_route = $problem["route"];
$cleaned_problem_route = str_replace('\\', '/', realpath(__DIR__ . $problem_route));

# Create the folder for the user if it doesn't already exist
$user_route = './../app/solucions/' . $email;
if (!file_exists(__DIR__ . $user_route) &&
    !mkdir(__DIR__ . $user_route)) {
    echo 'Failed to create folder';
}

# Create the folder of the problem if it doesn't already exist
$problem_title = $problem["title"];
$user_solution_route = './../app/solucions/' . $email . "/" . $problem_title;

if (!file_exists(__DIR__ . $user_solution_route)) {
    if (!mkdir(__DIR__ . $user_solution_route)) {
        echo 'Failed to create folder';
        return;
    }
    $cleaned_user_solution_route = str_replace('\\', '/', realpath(__DIR__ . $user_solution_route));

    # Create the files of the problem if the folder was created right now
    $problem_files = scandir($cleaned_problem_route);
    foreach ($problem_files as $file) {
        if ($file === '.' || $file === "..") {
            continue;
        }
        $path = $cleaned_problem_route . '/' . $file;
        $peg = $cleaned_user_solution_route . '/' . $file;

        if (is_file($path)) {
            copy($path, $peg);
        }
    }

    if ($_SESSION['user_type'] == STUDENT) {
        $created = createSolution($cleaned_user_solution_route, $problem_id, $subject, $email);
        if (!$created) {
            echo "Error creating the solution";
            return;
        }
    }
}

$cleaned_user_solution_route = str_replace('\\', '/', realpath(__DIR__ . $user_solution_route));

if ($_SESSION['user_type'] == PROFESSOR && !is_null($session_id)) {
    $students = getStudentsWithSessionAndProblem(session_id: $session_id, problem_id: $problem_id);
}

$solution = getSolution($problem_id, $_SESSION['mail']);

if ($problem['language'] == 'Notebook') {
    $containerData = runJupyterDocker($_SESSION['email']);
    $_SESSION['containerId'] = $containerData['containerId'];
    $_SESSION['containerPort'] = $containerData['containerPort'];
}

include_once __DIR__ . "/../View/html/editor.php";
