<?php
require '../functions.php';
$tittle = "Edit Data Supplier";

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$query = mysqli_query($conn, "SELECT * FROM alternatif WHERE id_alt = $id LIMIT 1");
$alt = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    if (edit_alt($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil diedit!');
                document.location.href = '../alternatif/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diedit!');
                document.location.href = '../alternatif/update.php';
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
                                <h3>Edit Alternatif</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="hidden" name="id" value="<?= $alt["id_alt"]; ?>">
                                                    <div class="form-group">
                                                        <label for="kode">Kode</label>
                                                        <input type="text" class="form-control" name="kode" value="<?= $alt["kode_alt"]; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama">Alternatif</label>
                                                        <input type="text" class="form-control" name="alternatif" value="<?= $alt["alternatif"]; ?>" autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            <a href="../alternatif/index.php" type="submit" class="btn btn-success btn-sm">Kembali</a>
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
<!-- akhir main content -->


<?php

require('../templates/footer.php');


?>