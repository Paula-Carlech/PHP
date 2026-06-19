<?php

$students = [
    [
        "id" => 1,
        "name" => "John",
        "grade" => 8.5
    ],
    [
        "id" => 2,
        "name" => "Mary",
        "grade" => 6.0
    ],
    [
        "id" => 3,
        "name" => "Peter",
        "grade" => 4.5
    ]
];

function listStudents(array $students): void
{
    echo "List of Students:\n";
    foreach ($students as $student) {
        printf(
            "[%d] %s - %.2f\n",
            $student["id"],
            $student["name"],
            $student["grade"]
        );
    }
}

function findStudentById(array $students, int $id): array
{
    foreach ($students as $student) {
        if ($student["id"] === $id) {
            return $student;
        }
    }
    return [];
}

function updateGrade(array &$students, int $id, float $grade): void
{
    foreach ($students as &$student) {
        if ($student["id"] === $id) {
            $student["grade"] = $grade;
            echo "Grade updated.\n";
            return;
        }
    }
    echo "Student not found.\n";
}

function showApprovedStudents(array $students): void
{
    echo "Approved Students:\n";
    foreach ($students as $student) {
        if ($student["grade"] >= 7) {
            printf(
                "[%d] %s - %.2f\n",
                $student["id"],
                $student["name"],
                $student["grade"]
            );
        }
    }
}

function showFailedStudents(array $students): void
{
    echo "Failed Students:\n";
    foreach ($students as $student) {
        if ($student["grade"] < 7) {

            printf(
                "[%d] %s - %.2f\n",
                $student["id"],
                $student["name"],
                $student["grade"]
            );
        }
    }
}

function calculateAverageGrade(array $students): void
{
    $sumGrades = 0;
    foreach ($students as $student) {
        $sumGrades += $student["grade"];
    }
    $average = $sumGrades / count($students);
    printf(
        "Average Grade: %.2f\n",
        $average
    );
}

echo "=== INITIAL STUDENTS ===\n";

listStudents($students);

echo "\n";

updateGrade($students, 2, 7.5);

echo "\n=== AFTER GRADE UPDATE ===\n";

listStudents($students);

echo "\n";

showApprovedStudents($students);

echo "\n";

showFailedStudents($students);

echo "\n";

calculateAverageGrade($students);
