<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "../functions.php";
$tittle = "Nilai Alternatif";

require('../templates/header.php');
require('../templates/navbar.php');

// $nilaiAlternatif = mysqli_query($conn, "SELECT * FROM penilaian as ");
$nilai = mysqli_query($conn, "SELECT * FROM penilaian JOIN alternatif ON penilaian.kode_alt = alternatif.kode_alt JOIN kriteria ON penilaian.kode_kriteria = kriteria.kode_kriteria JOIN periode ON periode.id=penilaian.id_periode");
$arr = array();
while ($row = mysqli_fetch_object($nilai)) {
    // code...
    $arr[$row->alternatif][] = $row;
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
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Nilai Alternatif</li>
                                    </ol>
                                </nav>

                                <!-- Button trigger modal -->
                                <a href="../penilaian/add.php" class="btn btn-primary btn-sm mb-3">
                                    Add Nilai Alternatif
                                </a>
                                <a href="truncate.php" class="btn btn-danger btn-sm mb-3" onclick="return confirm('Yakin akan menngosongkan isi table?')">
                                    Kosongkan Table
                                </a>
                                <div class="page-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Periode</th>
                                                            <th>Alternatif</th>
                                                            <th>Kriteria</th>
                                                            <th>Nilai</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($arr as $key => $val) : ?>
                                                            <?php foreach ($val as $v => $n) : ?>
                                                                <tr>
                                                                    <?php if ($v == 0) : ?>
                                                                        <td rowspan="<?php echo count($val) ?>" class="text-center">
                                                                            <?= $i++; ?>
                                                                        </td>
                                                                        <td rowspan="<?php echo count($val) ?>" class="text-center">
                                                                            <?= $n->periode ?>
                                                                        </td>
                                                                        <td rowspan="<?php echo count($val) ?>" class="text-center">
                                                                            <?= $n->alternatif ?>
                                                                        </td>
                                                                    <?php endif ?>
                                                                    <td><?= $n->kriteria ?></td>
                                                                    <td><?= $n->nilai ?></td>
                                                                    <td class="text-center">
                                                                        <a class="badge badge-sm p-1 btn-primary" href="../penilaian/update.php?id=<?= $n->id_nilai ?>"><i class="feather icon-edit"></i></a>
                                                                        <a class="badge p-1 badge-sm btn-danger" href="../penilaian/delete.php?id=<?= $n->id_nilai ?>" onclick="return confirm('Yakin akan menghapus data ini?')"><i class="feather icon-trash-2"></i></a>
                                                                    </td>
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
        <!-- akhir main content -->

        <?php

        require('../templates/footer.php');


        ?>