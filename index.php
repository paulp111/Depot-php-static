<?php

spl_autoload_register(function ($class) {
    include $class . '.php';
});

$data = [
    'balance' => 3000.00,
    'iban' => 'AT1234567890',
    'owner' => 'Lukas Ludwig',
    'stocks' => [
        ['id' => 1, 'label' => 'MSFT', 'price' => 240.0, 'amount' => 10],
        ['id' => 2, 'label' => 'AAPL', 'price' => 304.0, 'amount' => 5],
        ['id' => 3, 'label' => 'PYPL', 'price' => 102.0, 'amount' => 2],
        ['id' => 4, 'label' => 'NVDA', 'price' => 756.0, 'amount' => 1]
    ]
];

$depot = Depot::fromArray($data);
var_dump($depot);

include 'header.php';
?>
<main style="padding: 0;">
    <table>
        <tr>
            <th>Label</th>
            <th>Price/Piece</th>
            <th>Amount</th>
            <th>Value</th>
        </tr>
        <?php foreach ($depot->getStocks() as $stock) : ?>
            <tr>
                <td><?= $stock->label ?></td>
                <td><?= $stock->price ?></td>
                <td><?= $stock->amount ?></td>
                <td><?= $stock->price * $stock->amount ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td>Balance</td>
            <td></td>
            <td></td>
            <td><?= $depot->balance ?></td>
        </tr>
    </table>
</main>
<?php include 'footer.php'; ?>
