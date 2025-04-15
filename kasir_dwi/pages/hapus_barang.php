<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

include '../config/koneksi.php';

if (isset($_GET['ProdukID'])) {
    $id = $_GET['ProdukID'];
    $sql = "DELETE FROM produk WHERE ProdukID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Produk berhasil dihapus!'); window.location='data_barang.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk!'); window.location='data_barang.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
