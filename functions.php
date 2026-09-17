<?php

function hitungNilaiStok($harga, $stok)
{
    return $harga * $stok;
}

function hitungTotalNilaiStok($products)
{
    $total = 0;

    foreach ($products as $product) {
        $total += hitungNilaiStok(
            $product["harga"],
            $product["stok"]
        );
    }

    return $total;
}

function stokKritis($stok)
{
    return $stok < 3;
}