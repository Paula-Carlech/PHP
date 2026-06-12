<?php

$books = [
    [
        "id" => 1,
        "title" => "Clean Code",
        "available" => true
    ],
    [
        "id" => 2,
        "title" => "Refactoring",
        "available" => true
    ],
    [
        "id" => 3,
        "title" => "Design Patterns",
        "available" => true
    ]
];

function listBooks(array $books): void
{
    foreach ($books as $book) {
        $status = $book["available"]
            ? "Available"
            : "Not Available";

        printf(
            "[%d] %s - %s\n",
            $book["id"],
            $book["title"],
            $status
        );
    }
}

function findBookById(array $books, int $id): array
{
    foreach ($books as $book) {
        if ($book["id"] === $id) {
            return $book;
        }
    }
    return [];
}

function borrowBook(array &$books, int $id): void
{
    foreach ($books as &$book) {
        if ($book["id"] === $id) {
            if ($book["available"]) {
                $book["available"] = false;
                echo "Book borrowed.\n";

            } else {
                echo "Book is not available.\n";
            }
            return;
        }
    }
    echo "Book not found.\n";
}

function returnBook(array &$books, int $id): void
{
    foreach ($books as &$book) {
        if ($book["id"] === $id) {
            if (!$book["available"]) {
                $book["available"] = true;
                echo "Book returned.\n";
            } else {
                echo "Book already available.\n";
            }
            return;
        }
    }
    echo "Book not found.\n";
}

function showAvailableBooks(array $books): void
{
    echo "Books Available:\n";
    foreach ($books as $book) {
        if ($book["available"]) {
            printf(
                "- %s\n",
                $book["title"]
            );
        }
    }
}

echo "=== ALL BOOKS ===\n";

listBooks($books);

echo "\n";

borrowBook($books, 1);

echo "\n=== AFTER BORROW ===\n";

listBooks($books);

echo "\n";

showAvailableBooks($books);

echo "\n";

returnBook($books, 1);

echo "\n=== AFTER RETURN ===\n";

listBooks($books);
