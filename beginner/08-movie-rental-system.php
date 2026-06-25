<?php

$movies = [
    [
        "id" => 1,
        "title" => "Interstellar",
        "available" => true
    ],
    [
        "id" => 2,
        "title" => "The Matrix",
        "available" => true
    ],
    [
        "id" => 3,
        "title" => "Inception",
        "available" => false
    ]
];

function listMovies(array $movies): void
{
    foreach ($movies as $movie) {

        $status = $movie["available"]
            ? "Available"
            : "Not Available";

        printf(
            "[%d] %s - %s\n",
            $movie["id"],
            $movie["title"],
            $status
        );
    }
}

function findMovieById(array $movies, int $id): array
{
    foreach ($movies as $movie) {

        if ($movie["id"] === $id) {
            return $movie;
        }
    }

    return [];
}

function rentMovie(array &$movies, int $id): void
{
    foreach ($movies as &$movie) {

        if ($movie["id"] === $id) {

            if ($movie["available"]) {

                $movie["available"] = false;
                echo "Movie rented.\n";

            } else {

                echo "Movie is already rented.\n";
            }

            return;
        }
    }

    echo "Movie not found.\n";
}

function returnMovie(array &$movies, int $id): void
{
    foreach ($movies as &$movie) {

        if ($movie["id"] === $id) {

            if (!$movie["available"]) {

                $movie["available"] = true;
                echo "Movie returned.\n";

            } else {

                echo "Movie already available.\n";
            }

            return;
        }
    }

    echo "Movie not found.\n";
}

function showAvailableMovies(array $movies): void
{
    echo "Available Movies\n";

    foreach ($movies as $movie) {

        if ($movie["available"]) {

            printf(
                "[%d] %s - Available\n",
                $movie["id"],
                $movie["title"]
            );
        }
    }
}

function showRentedMovies(array $movies): void
{
    echo "Rented Movies\n";

    foreach ($movies as $movie) {

        if (!$movie["available"]) {

            printf(
                "[%d] %s - Rented\n",
                $movie["id"],
                $movie["title"]
            );
        }
    }
}

echo "=== INITIAL MOVIES ===\n";

listMovies($movies);

echo "\n";

rentMovie($movies, 1);

echo "\n=== AFTER RENT MOVIE ===\n";

listMovies($movies);

echo "\n";

showAvailableMovies($movies);

echo "\n";

showRentedMovies($movies);

echo "\n";

returnMovie($movies, 1);

echo "\n=== AFTER RETURN MOVIE ===\n";

listMovies($movies);
