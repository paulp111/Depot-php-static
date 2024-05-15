<?php

declare(strict_types=1);

class Stock
{
    public function __construct(
        public int $id,
        public string $label,
        public float $price,
        public int $amount
    ) {
    }
}
