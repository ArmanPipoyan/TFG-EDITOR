<?php

function problemTitleExists($title): bool
{
    $exists = True;
    try {
        $connection = connectDB();
        $statement = $connection->prepare("SELECT COUNT(*) FROM problem WHERE title= :title");
        $statement->execute(array(":title" => $title));
        $count = $statement->fetchColumn();
        $connection = null;

        $exists = $count != 0;
    } catch (PDOException $e) {
        echo 'Error looking for the problem with the specified title: ' . $e->getMessage();
    }

    return $exists;
}

function createProblem($route, $title, $description, $max_memory_usage, $visibility, $max_execution_time,
                       $language, $subject) : bool
{
    $created = false;
    try {
        $connection = connectDB();

        $statement = $connection->prepare(
            "INSERT INTO problem (route, title, description, visibility, memory, time, language, subject_id,
                     edited)
            VALUES (:route, :title, :description, :visibility, :max_memory_usage, :max_execution_time,
                    :programming_language, :subject, :edited)"
        );

        $statement->execute(array(":route" => $route, ":title" => $title, ":description" => $description,
            ":visibility" => $visibility, ":max_memory_usage" => $max_memory_usage, ":edited" => 0,
            ":max_execution_time" => $max_execution_time, ":programming_language" => $language, ":subject" => $subject)
        );

        $connection = null;
        $created = true;
    } catch (Exception $e) {
        echo "Error creating the problem: " . $e->getMessage();
    }
    return $created;
}

function createSubject($title, $description, $course) : bool
{
    $created = false;
    try {
        $connection = connectDB();

        $statement = $connection->prepare(
            "INSERT INTO subject (title, description, course) VALUES (:title, :description,:course)"
        );
        $statement->execute(array(":title" => $title, ":description" => $description, ":course" => $course));

        $connection = null;
        $created = true;
    } catch (Exception $e) {
        echo "Error creating the subject: " . $e->getMessage();
    }
    return $created;
}
