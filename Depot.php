<?php

declare(strict_types=1);

class Depot
{
    public function __construct(
        private array $stocks = [],
        public float $balance = 0.0,
        public string $iban = '',
        public string $owner = ''
    ) {
    }

    public static function fromArray(array $data): self
    {
        $stocks = [];
        foreach ($data['stocks'] as $stockData) {
            $stocks[] = new Stock(
                id: $stockData['id'],
                label: $stockData['label'],
                price: $stockData['price'],
                amount: $stockData['amount']
            );
        }
        return new self(
            stocks: $stocks,
            balance: $data['balance'],
            iban: $data['iban'],
            owner: $data['owner']
        );
    }

    public function deposit(float $amount): void
    {
        $this->balance += $amount;
    }

    public function getStocks(): array
    {
        return $this->stocks;
    }

    public function buyStock(object $stock, int $amount): void
    {
        $price = $stock->price * $amount;
        if ($this->balance >= $price) {
            $this->balance -= $price;
            $stock->amount += $amount;
            $this->stocks[$stock->label] = $stock;
        }
    }

    public function sellStock(string $label, int $amount): void
    {
        $stock = $this->stocks[$label];
        if (!isset($stock)) {
            return;
        }
        if ($stock->amount >= $amount) {
            $stock->amount -= $amount;
            $this->balance += $stock->price * $amount;
        }
    }
}
