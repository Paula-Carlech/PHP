<?php

$products = [
    [
        "id" => 1,
        "name" => "Notebook",
        "price" => 3500,
        "stock" => 5
    ],
    [
        "id" => 2,
        "name" => "Mouse",
        "price" => 120,
        "stock" => 10
    ],
    [
        "id" => 3,
        "name" => "Headset",
        "price" => 280,
        "stock" => 8
    ]
];

$orders = [];

function listProducts(array $products): void
{
    foreach ($products as $product) {

        printf(
            "[%d] %s - R$%d | Stock: %d\n",
            $product["id"],
            $product["name"],
            $product["price"],
            $product["stock"]
        );
    }
}

function findProductById(array $products, int $id)
{
    foreach ($products as $product) {

        if ($product["id"] === $id) {
            return $product;
        }
    }

    return null;
}

function validateStock(array $product, int $quantity): bool
{
    return $product["stock"] >= $quantity;
}

function createOrder(array &$orders, array &$products, array $items)
{
    $total = 0;

    foreach ($items as $item) {

        $product = findProductById(
            $products,
            $item["product_id"]
        );

        if (!validateStock($product, $item["quantity"])) {

            echo "Product {$product["name"]} has no stock\n";
            return;
        }

        $subtotal = $product["price"] * $item["quantity"];

        $total += $subtotal;

        foreach ($products as &$currentProduct) {

            if ($currentProduct["id"] === $item["product_id"]) {

                $currentProduct["stock"] -= $item["quantity"];
            }
        }
    }

    $order = [
        "id" => count($orders) + 1,
        "items" => $items,
        "total" => $total
    ];

    $orders[] = $order;

    echo "Order created successfully.\n";
}

function showOrders(array $orders, array $products)
{
    foreach ($orders as $order) {

        printf(
            "Order #%d - Total: R$%d\n",
            $order["id"],
            $order["total"]
        );

        foreach ($order["items"] as $item) {

            $product = findProductById(
                $products,
                $item["product_id"]
            );

            printf(
                "- %s | Qty: %d\n",
                $product["name"],
                $item["quantity"]
            );
        }

        echo "\n";
    }
}

echo "=== PRODUCTS BEFORE ORDER ===\n";

listProducts($products);

echo "\n";

createOrder($orders, $products, [
    [
        "product_id" => 1,
        "quantity" => 1
    ],
    [
        "product_id" => 2,
        "quantity" => 2
    ]
]);

echo "\n=== ORDERS ===\n";

showOrders($orders, $products);

echo "\n=== PRODUCTS AFTER ORDER ===\n";

listProducts($products);
