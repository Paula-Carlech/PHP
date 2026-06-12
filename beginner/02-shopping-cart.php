<?php

$products = [
    [
        "id" => 1,
        "name" => "Notebook",
        "price" => 3500
    ],
    [
        "id" => 2,
        "name" => "Mouse",
        "price" => 120
    ],
    [
        "id" => 3,
        "name" => "Headset",
        "price" => 280
    ]
];

$cart = [];

function listProducts(array $products): void
{
    foreach ($products as $product) {
        printf(
            "[%d] %s - %d\n",
            $product["id"],
            $product["name"],
            $product["price"]
        );
    }
}

function addToCart(array &$cart, array $products, int $productId, int $quantity)
{
    foreach ($cart as &$item) {

        if ($item["product_id"] === $productId) {

            $item["quantity"] += $quantity;
            return;
        }
    }

    $cart[] = [
        "product_id" => $productId,
        "quantity" => $quantity
    ];
}

function showCart(array $cart, array $products): void
{
    foreach ($cart as $item) {

        foreach ($products as $product) {

            if ($product["id"] === $item["product_id"]) {

                $total = $product["price"] * $item["quantity"];

                printf(
                    "%s | Qty: %d | Total: R$%d\n",
                    $product["name"],
                    $item["quantity"],
                    $total
                );
            }
        }
    }
}

function calculateCartTotal(array $cart, array $products): float
{
    $total = 0;

    foreach ($cart as $item) {

        foreach ($products as $product) {

            if ($product["id"] === $item["product_id"]) {

                $subtotal = $product["price"] * $item["quantity"];

                $total += $subtotal;
            }
        }
    }

    return $total;
}

function removeFromCart(array &$cart, int $productId, int $quantity): array
{
    foreach ($cart as $index => &$item) {

        if ($item["product_id"] === $productId) {

            if ($item["quantity"] >= $quantity) {

                $item["quantity"] -= $quantity;
            }

            if ($item["quantity"] <= 0) {

                unset($cart[$index]);
            }
        }
    }

    return $cart;
}

addToCart($cart, $products, 1, 2);

showCart($cart, $products);

echo "\n";

removeFromCart($cart, 1, 1);

showCart($cart, $products);

echo "\n";

printf(
    "Total Cart: R$%d\n",
    calculateCartTotal($cart, $products)
);
