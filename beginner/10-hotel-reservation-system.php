<?php

$rooms = [
    [
        "id" => 1,
        "number" => 101,
        "capacity" => 2,
        "reserved" => false
    ],
    [
        "id" => 2,
        "number" => 102,
        "capacity" => 4,
        "reserved" => false
    ],
    [
        "id" => 3,
        "number" => 103,
        "capacity" => 1,
        "reserved" => true
    ]
];

function listRooms(array $rooms): void
{
    echo "List Rooms:\n";
    foreach ($rooms as $room) {
        $status = $room["reserved"]
            ? "Reserved"
            : "Available";
        printf(
            "[%d] Room: %d\nCapacity: %d\nStatus: %s\n--------------------------\n",
            $room["id"],
            $room["number"],
            $room["capacity"],
            $status
        );
    }
}

function findRoomById(array $rooms, int $id): array
{
    foreach ($rooms as $room) {
        if ($room["id"] === $id) {
            return $room;
        }
    }
    return [];
}

function reserveRoom(array &$rooms, int $id): void
{
    foreach ($rooms as &$room) {
        if ($room["id"] === $id) {
            if (!$room["reserved"]) {
                $room["reserved"] = true;
                echo "Room reserved.\n";
            } else {
                echo "Room already reserved.\n";
            }
            return;
        }
    }
    echo "Room not found.\n";
}

function cancelReservation(array &$rooms, int $id): void
{
    foreach ($rooms as &$room) {
        if ($room["id"] === $id) {
            if ($room["reserved"]) {
                $room["reserved"] = false;
                echo "Reservation canceled.\n";
            } else {
                echo "Room is not reserved.\n";
            }
            return;
        }
    }
    echo "Room not found.\n";
}

function showAvailableRooms(array $rooms): void
{
    echo "Available Rooms:\n";
    foreach ($rooms as $room) {
        if (!$room["reserved"]) {
            printf(
                "[%d] Room: %d\nCapacity: %d\n",
                $room["id"],
                $room["number"],
                $room["capacity"]
            );
        }
    }
}

function showReservedRooms(array $rooms): void
{
    echo "Reserved Rooms:\n";
    foreach ($rooms as $room) {
        if ($room["reserved"]) {
            printf(
                "[%d] Room: %d\nCapacity: %d\n",
                $room["id"],
                $room["number"],
                $room["capacity"]
            );
        }
    }
}

echo "=== INITIAL ROOMS ===\n";

listRooms($rooms);

echo "\n";

reserveRoom($rooms, 1);

echo "\n=== AFTER RESERVATION ===\n";

listRooms($rooms);

echo "\n";

showAvailableRooms($rooms);

echo "\n";

showReservedRooms($rooms);

echo "\n";

cancelReservation($rooms, 1);

echo "\n=== AFTER CANCEL RESERVATION ===\n";

listRooms($rooms);
