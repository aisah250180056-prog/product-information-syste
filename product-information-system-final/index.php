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
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        .container {
            width: min(1180px, calc(100% - 32px));
            margin: 40px auto;
        }

        .header {
            background: #ffffff;
            border-radius: 18px;
            padding: 28px 30px;
            margin-bottom: 20px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.07);
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 30px;
            color: #163a63;
        }

        .header p {
            margin: 0;
            color: #64748b;
            line-height: 1.6;
        }

        .table-wrapper {
            background: #ffffff;
            border-radius: 18px;
            padding: 18px;
            overflow-x: auto;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.07);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            background: #163a63;
            color: #ffffff;
            text-align: left;
            padding: 14px 12px;
            font-size: 14px;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .stock-critical {
            color: #b42318;
            font-weight: 700;
            background: #fff1f0;
        }

        .stock-normal {
            color: #166534;
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            margin-left: 7px;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-critical {
            color: #b42318;
            background: #fee4e2;
        }

        .badge-normal {
            color: #166534;
            background: #dcfce7;
        }

        .total-card {
            margin-top: 20px;
            background: #163a63;
            color: #ffffff;
            border-radius: 16px;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .total-label {
            font-size: 14px;
            opacity: 0.85;
            margin-bottom: 5px;
        }

        .total-description {
            font-size: 13px;
            opacity: 0.75;
        }

        .total-value {
            font-size: 25px;
            font-weight: 700;
            white-space: nowrap;
        }

        @media (max-width: 760px) {
            .container {
                width: min(100% - 20px, 1180px);
                margin: 20px auto;
            }

            .header h1 {
                font-size: 24px;
            }

            .total-card {
                align-items: flex-start;
                flex-direction: column;
            }

            .total-value {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <main class="container">

        <section class="header">
            <h1>Product Information System</h1>
            <p>
                Sistem informasi sederhana untuk menampilkan data produk,
                stok, dan nilai stok yang tersedia di gudang.
            </p>
        </section>

        <section class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th>Nilai Stok</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($products as $product): ?>

                        <?php
                        $nilaiStok = hitungNilaiStok(
                            $product["harga"],
                            $product["stok"]
                        );

                        $kritis = stokKritis($product["stok"]);
                        ?>

                        <tr>
                            <td><?= htmlspecialchars($product["id"]) ?></td>
                            <td><strong><?= htmlspecialchars($product["nama"]) ?></strong></td>
                            <td><?= htmlspecialchars($product["kategori"]) ?></td>
                            <td>
                                Rp <?= number_format($product["harga"], 0, ",", ".") ?>
                            </td>
                            <td class="<?= $kritis ? "stock-critical" : "stock-normal" ?>">
                                <?= htmlspecialchars($product["stok"]) ?>

                                <?php if ($kritis): ?>
                                    <span class="badge badge-critical">Stok Kritis</span>
                                <?php else: ?>
                                    <span class="badge badge-normal">Normal</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($product["deskripsi"]) ?></td>
                            <td>
                                Rp <?= number_format($nilaiStok, 0, ",", ".") ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="total-card">
            <div>
                <div class="total-label">Total Nilai Aset Gudang</div>
                <div class="total-description">
                    Total nilai seluruh stok produk.
                </div>
            </div>

            <div class="total-value">
                Rp <?= number_format($totalNilaiStok, 0, ",", ".") ?>
            </div>
        </section>

    </main>

</body>
</html>
