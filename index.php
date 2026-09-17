<?php

require_once "products.php";
require_once "functions.php";

$totalNilaiStok = hitungTotalNilaiStok($products);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product Information System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f6f8;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .total {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th {
            background-color: #333;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        tr.stok-kritis {
            background-color: #ffcccc;
        }

        .peringatan {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>Product Information System</h1>

    <div class="total">
        Total Nilai Seluruh Stok:
        Rp <?= number_format($totalNilaiStok, 0, ',', '.') ?>
    </div>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Nilai Stok</th>
                <th>Deskripsi</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($products as $product): ?>

                <tr class="<?= stokKritis($product['stok']) ? 'stok-kritis' : '' ?>">

                    <td><?= $product["id"] ?></td>

                    <td><?= $product["nama"] ?></td>

                    <td><?= $product["kategori"] ?></td>

                    <td>
                        Rp <?= number_format($product["harga"], 0, ',', '.') ?>
                    </td>

                    <td>
                        <?= $product["stok"] ?>

                        <?php if (stokKritis($product["stok"])): ?>
                            <span class="peringatan">
                                ⚠ Stok Kritis
                            </span>
                        <?php endif; ?>

                    </td>

                    <td>
                        Rp <?= number_format(
                            hitungNilaiStok(
                                $product["harga"],
                                $product["stok"]
                            ),
                            0,
                            ',',
                            '.'
                        ) ?>
                    </td>

                    <td><?= $product["deskripsi"] ?></td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</body>
</html>