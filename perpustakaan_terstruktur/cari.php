<?php
function cari($keyword)
{
    $link = mysqli_connect("127.0.0.1", "root", "", "perpustakaan");
    if (!$link) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Pastikan keyword tidak kosong
    $keyword = mysqli_real_escape_string($link, $keyword);
    $query = "SELECT id, judul FROM buku WHERE judul LIKE '%$keyword%'";
    $result = mysqli_query($link, $query);

    // Inisialisasi array kosong agar tidak undefined
    $listbuku = [];

    while ($row = mysqli_fetch_array($result)) {
        $listbuku[] = $row;
    }

    mysqli_close($link);
    return $listbuku;
}

function display($listbuku)
{
    echo "<br><table border=1 style='width:50%'>";
    echo "<tr><th style='width:10%'>ID</th><th style='width:60%'>Judul</th><th></th></tr>";

    // Jika hasil pencarian kosong, tampilkan pesan
    if (empty($listbuku)) {
        echo "<tr><td colspan='3' style='text-align:center;'> Buku tidak ditemukan.</td></tr>";
    } else {
        foreach ($listbuku as $row) {
            echo "<tr>
                    <td style='text-align:center;'>$row[0]</td>
                    <td>$row[1]</td>
                    <td style='text-align:center;'>
                        <a href='./pinjam/pinjam.php?fitur=add&idbuku=$row[0]&judul=$row[1]'>Pinjam</a>
                    </td>
                </tr>";
        }
    }

    echo "</table>";
}
?>

<form method="get">
    <input type='text' name="keyword" placeholder="Cari judul buku..." />
    <input type='submit' value="CARI" />
</form>
<a href='./pinjam/pinjam.php?fitur=read'>Lihat Keranjang</a>
<a href='index.php'>Kembali</a>
<br>
