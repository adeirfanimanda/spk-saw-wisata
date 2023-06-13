<?php
require '../functions.php';
$tittle = "Add Supplier";

if (isset($_POST['submit'])) {
    if (tambah_alt($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = '../alternatif/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = '../alternatif/index.php';
            </script>
        ";
    }
}

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
                                <?php
                                // ambil data alt dengan kode terbesar
                                $queryKode = mysqli_query($conn, "SELECT max(kode_alt) as kodeMax FROM alternatif");
                                $dataAlt = mysqli_fetch_array($queryKode);
                                $kode = $dataAlt['kodeMax'];
                                // ambil angka terakhir dari kode cth : A2
                                $ambildata = substr((string)$kode, 1);
                                $urutan = $ambildata;

                                // bilangan yang diambil ini ditambahkan 1 untuk menentukan nomer urut berikutnya
                                $urutan++;

                                // membentuk kode alt baru
                                // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
                                // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
                                $huruf = "A";
                                $kodeAlt = $huruf . sprintf("%1s", $urutan);
                                ?>

                                <h3>Add Data Supplier (Alternatif)</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="kode">Kode</label>
                                                        <input type="text" class="form-control" name="kode" value="<?= $kodeAlt; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="supplier">Nama Supplier</label>
                                                        <input type="text" class="form-control" name="supplier" placeholder="Masukan Alternatif" required autocomplete="off" autofocus>
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                    <a href="alternatif.php" type="submit" class="btn btn-success btn-sm">Kembali</a>
                                                </form>
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