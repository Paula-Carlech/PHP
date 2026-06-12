<?php

$products = [
    [
        "id" => 1,
        "name" => "Mouse Gamer",
        "price" => 150,
        "stock" => 10
    ],
    [
        "id" => 2,
        "name" => "Teclado Mecânico",
        "price" => 300,
        "stock" => 5
    ],
    [
        "id" => 3,
        "name" => "Monitor",
        "price" => 1200,
        "stock" => 2
    ]
];

function listProducts(array $products): void
{
    foreach ($products as $product) {
        printf(
            "[%d] - %s | Price: %d | Stock: %d\n",
            $product["id"],
            $product["name"],
            $product["price"],
            $product["stock"]
        );
    }
}

function findProductById(array $products, int $id): array
{
    foreach ($products as $product) {
        if ($product["id"] === $id) {
            return $product;
        }
    }

    return [];
}

function addStock(array &$products, int $id, int $stock): int
{
    foreach ($products as &$product) {
        if ($product["id"] === $id) {
            $product["stock"] += $stock;
            return $product["stock"];
        }
    }

    return 0;
}

function removeStock(array &$products, int $id, int $stock): int
{
    foreach ($products as &$product) {
        if ($product["id"] === $id) {

            if ($product["stock"] >= $stock) {
                $product["stock"] -= $stock;
            }

            return $product["stock"];
        }
    }

    return 0;
}

function totalStock(array $products): float
{
    $totalStock = 0;

    foreach ($products as $product) {
        $totalStock += $product["stock"] * $product["price"];
    }

    return $totalStock;
}

listProducts($products);

echo "\n";

addStock($products, 1, 5);
removeStock($products, 2, 2);

listProducts($products);

echo "\n";

printf(
    "Total inventory value: R$%.2f\n",
    totalStock($products)
);
