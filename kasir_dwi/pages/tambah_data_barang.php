<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $barcode = $_POST['barcode'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO produk (Barcode, NamaProduk, Harga, Stok) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $barcode, $nama_produk, $harga, $stok);

    if ($stmt->execute()) {
        header('Location: data_barang.php?pesan=berhasil');
        exit();
    } else {
        header('Location: tambah_data_barang.php?pesan=gagal');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="icon" href="../asset/favicon-16x16.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Tambah Produk</h2>

    <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil') : ?>
        <div class="alert alert-success">✅ Produk berhasil ditambahkan.</div>
    <?php elseif (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') : ?>
        <div class="alert alert-danger">❌ Gagal menambahkan produk. Silakan periksa input dan coba lagi.</div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="barcode" class="form-label">Barcode</label>
            <input type="number" class="form-control" id="barcode" name="barcode" required>
        </div>
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Produk</button>
        <a href="data_barang.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
