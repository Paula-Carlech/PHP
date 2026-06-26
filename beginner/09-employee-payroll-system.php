<?php

$employees = [
    [
        "id" => 1,
        "name" => "John",
        "salary" => 5000,
        "bonus" => 0
    ],
    [
        "id" => 2,
        "name" => "Mary",
        "salary" => 3500,
        "bonus" => 0
    ],
    [
        "id" => 3,
        "name" => "Peter",
        "salary" => 2500,
        "bonus" => 0
    ]
];

function listEmployees(array $employees): void
{
    echo "List of Employees:\n";
    foreach($employees as $employee){
       $total = $employee["salary"] + $employee["bonus"];
       printf(
          "[%d] %s - R$%.2f\n Bonus: R$%.2f\n Total: R$%.2f\n --------------------------\n",
          $employee["id"],
          $employee["name"],
          $employee["salary"],
          $employee["bonus"],
          $total
        );
    }
}

function findEmployeeById(array $employees, int $id): array
{
    foreach($employees as $employee){
        if($employee["id"] === $id){
            return $employee;
        }
    }
    return [];
}

function increaseSalary(array &$employees, int $id, float $amount): void
{
    foreach($employees as &$employee){
        if($employee["id"] === $id){
            $employee["salary"] += $amount;
            echo "Salary increased.\n";
            return;
        }
    }
    echo "Employee not found.\n";
}

function applyBonus(array &$employees, int $id, float $bonus): void
{
    foreach($employees as &$employee){
        if($employee["id"] === $id){
            $employee["bonus"] = $bonus;
            echo "Bonus applied.\n";
            return;
        }
    }
    echo "Employee not found.\n";
}

function calculatePayroll(array $employees): float
{
    $payroll = 0;
    foreach ($employees as $employee) {
        $payroll += $employee["salary"] + $employee["bonus"];
    }

    return $payroll;
}

function showHighestSalary(array $employees): void
{
    $highestEmployee = [];
    $highestTotal = 0;

    foreach ($employees as $employee) {
        $total = $employee["salary"] + $employee["bonus"];
        if ($total > $highestTotal) {
            $highestTotal = $total;
            $highestEmployee = $employee;
        }
    }

    echo "Highest Salary:\n";
    printf(
        "[%d] %s - R$%.2f\n",
        $highestEmployee["id"],
        $highestEmployee["name"],
        $highestTotal
    );
}

echo "=== INITIAL EMPLOYEES ===\n";

listEmployees($employees);

echo "\n";

increaseSalary($employees, 2, 500);

echo "\n";

applyBonus($employees, 1, 1000);

echo "\n=== AFTER PAYROLL UPDATES ===\n";

listEmployees($employees);

echo "\n";

printf(
    "Total Payroll: R$%.2f\n",
    calculatePayroll($employees)
);

echo "\n";

showHighestSalary($employees);
