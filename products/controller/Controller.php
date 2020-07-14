<?php

namespace products;

use LogicException;
use request\Request;
use response\RequestResponse;
use validation\NumberValidator;
use validation\SkuValidator;
use validation\StringValidator;

class Controller
{
    private RequestResponse $requestResponse;
    private ProductRepository $productRepository;


    public function __construct(ProductRepository $products, RequestResponse $response)
    {
        $this->productRepository = $products;
        $this->requestResponse = $response;
    }

    public function productList()
    {
        $products = new \stdClass();
        $obtainedProducts = $this->productRepository->findProducts();
        foreach ($obtainedProducts as $product) {
            $products->products[] = $product->serialize();
        }
        $this->requestResponse->respond(true, []);
    }

    public function productCreate(): void
    {
        $name = Request::getRequestParam("name");
        $price = Request::getRequestParam("price");
        $sku = Request::getRequestParam("sku");
        if (!SkuValidator::isValid($sku) || !StringValidator::isValid($name) || !NumberValidator::isValid($price)) {
            $this->requestResponse->respond(false, "Invalid input");
            return;
        }
        $product = new Product($name, $price, $sku);

        try {
            $createdProduct = $this->productRepository->create($product);
        } catch (LogicException $exception) {
            $this->requestResponse->respond(false, $exception->getMessage());
            return;
        }

        if ($createdProduct !== null) {
            $this->requestResponse->respond(true, $createdProduct->serialize());
            return;
        }

        $this->requestResponse->respond(false, null);
    }

    public function productUpdate(): void
    {
        $id = Request::getRequestParam("id");
        if (!NumberValidator::isValid($id)) {
            $this->requestResponse->respond(false, "Invalid input");
            return;
        }
        $foundProduct = $this->productRepository->findProduct($id);
        if ($foundProduct !== null) {
            $updatedProduct = $this->productRepository->update($this->updateFromRequestProduct($foundProduct));
            $this->requestResponse->respond(true, $updatedProduct->serialize());
            return;
        } else {
            $this->requestResponse->respond(false, "Product not found");
            return;
        }
    }

    private function updateFromRequestProduct(Product $product): Product
    {
        $name = Request::getRequestParam("name") ?? $product->getName();
        $price = Request::getRequestParam("price") ?? $product->getPrice();
        $sku = Request::getRequestParam("sku") ?? $product->getSku();

        $newProduct = new Product($name, $price, $sku);
        $newProduct->setId($product->getId());
        $newProduct->setDeleted($product->getDeleted());

        return $newProduct;
    }

    public function productDelete(): void
    {
        $id = Request::getRequestParam("id");
        if (!NumberValidator::isValid($id)) {
            $this->requestResponse->respond(false, "Invalid input");
            return;
        }
        $foundProduct = $this->productRepository->findProduct($id);
        if ($foundProduct !== null) {
            $this->productRepository->delete($foundProduct);
            $this->requestResponse->respond(true, "Product deleted");
            return;
        } else {
            $this->requestResponse->respond(false, "Product not found");
            return;
        }
    }
}