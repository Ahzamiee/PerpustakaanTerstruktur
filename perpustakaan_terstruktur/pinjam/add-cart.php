<?php
function add($idbuku, $judul)
{
    $cookie_name = "cart";
    $cart = isset($_COOKIE[$cookie_name]) ? json_decode($_COOKIE[$cookie_name], true) : [];

    // Pastikan cart selalu array
    if (!is_array($cart)) {
        $cart = [];
    }

    // 🔍 Cek apakah buku sudah ada di cart
    foreach ($cart as $row) {
        if ($row[0] == $idbuku) {
            echo "<script>alert('Buku sudah ada di keranjang!');</script>";
            return; // hentikan fungsi, jangan tambahkan duplikat
        }
    }

    // Tambahkan buku baru
    $cart[] = [$idbuku, $judul];
    setcookie($cookie_name, json_encode($cart));
}
?>
