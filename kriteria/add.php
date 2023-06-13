<?php
require '../functions.php';
$tittle = "Add Kriteria";

if (isset($_POST['submit'])) {
    if (tambah_krt($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = '../kriteria/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = '../kriteria/index.php';
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
                    <div class="col-md-12 col-xl-8">
                        <div class="card card-social">
                            <div class="card-block border-bottom">
                                <?php
                                // ambil data alt dengan kode terbesar
                                $queryKode = mysqli_query($conn, "SELECT max(kode_kriteria) as kodedMax FROM kriteria");
                                $dataKrt = mysqli_fetch_array($queryKode);
                                $kode = $dataKrt['kodedMax'];
                                $urutan = substr((string)$kode, 1);

                                // bilangan yang diambil ini ditambahkan 1 untuk menentukan nomer urut berikutnya
                                $urutan++;

                                // membentuk kode alt baru
                                // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
                                // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
                                $huruf = "C";
                                $kode = $huruf . sprintf("%1s", $urutan);
                                // var_dump($kodeKrt);
                                // die();
                                ?>
                                <h3>Add Data Kriteria</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <form action="" method="post">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="kode">Kode</label>
                                                        <input type="text" class="form-control" name="kode" required value="<?= $kode; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kriteria">Kriteria</label>
                                                        <input type="text" class="form-control" name="kriteria" placeholder="Masukan Kriteria" required autocomplete="off" autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php $query = mysqli_query($conn, "SELECT * FROM jenis_kriteria"); ?>
                                                        <label for="jenis_kriteria">Jenis Kriteria</label>
                                                        <select name="jenis_kriteria" id="" class="form-control">
                                                            <option value="#" selected disabled>-- Pilih Jenis Kriteria --</option>
                                                            <?php foreach ($query as $row) : ?>
                                                                <option value="<?= $row['id']; ?>"><?= $row['jenis_kriteria']; ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Bobot Kriteria</label>
                                                        <input type="number" step="0.01" class="form-control" name="bobot" placeholder="Masukan Bobot Kriteria" required autocomplete="off" autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            <a href="../kriteria/index.php" type="submit" class="btn btn-success btn-sm">Kembali</a>
                                        </form>
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