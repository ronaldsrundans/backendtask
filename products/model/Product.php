<?php

namespace products;

class Product
{
    private int $id;
    private string $name;
    private int $price;
    private string $sku;
    private bool $deleted;

    public function __construct(string $name, int $price, string $sku)
    {
        $this->name = $name;
        $this->price = $price;
        $this->sku = $sku;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    public function __toString()
    {
        return "Product: " . $this->name;
    }

    public function serialize(): ProductDto
    {
        $productDto = new ProductDto();
        $productDto->id = $this->id;
        $productDto->name = $this->name;
        $productDto->price = $this->price;
        $productDto->sku = $this->sku;

        return $productDto;
    }

}