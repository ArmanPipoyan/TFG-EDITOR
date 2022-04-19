<?php

function createSession(string $name, int $professor_id, int $subject_id, array $problem_ids) : int
{
    $session_id = 0;
    try {
        // Create a transaction so if any insertion fails no object will be created
        $connection = connectDB();
        $connection->beginTransaction();

        // Create the session and get its id
        $statement = $connection->prepare("INSERT INTO session(name, professor_id, subject_id) 
            VALUES(:name, :professor_id, :subject_id)");
        $statement->execute(array(":name" => $name, ":professor_id" => $professor_id, ":subject_id" => $subject_id));
        $session_id = $connection->lastInsertId();

        // Create a relation between each selected problem and the session
        foreach ($problem_ids as $problem_id) {
            $connection->exec("INSERT INTO session_problems(session_id, problem_id)
                                        VALUES($session_id, $problem_id)");
        }

        // Commit the changes
        $connection->commit();
        $connection = null;
    } catch (PDOException $e) {
        echo 'Error creating the session: ' . $e->getMessage();
    }
    return $session_id;
}

function deleteSession(int $session_id) : bool
{
    $deleted = false;
    try {
        $connection = connectDB();
        // Since the relation between Session and SessionProblems is CASCADE, the relation will be deleted as well
        $statement = $connection->prepare("DELETE FROM session WHERE id=:session_id");
        $statement->execute(array(":session_id" => $session_id));

        $connection = null;
        $deleted = True;
    } catch (PDOException $e) {
        echo 'Error deleting the session: ' . $e->getMessage();
    }
    return $deleted;
}

function getActiveSessions(int $subject_id) : array
{
    $sessions = [];
    try {
        $connection = connectDB();
        $statement = $connection->prepare("SELECT * FROM session WHERE subject_id= :subject_id");
        $statement->execute(array(":subject_id" => $subject_id));
        $sessions = $statement->fetchAll(PDO::FETCH_ASSOC);

        $connection = null;
    } catch (PDOException $e) {
        echo 'Error retrieving the sessions: ' . $e->getMessage();
    }
    return $sessions;
}

function addStudentToSession(int $session_id, string $email) : bool
{
    $added = false;
    try {
        $connection = connectDB();
        $statement = $connection->prepare("UPDATE student SET session_id=:session_id WHERE email=:email");
        $statement->execute(array(":session_id" => $session_id, ":email" => $email));

        $added = true;
        $connection = null;
    } catch (PDOException $e) {
        echo 'Error retrieving the sessions: ' . $e->getMessage();
    }
    return $added;
}

function duplicateSession(string $session_name, int $session_id)
{
    $duplicated = false;
    try {
        $connection = connectDB();

        // Get the data of the session that we want to duplicate
        $statement = $connection->prepare("SELECT professor_id, subject_id FROM session WHERE id=:session_id");
        $statement->execute(array(":session_id" => $session_id));
        $session = $statement->fetch();

        $statement = $connection->prepare("SELECT problem_id FROM session_problems WHERE session_id=:session_id");
        $statement->execute(array(":session_id" => $session_id));
        $problem_ids = $statement->fetchAll(PDO::FETCH_COLUMN);

        // Use the data to create the new session
        createSession($session_name, $session["professor_id"], $session["subject_id"], $problem_ids);

        $connection = null;
        $duplicated = True;
    } catch (PDOException $e) {
        echo 'Error duplicating the session: ' . $e->getMessage();
    }
    return $duplicated;
}
