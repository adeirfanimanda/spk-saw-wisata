<?php
require '../functions.php';
$tittle = "Edit Nilai Alternatif";

// ambil data di URL
$id = $_GET["id"];

// query data nilai alternatif berdasarkan id
// $query = mysqli_query($conn, "SELECT * FROM nilai_alternatif WHERE id_nilai = $id LIMIT 1");
// $nilai_alt = mysqli_fetch_assoc($query);
$penilaian = query("SELECT * FROM penilaian WHERE id_nilai = $id")[0];


$periode = mysqli_query($conn, "SELECT * FROM periode");
$alternatif = mysqli_query($conn, "SELECT * FROM alternatif");
$kriteria = mysqli_query($conn, "SELECT * FROM kriteria");

if (isset($_POST['submit'])) {
    if (edit_penilaian($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = '../penilaian/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = '../penilaian/update.php';
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
                                <h3>Edit Nilai Alternatif</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <!-- <label for="kode">ID</label> -->
                                                <input type="hidden" class="form-control" name="id" value="<?= $penilaian["id_nilai"] ?>" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Periode</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="periode">
                                                    <?php
                                                    $tahun = $penilaian["id_periode"];
                                                    ?>
                                                    <?php foreach ($periode as $row) : ?>
                                                        <option value="<?= $row['id']; ?>" <?php if ($tahun == $row['id']) : ?> selected="selected" <?php endif; ?>>
                                                            <?= $row['periode']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Alternatif</label>
                                                <select class="form-control" name="alternatif">
                                                    <?php
                                                    $supplier = $penilaian["kode_alt"];
                                                    ?>
                                                    <?php foreach ($alternatif as $row) : ?>
                                                        <option value="<?= $row['kode_alt']; ?>" <?php if ($supplier == $row['kode_alt']) : ?> selected="selected" <?php endif; ?>>
                                                            <?= $row['alternatif']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Kriteria</label>
                                                <select class="form-control" name="kriteria">
                                                    <?php
                                                    $supplier = $penilaian["kode_kriteria"];
                                                    ?>
                                                    <?php foreach ($kriteria as $row) : ?>
                                                        <option value="<?= $row['kode_kriteria']; ?>" <?php if ($supplier == $row['kode_kriteria']) : ?> selected="selected" <?php endif; ?>>
                                                            <?= $row['kriteria']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group mb-5">
                                                <label for="exampleFormControlSelect1">Nilai</label>
                                                <input type="number" class="form-control" name="nilai" value="<?= $penilaian['nilai'] ?>">
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            <a href="../penilaian/index.php" type="submit" class="btn btn-success btn-sm">Kembali</a>
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