<?php
require "../functions.php";
$tittle = "Data Hasil Keputusan";
require('../templates/header.php');
require('../templates/navbar.php');

// $ranking = mysqli_query($conn, "SELECT * FROM ranking ORDER BY kode ASC");
// $ranking = mysqli_query($conn, "SELECT * FROM ranking JOIN alternatif ON ranking.kode_alt = alternatif.kode_alt JOIN periode ON periode.id=ranking.id_periode ORDER BY kode_rank ASC");
if(isset($_GET['tanggal'])){
    $tgl = $_GET['tanggal'];
    $ranking = mysqli_query($conn, "SELECT * FROM ranking JOIN alternatif ON ranking.kode_alt = alternatif.kode_alt WHERE created_at = '$tgl'");
}else{
    $ranking = mysqli_query($conn, "SELECT * FROM ranking JOIN alternatif ON ranking.kode_alt = alternatif.kode_alt ORDER BY kode_rank ASC");
}

// membuat array untuk rowspan dinamis
$arr = array();
while ($row = mysqli_fetch_object($ranking)) {
    // code...
    $arr[$row->kode_rank][] = $row;
}
?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="col-md-12 col-xl-12">
                        <div class="card card-social">
                            <div class="card-block border-bottom">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#!">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Hasil Keputusan</li>
                                    </ol>
                                </nav>
                                <h3>Data Hasil Kinerja Vendor/Supplier</h3>
                                <div class="row">
                                    <div class="col-3">
                                        <form method="get">
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="tanggal">
                                                <div class="input-group-append">
                                                  <button class="btn btn-primary" type="submit">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <a href="truncate-hasil-keputusan.php" class="btn btn-danger mb-3" onclick="return confirm('Yakin akan menngosongkan data hasil keputusan?')">
                                    Kosongkan Table
                                </a>
                            </div>


                            <div class="page-wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body table-border-style">
                                                <div class="table-responsive">
                                                    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%">
                                                        <thead class="text-center">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Kode Ranking</th>
                                                                <th>Periode</th>
                                                                <th>Daftar Alternatif</th>
                                                                <th>Skor</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 1; ?>
                                                            <?php foreach ($arr as $key => $val) : ?>
                                                                <?php foreach ($val as $k => $v) : ?>
                                                                    <tr>
                                                                        <?php if ($k == 0) : ?>
                                                                            <td rowspan="<?php echo count($val) ?>" class="text-center m-0">
                                                                                <?= $i++; ?>
                                                                            </td>
                                                                            <td rowspan="<?php echo count($val) ?>" class="text-center m-0">
                                                                                <?= $v->kode_rank ?>
                                                                            </td>
                                                                            <td rowspan="<?php echo count($val) ?>" class="text-center">
                                                                                <?= $v->created_at ?>
                                                                            </td>
                                                                        <?php endif ?>
                                                                        <td><?= $v->alternatif ?></td>
                                                                        <td class="text-center"><?= round($v->nilai_preferensi, 2) ?></td>
                                                                        <?php if ($k == 0) : ?>
                                                                            <td rowspan="<?php echo count($val) ?>" class="text-center">
                                                                                <a class="btn-sm btn-primary" href="../hasil/cetak-hasil.php?kode=<?= $v->kode_rank ?>" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                                                                                <a class="btn-sm btn-danger" href="../hasil/hapus-hasil.php?kode=<?= $v->kode_rank ?>" onclick="return confirm('Yakin akan menghapus data ini?')"><i class="feather icon-trash-2"></i> Hapus</a>
                                                                            </td>
                                                                        <?php endif ?>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir main content -->

    <?php

    require('../templates/footer.php');


?>