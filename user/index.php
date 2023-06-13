<?php
require '../functions.php';
$tittle = "Data Users";

$user = mysqli_query($conn, "SELECT * FROM user");

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
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Users</li>
                                </ol>
                                <h3>Data Users</h3>
                                <!-- Button trigger modal -->
                                <a href="add-user.php" class="btn btn-primary btn-sm">
                                    Add Data Users
                                </a>
                                <hr>
                                <div class="page-wrapper">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($user as $rows) : ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $rows['username'] ?></td>
                                                    <td><?= $rows['password'] ?></td>
                                                    <td class="text-center">
                                                        <a href="../user/edit-user.php?id=<?= $rows['id'] ?>"><i class="feather icon-edit"></i></a> |
                                                        <a href="../user/hapus-user.php?id=<?= $rows['id'] ?>" onclick="return confirm('Yakin akan menghapus data ini?')"><i class="feather icon-trash-2"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
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
    <!-- akhir main content -->

    <?php

    require('../templates/footer.php');


    ?>