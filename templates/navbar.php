<?php 

session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

?>
<body class="">
    <!-- [ Pre-loader ] start -->
<!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
        <div class="navbar-wrapper ">
            <div class="navbar-brand header-logo">
                <a href="index.php" class="b-brand">
                    <h3 class="text-white">My Holidays</h3>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="../alternatif/index.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Data Alternatif</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="../kriteria/index.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Data Kriteria</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="../penilaian/index.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Penilaian</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="../hasil/proses-saw.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-target"></i></span><span class="pcoded-mtext">Proses Perhitungan</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="../hasil/hasil-keputusan.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-printer"></i></span><span class="pcoded-mtext">Data Hasil Keputusan</span></a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>User Management</label>
                    </li>
                    <li class="nav-item">
                        <a href="../user/index.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Data Users</span></a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <hr>
                        <a href="#" class="nav-link"><span class="pcoded-micon"><i class=""></i></span><span class="pcoded-mtext">Xinar Your Zero</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            <a href="index.php" class="b-brand">
                <img src="../assets/images/logo.png" alt="codeir" width="40" class="logo images">
                <img src="../assets/images/logo-icon.svg" alt="" class="logo-thumb images">
            </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li>    
                    <span class="mr-n5"><?= ucfirst($_SESSION['login']); ?></span>
                </li> 
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <ul class="pro-body">
                                <li><a href="logout.php" class="dropdown-item"><i class="feather icon-log-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <!-- [ Header ] end