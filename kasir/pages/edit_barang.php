<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

include '../config/koneksi.php';

if (isset($_GET['ProdukID'])) {
    $id = $_GET['ProdukID'];
    $sql = "SELECT * FROM produk WHERE ProdukID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $produk = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "UPDATE produk SET NamaProduk=?, Harga=?, Stok=? WHERE ProdukID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $nama, $harga, $stok, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Produk berhasil diperbarui!'); window.location='data_barang.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk!'); window.location='data_barang.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Produk</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control" 
                       value="<?php echo $produk['NamaProduk']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" 
                       value="<?php echo $produk['Harga']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" 
                       value="<?php echo $produk['Stok']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="data_barang.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
