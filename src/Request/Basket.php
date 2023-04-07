<?php

namespace Past\Paytr\Request;

class Basket
{
    /**
     * @var array $products
     */
    private array $products = [];

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param array $products
     * @return $this
     */
    public function setProducts(array $products): self
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @param Product $product
     * @param int $quantity
     * @return $this
     */
    public function addProduct(Product $product, int $quantity): self

    {
        $this->products[] = [
            $product->getName(),
            $product->getPrice(),
            $quantity
        ];

        return $this;
    }

    public function getFormatted(): string
    {
        return htmlentities(json_encode($this->products));
    }
}