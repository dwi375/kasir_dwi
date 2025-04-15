<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include '../config/koneksi.php';

$sql = "SELECT ProdukID, Barcode, NamaProduk, Harga, Stok FROM produk";
$result = $conn->query($sql);

if (!$result) {
    die("Query error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="icon" href="../asset/favicon-16x16.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="row">
        <?php include 'sidebar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Produk</h1>
            </div>

            <div class="container mt-4">
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <a href="tambah_data_barang.php" class="btn btn-primary mb-3">Tambah Produk</a>
                <?php endif; ?>
                <a href="dashboard.php" class="btn btn-secondary mb-3">Kembali</a>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Barcode</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <?php if ($_SESSION['role'] == 'admin'): ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . htmlspecialchars($row['Barcode']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['NamaProduk']) . "</td>";
                                echo "<td>Rp " . number_format($row['Harga'], 0, ',', '.') . "</td>";
                                echo "<td>" . $row['Stok'] . "</td>";

                                if ($_SESSION['role'] == 'admin') {
                                    echo "<td>
                                            <a href='edit_barang.php?ProdukID=" . $row['ProdukID'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                            <a href='hapus_barang.php?ProdukID=" . $row['ProdukID'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'>Hapus</a>
                                          </td>";
                                }
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Tidak ada data produk.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>
