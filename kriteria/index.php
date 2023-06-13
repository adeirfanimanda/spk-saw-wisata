<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}
require "../functions.php";
$tittle = "Data Kriteria";

$kriteria = mysqli_query($conn, "SELECT k.*, jk.jenis_kriteria FROM kriteria AS k INNER JOIN jenis_kriteria AS jk ON k.id_jenis_kriteria = jk.id");
// select p.tagihan, inv.* from invoice as inv INNER JOIN piutang as p on inv.id_transaksi = p.id_transaksi

require('../templates/header.php');
require('../templates/navbar.php');
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
                                        <li class="breadcrumb-item active" aria-current="page">Data Kriteria</li>
                                    </ol>
                                </nav>
                                <!-- Button trigger modal -->
                                <a href="../kriteria/add.php" class="btn btn-primary btn-sm mb-3 d-none">
                                    Add Data Kriteria
                                </a>
                                <div class="page-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body table-border-style">
                                                    <div class="table-responsive">
                                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode</th>
                                                                    <th>Kriteria</th>
                                                                    <th>Jenis Kriteria</th>
                                                                    <th>Bobot</th>
                                                                    <th>/E</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i = 1; ?>
                                                                <?php foreach ($kriteria as $krt) : ?>
                                                                    <tr>
                                                                        <td><?= $i++; ?></td>
                                                                        <td><?= $krt['kode_kriteria']; ?></td>
                                                                        <td><?= $krt['kriteria']; ?></td>
                                                                        <td><?= $krt['jenis_kriteria']; ?></td>
                                                                        <td><?= $krt['bobot']; ?></td>
                                                                        <td class="text-center">
                                                                            <a href="../kriteria/update.php?id=<?= $krt['id']; ?>"><i class="feather icon-edit"></i></a> |
                                                                            <a href="../kriteria/delete.php?id=<?= $krt['id']; ?>" onclick="return confirm('Yakin akan menghapus data ini?')"><i class="feather icon-trash-2"></i></a>
                                                                        </td>
                                                                    </tr>
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