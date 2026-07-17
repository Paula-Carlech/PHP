<?php

$students = [
    [
        "id" => 1,
        "name" => "John"
    ],
    [
        "id" => 2,
        "name" => "Mary"
    ],
    [
        "id" => 3,
        "name" => "Peter"
    ]
];

$courses = [
    [
        "id" => 1,
        "name" => "PHP"
    ],
    [
        "id" => 2,
        "name" => "JavaScript"
    ],
    [
        "id" => 3,
        "name" => "Database"
    ]
];

$enrollments = [];

function findStudentById(array $students, int $id): array
{
    foreach ($students as $student) {
        if ($student["id"] === $id) {
            return $student;
        }
    }

    return [];
}

function findCourseById(array $courses, int $id): array
{
    foreach ($courses as $course) {
        if ($course["id"] === $id) {
            return $course;
        }
    }

    return [];
}

function enrollStudent(
    array &$enrollments,
    array $students,
    array $courses,
    int $studentId,
    int $courseId
): void {
    $student = findStudentById($students, $studentId);

    if (!$student) {
        echo "Student not found.\n";
        return;
    }

    $course = findCourseById($courses, $courseId);

    if (!$course) {
        echo "Course not found.\n";
        return;
    }

    foreach ($enrollments as $enrollment) {
        if (
            $enrollment["student_id"] === $studentId
            && $enrollment["course_id"] === $courseId
        ) {
            echo "Student already enrolled.\n";
            return;
        }
    }

    $enrollments[] = [
        "student_id" => $studentId,
        "course_id" => $courseId
    ];

    echo "Student enrolled.\n";
}

function cancelEnrollment(
    array &$enrollments,
    int $studentId,
    int $courseId
): void {
    foreach ($enrollments as $index => $enrollment) {
        if (
            $enrollment["student_id"] === $studentId
            && $enrollment["course_id"] === $courseId
        ) {
            unset($enrollments[$index]);

            echo "Enrollment canceled.\n";
            return;
        }
    }

    echo "Enrollment not found.\n";
}

function showStudentCourses(
    array $enrollments,
    array $students,
    array $courses,
    int $studentId
): void {
    $student = findStudentById($students, $studentId);

    if (!$student) {
        echo "Student not found.\n";
        return;
    }

    echo "{$student["name"]}'s Courses:\n";

    foreach ($enrollments as $enrollment) {
        if ($enrollment["student_id"] === $studentId) {
            $course = findCourseById(
                $courses,
                $enrollment["course_id"]
            );

            printf(
                "[%d] %s\n",
                $course["id"],
                $course["name"]
            );
        }
    }
}

function showCourseStudents(
    array $enrollments,
    array $students,
    array $courses,
    int $courseId
): void {
    $course = findCourseById($courses, $courseId);

    if (!$course) {
        echo "Course not found.\n";
        return;
    }

    echo "{$course["name"]} Students:\n";

    foreach ($enrollments as $enrollment) {
        if ($enrollment["course_id"] === $courseId) {
            $student = findStudentById(
                $students,
                $enrollment["student_id"]
            );

            printf(
                "[%d] %s\n",
                $student["id"],
                $student["name"]
            );
        }
    }
}

enrollStudent($enrollments, $students, $courses, 1, 1);
enrollStudent($enrollments, $students, $courses, 1, 2);
enrollStudent($enrollments, $students, $courses, 2, 1);

echo "\n=== JOHN'S COURSES ===\n";

showStudentCourses(
    $enrollments,
    $students,
    $courses,
    1
);

echo "\n=== PHP STUDENTS ===\n";

showCourseStudents(
    $enrollments,
    $students,
    $courses,
    1
);

echo "\n";

cancelEnrollment($enrollments, 1, 2);

echo "\n=== JOHN'S COURSES AFTER CANCELLATION ===\n";

showStudentCourses(
    $enrollments,
    $students,
    $courses,
    1
);
