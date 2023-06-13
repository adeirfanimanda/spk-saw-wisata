<?php
require '../functions.php';
$tittle = "Add Nilai Alternatif";

$periode = mysqli_query($conn, "SELECT * FROM periode");
$alternatif = mysqli_query($conn, "SELECT * FROM alternatif");
$kriteria = mysqli_query($conn, "SELECT * FROM kriteria");


if (isset($_POST['submit'])) {
    if (tambah_nilai_alt($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'nilai-alternatif.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'add-nilai-alt.php';
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

                                <h3>Add Nilai Alternatif (Supplier)</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Periode</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="periode">
                                                    <option value="#">- Pilih -</option>
                                                    <?php foreach ($periode as $row) : ?>
                                                        <option value="<?= $row['periode'] ?>"><?= $row['periode'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Alternatif</label>
                                                <select class="form-control" name="alternatif">
                                                    <option value="#">- Pilih -</option>
                                                    <?php foreach ($alternatif as $row) : ?>
                                                        <option value="<?= $row['nama_alt'] ?>"><?= $row['nama_alt'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="kriteria">Kriteria</label>
                                                <select class="form-control" name="kriteria">
                                                    <option value="#">- Pilih -</option>
                                                    <?php foreach ($kriteria as $row) : ?>
                                                        <option value="<?= $row['nama_krt'] ?>"><?= $row['nama_krt'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <!-- <div class="row">
                                                    <div class="col-md-6"> -->
                                                <label for="nilai">Nilai</label>
                                                <input class="form-control" type="number" name="nilai" placeholder="isikan nilai 1 s/d 5">
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            <a href="nilai-alternatif.php" type="submit" class="btn btn-success btn-sm">Kembali</a>
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