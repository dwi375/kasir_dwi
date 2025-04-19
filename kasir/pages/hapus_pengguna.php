<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

include '../config/koneksi.php';

if (isset($_GET['userID'])) {
    $id = $_GET['userID'];

    if ($id == 1) {
        echo "<script>alert('Admin utama tidak dapat dihapus!'); window.location='kelola_user.php';</script>";
        exit();
    }

    $sql = "DELETE FROM user WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Pengguna berhasil dihapus!'); window.location='kelola_user.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pengguna!'); window.location='kelola_user.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('UserID tidak ditemukan!'); window.location='kelola_user.php';</script>";
}
?>
