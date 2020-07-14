<?php

namespace products;

interface ProductRepository
{
    function findProducts(): array;

    function findProduct(int $id): ?Product;

    function create(Product $product): ?Product;

    function update(Product $product): ?Product;

    function delete(Product $product): ?Product;
}