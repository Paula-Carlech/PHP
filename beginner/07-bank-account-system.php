<?php

$accounts = [
    [
        "id" => 1,
        "owner" => "Alice",
        "balance" => 1000.00
    ],
    [
        "id" => 2,
        "owner" => "Bob",
        "balance" => 500.00
    ],
    [
        "id" => 3,
        "owner" => "Charlie",
        "balance" => 0.00
    ]
];

function listAccounts(array $accounts): void
{
    echo "List Accounts:\n";
    foreach ($accounts as $account) {
        printf(
            "[%d] %s - R$%.2f\n",
            $account["id"],
            $account["owner"],
            $account["balance"]
        );
    }
}

function findAccountById(array $accounts, int $id): array
{
    foreach ($accounts as $account) {
        if ($account["id"] === $id) {
            return $account;
        }
    }
    return [];
}

function deposit(array &$accounts, int $id, float $value): void
{
    foreach ($accounts as &$account) {
        if ($account["id"] === $id) {
            $account["balance"] += $value;
            echo "Deposit successfully completed.\n";
            return;
        }
    }
    echo "Account not found.\n";
}

function withdraw(array &$accounts, int $id, float $value): void
{
    foreach ($accounts as &$account) {
        if ($account["id"] === $id) {
            if ($account["balance"] >= $value) {
                $account["balance"] -= $value;
                echo "Withdraw successfully completed.\n";
            } else {
                echo "Invalid operation!\n";
            }
            return;
        }
    }
    echo "Account not found.\n";
}

function transfer(
    array &$accounts,
    int $idOwner,
    int $idReceiver,
    float $value
): void {
    foreach ($accounts as &$account) {
        if ($account["id"] === $idOwner) {
            if ($account["balance"] >= $value) {
                $account["balance"] -= $value;
            } else {
                echo "Invalid operation!\n";
                return;
            }
        }
    }

    foreach ($accounts as &$account) {
        if ($account["id"] === $idReceiver) {
            $account["balance"] += $value;
            echo "Transfer successfully completed.\n";
            return;
        }
    }
    echo "Receiver account not found.\n";
}

function showRichAccounts(array $accounts): void
{
    echo "List Rich Accounts:\n";
    foreach ($accounts as $account) {
        if ($account["balance"] >= 1000) {
            printf(
                "[%d] %s - R$%.2f\n",
                $account["id"],
                $account["owner"],
                $account["balance"]
            );
        }
    }
}

echo "=== INITIAL ACCOUNTS ===\n";

listAccounts($accounts);

echo "\n";

deposit($accounts, 1, 250);

echo "\n";

withdraw($accounts, 2, 100);

echo "\n";

transfer($accounts, 1, 3, 300);

echo "\n=== AFTER OPERATIONS ===\n";

listAccounts($accounts);

echo "\n";

showRichAccounts($accounts);
