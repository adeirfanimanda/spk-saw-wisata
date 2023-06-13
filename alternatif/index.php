<?php
// session_start();
// if (!isset($_SESSION["login"])) {
//     header("Location: ../login.php");
//     exit;
// }
require "../functions.php";
$tittle = "List Alternatif";
require '../templates/header.php';
require '../templates/navbar.php';


$alternatif = mysqli_query($conn, "SELECT * FROM alternatif");
// var_dump($alternatif);
// die();
?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="col-xl-12 col-xl-12">
                        <div class="card card-social">
                            <div class="card-block border-bottom">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">List Alternatif</li>
                                </ol>
                                <!-- Button trigger modal -->
                                <a href="../alternatif/add.php" class="btn btn-primary btn-sm mb-3">
                                    Add Alternatif
                                </a>
                                <div class="page-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body table-border-style">
                                                    <div class="table-responsive">
                                                        <table id="example" class="table text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th class="border-top-0">#</th>
                                                                    <th class="border-top-0">Kode</th>
                                                                    <th class="border-top-0">Alternatif</th>
                                                                    <th class="border-top-0">\E</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i = 1; ?>
                                                                <?php foreach ($alternatif as $alt) : ?>
                                                                    <tr>
                                                                        <td><?= $i++ ?></td>
                                                                        <td><?= $alt['kode_alt'] ?></td>
                                                                        <td><?= $alt['alternatif'] ?></td>
                                                                        <td><a href="../alternatif/update.php?id=<?= $alt['id_alt']; ?>"><i class="fas fa-edit"></i></a> | <a href="../alternatif/delete.php?id=<?= $alt['id_alt']; ?>" onclick="return confirm('Yakin akan menghapus data ini?')"><i class="fas fa-trash"></i></td>
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
    </div>


    <?php

    require('../templates/footer.php');


    ?>