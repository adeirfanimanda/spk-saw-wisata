<?php

require "../functions.php";
$tittle = "Surat Keputusan Penilaian Kinerja Supplier";
// ambil data di URL
$kode = $_GET["kode"];

// query data mahasiswa berdasarkan id
$peringkat = mysqli_query($conn, "SELECT * FROM ranking JOIN alternatif ON ranking.kode_alt = alternatif.kode_alt WHERE kode_rank = '$kode' ORDER BY nilai_preferensi DESC");


$ket = mysqli_fetch_assoc($peringkat);

require('../templates/header.php');

?>


<!-- [ Main Content ] start -->
<div class="container mt-5">
    <div class="main-body">
        <div class="col-md-12 col-xl-12">
            <div class="card card-social">
                <div class="card-block border-bottom">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <h1>PT Xinar Your Zero (XYZ)</h1>
                                    <p>Jl. Jend. Kho Phing Hoo Kav No.58, RT.5/RW.3, Cobek, Kec. Losari Baru, Kota Cirebon Timur, Daerah Khusus Ibukota Jawa Barat 14592</p>
                                    <hr>
                                    <br>
                                    <h3>Surat Keputusan Penilaian Kualitas Produk</h3>
                                </div>
                                <div class="card-body table-border-style text-align-center">
                                    <p class="text-justify">Berdasarkan perhitungan menggunakan sistem pendukung keputusan (SPK) menggunakan metode <i>simple addictive weighting</i> (SAW) dengan melakukan penilaian terhadap kriteria pada masing-masing Produk yang dilakukan oleh perusahaan XYZ, maka didapatkan hasil urutan peringkat kualitas produk terbaik. Berikut nilai <b>SKOR</b> dan <b>Ranking</b> dari produk tersebut.</p>

                                    <h5>Kode : <?= $ket['kode_rank']; ?> | Periode Tanggal : <?= $ket['created_at']; ?></h5>
                                    <table id="" class="table table-striped table-bordered text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Skor</th>
                                                <th>Peringkat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>

                                            <?php foreach ($peringkat as $p) : ?>

                                                <tr>
                                                    <td><?= $p['alternatif']; ?></td>
                                                    <td><?= round($p['nilai_preferensi'], 3); ?></td>
                                                    <?php $no_urut = $i++ ?>
                                                    <td><?= $no_urut ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div>
                                        <p class="text-justify">Demikian surat keputusan penilaian kualitas produk, harap digunakan sebagaimana mestinya.</p>
                                        <br><br>
                                        <p class="text-right">Cirebon Timur, <?= date('d M Y') ?></p><br><br>
                                        <p class="mt-5 text-right">(................................)</p>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- akhir main content -->


            <!-- sintaks untuk print halamnan -->
            <script type="text/javascript">
                window.print();
            </script>

            <?php

            require('../templates/footer.php');


            ?>