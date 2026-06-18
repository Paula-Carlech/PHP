<?php

$tasks = [
    [
        "id" => 1,
        "title" => "Study PHP",
        "completed" => false
    ],
    [
        "id" => 2,
        "title" => "Read Clean Code",
        "completed" => true
    ],
    [
        "id" => 3,
        "title" => "Practice Arrays",
        "completed" => false
    ]
];

function listTasks(array $tasks): void
{
    foreach ($tasks as $task) {
        $status = $task["completed"]
            ? "Completed"
            : "Pending";

        printf(
            "[%d] %s - %s\n",
            $task["id"],
            $task["title"],
            $status
        );
    }
}

function findTaskById(array $tasks, int $id): array
{
    foreach ($tasks as $task) {
        if ($task["id"] === $id) {
            return $task;
        }
    }
    return [];
}

function completeTask(array &$tasks, int $id): void
{
    foreach ($tasks as &$task) {
        if ($task["id"] === $id) {
            if (!$task["completed"]) {
                $task["completed"] = true;
                echo "Task completed.\n";
            }
            return;
        }
    }
    echo "Task not found.\n";
}

function reopenTask(array &$tasks, int $id): void
{
    foreach ($tasks as &$task) {
        if ($task["id"] === $id) {
            if ($task["completed"]) {
                $task["completed"] = false;
                echo "Task reopened.\n";
            }
            return;
        }
    }
    echo "Task not found.\n";
}

function showCompletedTasks(array $tasks): void
{
    echo "Completed Tasks:\n";
    foreach ($tasks as $task) {
        if ($task["completed"]) {
            printf(
                "[%d] %s\n",
                $task["id"],
                $task["title"]
            );
        }
    }
}

function showPendingTasks(array $tasks): void
{
    echo "Pending Tasks:\n";
    foreach ($tasks as $task) {
        if (!$task["completed"]) {
            printf(
                "[%d] %s\n",
                $task["id"],
                $task["title"]
            );
        }
    }
}

echo "=== INITIAL TASKS ===\n";

listTasks($tasks);

echo "\n";

completeTask($tasks, 1);

echo "\n=== AFTER COMPLETE TASK ===\n";

listTasks($tasks);

echo "\n";

showCompletedTasks($tasks);

echo "\n";

showPendingTasks($tasks);

echo "\n";

reopenTask($tasks, 1);

echo "\n=== AFTER REOPEN TASK ===\n";

listTasks($tasks);
