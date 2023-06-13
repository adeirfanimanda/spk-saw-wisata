<?php
require '../functions.php';
$tittle = "Add Nilai Alternatif";

$periode = mysqli_query($conn, "SELECT * FROM periode");
$alternatif = mysqli_query($conn, "SELECT * FROM alternatif");
$kriteria = mysqli_query($conn, "SELECT * FROM kriteria");
$nilai_kriteria = mysqli_query($conn, "SELECT * FROM nilai_kriteria");

if (isset($_POST['submit'])) {
    if (tambah_penilaian($_POST) > 0) {
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
                document.location.href = '../penilaian/add.php';
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

                                <h3>Add Nilai Alternatif</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Periode</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="periode" required>
                                                    <option value="" selected disabled>- Pilih Periode -</option>
                                                    <?php foreach ($periode as $row) : ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['periode'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Alternatif</label>
                                                <select class="form-control" name="alternatif" required>
                                                    <option value="" selected disabled>- Pilih Alternatif -</option>
                                                    <?php foreach ($alternatif as $row) : ?>
                                                        <option value="<?= $row['kode_alt'] ?>"><?= $row['alternatif'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <label>Penilaian Alternatif Terhadap Masing-Masing Kriteria</label>
                                                        <table class="table table-sm table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <td>Kriteria</td>
                                                                    <td>Nilai</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($kriteria as $row) : ?>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="checkbox" name="kriteria[]" value="<?= $row['kode_kriteria'] ?>" checked required>
                                                                            <?= $row['kriteria'] ?>
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control" type="number" name="nilaiordinal[]" required>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label></label>
                                                        <h6>Keterangan Nilai</h6>
                                                        <p>*Untuk kriteria
                                                            <?php foreach ($kriteria as $row) {
                                                                echo $row['kriteria'] . ", ";
                                                            } ?>.</p>
                                                        <ul type="none">
                                                            <li>1 = Sangat Rendah</li>
                                                            <li>2 = Rendah</li>
                                                            <li>3 = Cukup</li>
                                                            <li>4 = Tinggi</li>
                                                            <li>5 = Sangat Tinggi</li>
                                                        </ul>

                                                    </div>
                                                </div>
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
</div>
</div>

<!-- akhir main content -->


<?php

require('../templates/footer.php');


?>