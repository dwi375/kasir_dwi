<nav class="col-md-3 col-lg-2 d-md-block sidebar bg-dark">
    <div class="text-center py-3">
        <img src="../asset/jkt48.png" alt="Logo" class="img-fluid" style="max-width: 100px;">
        <h2 class="text-white mt-2">Kasir</h2>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white" href="dashboard.php">
                <i class="fas fa-home"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="penjualan.php">
                <i class="fas fa-shopping-cart"></i> Penjualan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="data_barang.php">
                <i class="fas fa-box"></i> Data Barang
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="data_penjualan.php">
                <i class="fas fa-receipt"></i> Data Penjualan
            </a>
        </li>
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="kelola_user.php">
                    <i class="fas fa-users"></i> User
                </a>
            </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
