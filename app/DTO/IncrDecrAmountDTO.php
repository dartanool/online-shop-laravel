<?php

namespace App\DTO;

class IncrDecrAmountDTO
{
    public function __construct(
        private int $productId
    ){}

    public function getProductId(): int
    {
        return $this->productId;
    }
}
