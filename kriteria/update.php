<?php

require "../functions.php";
$tittle = "Edit Data Kriteria";

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$query = mysqli_query($conn, "SELECT * FROM kriteria WHERE id = $id LIMIT 1");
$kriteria = mysqli_fetch_assoc($query);

$jns_kriteria = query("SELECT * FROM jenis_kriteria");


if (isset($_POST['submit'])) {
    if (edit_krt($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil diedit!');
                document.location.href = '../kriteria/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diedit!');
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
                                <h3>Edit Data Kriteria</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?= $kriteria["id"]; ?>">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="kode">Kode</label>
                                                        <input type="text" class="form-control" name="kode" readonly value="<?= $kriteria["kode_kriteria"]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kriteria">Kriteria</label>
                                                        <input type="text" class="form-control" name="kriteria" value="<?= $kriteria["kriteria"]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kriteria">Jenis Kriteria</label>
                                                        <select class="form-control" name="jenis_kriteria">
                                                            <?php
                                                            foreach ($jns_kriteria as $row) {

                                                                if ($kriteria['id_jenis_kriteria'] == $row['id']) {
                                                                    $select = "selected";
                                                                } else {
                                                                    $select = '';
                                                                }
                                                            ?>
                                                                <option value="<?= $row['id']; ?>" <?= $select; ?>><?= $row['jenis_kriteria']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bobotKriteria">Bobot Kriteria (%)</label>
                                                        <input type="number" step="0.01" class="form-control" name="bobot" value="<?= $kriteria["bobot"]; ?>">
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