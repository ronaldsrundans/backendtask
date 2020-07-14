<?php

namespace products;

use database\Database;
use LogicException;

require_once("products/repository/ProductRepository.php");

class DatabaseRepository implements ProductRepository
{
    const TABLE_NAME = "products";
    private Database $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    public function findProduct(int $id): ?Product
    {
        $where = [
            ["name" => "id", "operation" => "=", "val" => $id]
        ];
        $productFromDb = $this->database->selectAllWhere(self::TABLE_NAME, $where);
        return empty($productFromDb) ? null : $this->transformDbRowToProduct($productFromDb[0]);
    }

    public function findProducts(): array
    {
        $result = [];
        $dbProducts = $this->database->selectAll(self::TABLE_NAME);
        foreach ($dbProducts as $dbProduct) {
            $result[] = $this->transformDbRowToProduct($dbProduct);
        }

        return $result;
    }

    public function create(Product $product): ?Product
    {
        $data = [
            ["val" => $product->getName(), "type" => "char"],
            ["val" => $product->getPrice(), "type" => "int"],
            ["val" => $product->getSku(), "type" => "char"],
        ];
        $fields = ["name", "price", "sku"];
        $isInserted = $this->database->insertInto(self::TABLE_NAME, $data, $fields);
        if (!$isInserted) {
            throw new LogicException("Product already exists!");
        }
        $where = [
            ["name" => "sku", "operation" => "=", "val" => $product->getSku()]
        ];
        $productFromDb = $this->database->selectAllWhere(self::TABLE_NAME, $where);

        return empty($productFromDb) ? null : $this->transformDbRowToProduct($productFromDb[0]);
    }

    private function transformDbRowToProduct(array $dbProduct): Product
    {
        $product = new Product($dbProduct["name"], $dbProduct["price"], $dbProduct["sku"]);
        $product->setId($dbProduct["id"]);
        $product->setDeleted($dbProduct["deleted"]);

        return $product;
    }

    public function update(Product $product): ?Product
    {
        $data = [
            ["name" => "name", "val" => $product->getName()],
            ["name" => "price", "val" => $product->getPrice()],
            ["name" => "sku", "val" => $product->getSku()],
        ];
        $this->database->update(self::TABLE_NAME, $data, $product->getId());

        $where = [
            ["name" => "id", "operation" => "=", "val" => $product->getId()]
        ];
        $productFromDb = $this->database->selectAllWhere(self::TABLE_NAME, $where);

        return empty($productFromDb) ? null : $this->transformDbRowToProduct($productFromDb[0]);
    }

    public function delete(Product $product): ?Product
    {
        $data = [
            ["name" => "deleted", "val" => 1],
        ];
        $this->database->update(self::TABLE_NAME, $data, $product->getId());

        $where = [
            ["name" => "id", "operation" => "=", "val" => $product->getId()]
        ];
        $productFromDb = $this->database->selectAllWhere(self::TABLE_NAME, $where);

        return empty($productFromDb) ? null : $this->transformDbRowToProduct($productFromDb[0]);
    }

    public function isNotDeleted(array $dbProduct): bool
    {
        return !$dbProduct["deleted"];
    }
}