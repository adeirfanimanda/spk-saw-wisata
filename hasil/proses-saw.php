<?php
require "../functions.php";
$tittle = "Perhitungan SAW";

require('../templates/header.php');
require('../templates/navbar.php');

// mysqli_query($conn, "TRUNCATE TABLE rangking");
$kriteria = mysqli_query($conn, "SELECT * FROM kriteria");
$alternatif = mysqli_query($conn, "SELECT * FROM alternatif");

// mencari nilai kriteria dan bobot 
$query1 = mysqli_query($conn, "SELECT id_jenis_kriteria, kriteria, bobot FROM kriteria WHERE kode_kriteria = 'C1'");
$query2 = mysqli_query($conn, "SELECT id_jenis_kriteria, kriteria, bobot FROM kriteria WHERE kode_kriteria = 'C2'");
$query3 = mysqli_query($conn, "SELECT id_jenis_kriteria, kriteria, bobot FROM kriteria WHERE kode_kriteria = 'C3'");
$query4 = mysqli_query($conn, "SELECT id_jenis_kriteria, kriteria, bobot FROM kriteria WHERE kode_kriteria = 'C4'");
$query5 = mysqli_query($conn, "SELECT id_jenis_kriteria, kriteria, bobot FROM kriteria WHERE kode_kriteria = 'C5'");

$k1 = mysqli_fetch_array($query1);
$k2 = mysqli_fetch_array($query2);
$k3 = mysqli_fetch_array($query3);
$k4 = mysqli_fetch_array($query4);
$k5 = mysqli_fetch_array($query5);
$jk1 = $k1['id_jenis_kriteria'];
$jk2 = $k2['id_jenis_kriteria'];
$jk3 = $k3['id_jenis_kriteria'];
$jk4 = $k4['id_jenis_kriteria'];
$jk5 = $k5['id_jenis_kriteria'];

$bobot1 = $k1['bobot'];
$bobot2 = $k2['bobot'];
$bobot3 = $k3['bobot'];
$bobot4 = $k4['bobot'];
$bobot5 = $k5['bobot'];

// membuat pivot statis
$nilaiAlt = mysqli_query($conn, "SELECT alternatif.*, kriteria.*, periode.*, penilaian.id_nilai, penilaian.id_periode, penilaian.kode_alt, penilaian.kode_kriteria, penilaian.nilai, max(penilaian.nilai) as maks, min(penilaian.nilai) as mins,
    sum(IF(kriteria.kode_kriteria='C1', penilaian.nilai, NULL)) AS nilaiA,
    sum(IF(kriteria.kode_kriteria='C2', penilaian.nilai, NULL)) AS nilaiB,
    sum(IF(kriteria.kode_kriteria='C3', penilaian.nilai, NULL)) AS nilaiC,
    sum(IF(kriteria.kode_kriteria='C4', penilaian.nilai, NULL)) AS nilaiD,
    sum(IF(kriteria.kode_kriteria='C5', penilaian.nilai, NULL)) AS nilaiE
    FROM penilaian JOIN alternatif ON penilaian.kode_alt = alternatif.kode_alt JOIN kriteria ON penilaian.kode_kriteria = kriteria.kode_kriteria JOIN periode ON periode.id=penilaian.id_periode GROUP BY alternatif");

$kriteria1 = mysqli_query($conn, "SELECT MAX(nilai) AS maks, MIN(nilai) AS mins FROM penilaian WHERE kode_kriteria = 'C1'");
$kriteria2 = mysqli_query($conn, "SELECT MAX(nilai) AS maks, MIN(nilai) AS mins FROM penilaian WHERE kode_kriteria = 'C2'");
$kriteria3 = mysqli_query($conn, "SELECT MAX(nilai) AS maks, MIN(nilai) AS mins FROM penilaian WHERE kode_kriteria = 'C3'");
$kriteria4 = mysqli_query($conn, "SELECT MAX(nilai) AS maks, MIN(nilai) AS mins FROM penilaian WHERE kode_kriteria = 'C4'");
$kriteria5 = mysqli_query($conn, "SELECT MAX(nilai) AS maks, MIN(nilai) AS mins FROM penilaian WHERE kode_kriteria = 'C5'");

$na = mysqli_fetch_array($kriteria1);
$nb = mysqli_fetch_array($kriteria2);
$nc = mysqli_fetch_array($kriteria3);
$nd = mysqli_fetch_array($kriteria4);
$ne = mysqli_fetch_array($kriteria5);

// mencari nilai maks
$kriteriaMaks1 = $na['maks'];
$kriteriaMaks2 = $nb['maks'];
$kriteriaMaks3 = $nc['maks'];
$kriteriaMaks4 = $nd['maks'];
$kriteriaMaks5 = $ne['maks'];
// mencari nilai mins
$kriteriaMins1 = $na['mins'];
$kriteriaMins2 = $nb['mins'];
$kriteriaMins3 = $nc['mins'];
$kriteriaMins4 = $nd['mins'];
$kriteriaMins5 = $ne['mins'];

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
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Perhitungan SAW</li>
                                    </ol>
                                </nav>
                                <hr>
                                <div class=" page-wrapper">
                                    <h3>1. Data Masing-Masing Produk Terhadap Kriteria</h3>
                                    <table id="" class="table table-striped text-center text-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Alternatif</th>
                                                <?php foreach ($kriteria as $col) : ?>
                                                    <th><?= $col['kriteria'] ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($nilaiAlt as $na) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $na['alternatif']; ?></td>
                                                    <td><?= $na['nilaiA']; ?></td>
                                                    <td><?= $na['nilaiB']; ?></td>
                                                    <td><?= $na['nilaiC']; ?></td>
                                                    <td><?= $na['nilaiD']; ?></td>
                                                    <td><?= $na['nilaiE']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <th colspan="2">Nilai Maks</th>
                                                <th class="bg-dark text-white"><?= $kriteriaMaks1 ?></th>
                                                <th class="bg-dark text-white"><?= $kriteriaMaks2 ?></th>
                                                <th class="bg-dark text-white"><?= $kriteriaMaks3 ?></th>
                                                <th class="bg-dark text-white"><?= $kriteriaMaks4 ?></th>
                                                <th class="bg-dark text-white"><?= $kriteriaMaks5 ?></th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">Nilai Min</th>
                                                <th class="bg-dark text-white"><?= $kriteriaMins1 ?></th>
                                                <th class="bg-dark text-white"><?= $kriteriaMins2 ?></th>
                                                <th class="bg-dark text-white"><?= $kriteriaMins3 ?></th>
                                                <th class="bg-dark text-white"><?= $kriteriaMins4 ?></th>
                                                <th class="bg-dark text-white"><?= $kriteriaMins5 ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="page-wrapper">
                                    <h3 class="mt-5">2. Menghitung Nilai Normalisasi</h3>
                                    <table id="" class="table table-stripedtext-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Alternatif</th>
                                                <?php foreach ($kriteria as $col) : ?>
                                                    <th><?= $col['kriteria'] ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($nilaiAlt as $na) :
                                                $nilai1 = $na['nilaiA'];
                                                $nilai2 = $na['nilaiB'];
                                                $nilai3 = $na['nilaiC'];
                                                $nilai4 = $na['nilaiD'];
                                                $nilai5 = $na['nilaiE'];
                                                // untuk kondisi jika jenis kriteria merupakan benefit atau cost
                                                // krieteria 1
                                                if($jk1 == 2){
                                                    $dataTeks1 = $nilai1 . " / (".$kriteriaMaks1.")";
                                                }else{
                                                    $dataTeks1 = "(".$kriteriaMins1.") / " . $nilai1;
                                                }
                                                // krieteria 2
                                                if($jk2 == 2){
                                                    $dataTeks2 = $nilai2 . " / (".$kriteriaMaks2.")";
                                                }else{
                                                    $dataTeks2 = "(".$kriteriaMins2.") / " . $nilai2;
                                                }
                                                // krieteria 3
                                                if($jk3 == 2){
                                                    $dataTeks3 = $nilai3 . " / (".$kriteriaMaks3.")";
                                                }else{
                                                    $dataTeks3 = "(".$kriteriaMins3.") / " . $nilai3;
                                                }
                                                // krieteria 4
                                                if($jk4 == 2){
                                                    $dataTeks4 = $nilai4 . " / (".$kriteriaMaks4.")";
                                                }else{
                                                    $dataTeks4 = "(".$kriteriaMins4.") / " . $nilai4;
                                                }
                                                // krieteria 5
                                                if($jk5 == 2){
                                                    $dataTeks5 = $nilai5 . " / (".$kriteriaMaks5.")";
                                                }else{
                                                    $dataTeks5 = "(".$kriteriaMins5.") / " . $nilai5;
                                                }
                                                ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $na['alternatif']; ?></td>
                                                    <td><?= $dataTeks1 ?></td>
                                                    <td><?= $dataTeks2 ?></td>
                                                    <td><?= $dataTeks3 ?></td>
                                                    <td><?= $dataTeks4 ?></td>
                                                    <td><?= $dataTeks5 ?></td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="page-wrapper">
                                    <h3 class="mt-5">3. Hasil Normalisasi</h3>
                                    <table id="" class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Alternatif</th>
                                                <?php foreach ($kriteria as $col) : ?>
                                                    <th><?= $col['kriteria'] ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($nilaiAlt as $na) :
                                                $nilai1 = $na['nilaiA'];
                                                $nilai2 = $na['nilaiB'];
                                                $nilai3 = $na['nilaiC'];
                                                $nilai4 = $na['nilaiD'];
                                                $nilai5 = $na['nilaiE'];
                                                // untuk kondisi jika jenis kriteria merupakan benefit atau cost
                                                // krieteria 1
                                                if($jk1 == 2){
                                                    $dataAngka1 = $nilai1/$kriteriaMaks1;
                                                }else{
                                                    $dataAngka1 = $kriteriaMins1/$nilai1;
                                                }
                                                // krieteria 2
                                                if($jk2 == 2){
                                                    $dataAngka2 = $nilai2/$kriteriaMaks2;
                                                }else{
                                                    $dataAngka2 = $kriteriaMins2/$nilai2;
                                                }
                                                // krieteria 3
                                                if($jk3 == 2){
                                                    $dataAngka3 = $nilai3/$kriteriaMaks3;
                                                }else{
                                                    $dataAngka3 = $kriteriaMins3/$nilai3;
                                                }
                                                // krieteria 4
                                                if($jk4 == 2){
                                                    $dataAngka4 = $nilai4/$kriteriaMaks4;
                                                }else{
                                                    $dataAngka4 = $kriteriaMins4/$nilai4;
                                                }
                                                // krieteria 5
                                                if($jk5 == 2){
                                                    $dataAngka5 = $nilai5/$kriteriaMaks5;
                                                }else{
                                                    $dataAngka5 = $kriteriaMins5/$nilai5;
                                                }
                                                ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $na['alternatif']; ?></td>
                                                    <td><?= round($dataAngka1, 3) ?></td>
                                                    <td><?= round($dataAngka2, 3) ?></td>
                                                    <td><?= round($dataAngka3, 3) ?></td>
                                                    <td><?= round($dataAngka4, 3) ?></td>
                                                    <td><?= round($dataAngka5, 3) ?></td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="page-wrapper">
                                    <h3 class="mt-5">4. Menghitung Nilai Preferensi</h3>
                                    <table id="" class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Alternatif</th>
                                                <?php foreach ($kriteria as $col) : ?>
                                                    <th><?= $col['kriteria'] ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($nilaiAlt as $na) :
                                                $nilai1 = $na['nilaiA'];
                                                $nilai2 = $na['nilaiB'];
                                                $nilai3 = $na['nilaiC'];
                                                $nilai4 = $na['nilaiD'];
                                                $nilai5 = $na['nilaiE'];
                                                // untuk kondisi jika jenis kriteria merupakan benefit atau cost
                                                // krieteria 1
                                                if($jk1 == 2){
                                                    $dataAngka1 = $nilai1/$kriteriaMaks1;
                                                }else{
                                                    $dataAngka1 = $kriteriaMins1/$nilai1;
                                                }
                                                // krieteria 2
                                                if($jk2 == 2){
                                                    $dataAngka2 = $nilai2/$kriteriaMaks2;
                                                }else{
                                                    $dataAngka2 = $kriteriaMins2/$nilai2;
                                                }
                                                // krieteria 3
                                                if($jk3 == 2){
                                                    $dataAngka3 = $nilai3/$kriteriaMaks3;
                                                }else{
                                                    $dataAngka3 = $kriteriaMins3/$nilai3;
                                                }
                                                // krieteria 4
                                                if($jk4 == 2){
                                                    $dataAngka4 = $nilai4/$kriteriaMaks4;
                                                }else{
                                                    $dataAngka4 = $kriteriaMins4/$nilai4;
                                                }
                                                // krieteria 5
                                                if($jk5 == 2){
                                                    $dataAngka5 = $nilai5/$kriteriaMaks5;
                                                }else{
                                                    $dataAngka5 = $kriteriaMins5/$nilai5;
                                                }
                                                ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $na['alternatif']; ?></td>
                                                    <td><?= round($dataAngka1, 3) . " x " . $bobot1 ?></td>
                                                    <td><?= round($dataAngka2, 3) . " x " . $bobot2 ?></td>
                                                    <td><?= round($dataAngka3, 3) . " x " . $bobot3 ?></td>
                                                    <td><?= round($dataAngka4, 3) . " x " . $bobot4 ?></td>
                                                    <td><?= round($dataAngka5, 3) . " x " . $bobot5 ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <th colspan="2">Bobot Kriteria</th>
                                                <?php foreach ($kriteria as $col) : ?>
                                                    <th class="bg-dark text-white"><?= $col['bobot'] ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="page-wrapper">
                                    <h3 class="mt-5">5. Hasil Preferensi</h3>
                                    <table id="" class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Alternatif</th>
                                                <?php foreach ($kriteria as $col) : ?>
                                                    <th><?= $col['kriteria'] ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($nilaiAlt as $na) :
                                                $nilai1 = $na['nilaiA'];
                                                $nilai2 = $na['nilaiB'];
                                                $nilai3 = $na['nilaiC'];
                                                $nilai4 = $na['nilaiD'];
                                                $nilai5 = $na['nilaiE'];
                                                // untuk kondisi jika jenis kriteria merupakan benefit atau cost
                                                // krieteria 1
                                                if($jk1 == 2){
                                                    $dataAngka1 = ($nilai1/$kriteriaMaks1)*$bobot1;
                                                }else{
                                                    $dataAngka1 = ($kriteriaMins1/$nilai1)*$bobot1;
                                                }
                                                // krieteria 2
                                                if($jk2 == 2){
                                                    $dataAngka2 = ($nilai2/$kriteriaMaks2)*$bobot2;
                                                }else{
                                                    $dataAngka2 = ($kriteriaMins2/$nilai2)*$bobot2;
                                                }
                                                // krieteria 3
                                                if($jk3 == 2){
                                                    $dataAngka3 = ($nilai3/$kriteriaMaks3)*$bobot3;
                                                }else{
                                                    $dataAngka3 = ($kriteriaMins3/$nilai3)*$bobot3;
                                                }
                                                // krieteria 4
                                                if($jk4 == 2){
                                                    $dataAngka4 = ($nilai4/$kriteriaMaks4)*$bobot4;
                                                }else{
                                                    $dataAngka4 = ($kriteriaMins4/$nilai4)*$bobot4;
                                                }
                                                // krieteria 5
                                                if($jk5 == 2){
                                                    $dataAngka5 = ($nilai5/$kriteriaMaks5)*$bobot5;
                                                }else{
                                                    $dataAngka5 = ($kriteriaMins5/$nilai5)*$bobot5;
                                                }
                                                ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $na['alternatif']; ?></td>
                                                    <td><?= round($dataAngka1, 3) ?></td>
                                                    <td><?= round($dataAngka2, 3) ?></td>
                                                    <td><?= round($dataAngka3, 3) ?></td>
                                                    <td><?= round($dataAngka4, 3) ?></td>
                                                    <td><?= round($dataAngka5, 3) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="page-wrapper">
                                    <h3 class="mt-5">6. Menghitung Total Nilai Preferensi</h3>
                                    <table id="" class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Alternatif</th>
                                                <?php foreach ($kriteria as $col) : ?>
                                                    <th><?= $col['kriteria'] ?></th>
                                                <?php endforeach ?>
                                                <th> Total Nilai Preferensi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- membuat kode untuk ranking -->
                                            <?php

                                            $queryKode = mysqli_query($conn, "SELECT max(kode_rank) as kodeTerbesar FROM ranking");
                                            $dataRank = mysqli_fetch_array($queryKode);
                                            $kodeRank = $dataRank['kodeTerbesar'];
                                            $urutan = (int) substr($kodeRank, 1, 2);
                                            $urutan++;
                                            $huruf = "P";
                                            $kodeRanking = $huruf . sprintf("%02s", $urutan);
                                            ?>
                                            <!-- membuat kode untuk ranking -->

                                            <?php $i = 1; ?>
                                            <?php foreach ($nilaiAlt as $na) :
                                                $nilai1 = $na['nilaiA'];
                                                $nilai2 = $na['nilaiB'];
                                                $nilai3 = $na['nilaiC'];
                                                $nilai4 = $na['nilaiD'];
                                                $nilai5 = $na['nilaiE'];
                                                // untuk kondisi jika jenis kriteria merupakan benefit atau cost
                                                // krieteria 1
                                                if($jk1 == 2){
                                                    $dataAngka1 = ($nilai1/$kriteriaMaks1)*$bobot1;
                                                }else{
                                                    $dataAngka1 = ($kriteriaMins1/$nilai1)*$bobot1;
                                                }
                                                // krieteria 2
                                                if($jk2 == 2){
                                                    $dataAngka2 = ($nilai2/$kriteriaMaks2)*$bobot2;
                                                }else{
                                                    $dataAngka2 = ($kriteriaMins2/$nilai2)*$bobot2;
                                                }
                                                // krieteria 3
                                                if($jk3 == 2){
                                                    $dataAngka3 = ($nilai3/$kriteriaMaks3)*$bobot3;
                                                }else{
                                                    $dataAngka3 = ($kriteriaMins3/$nilai3)*$bobot3;
                                                }
                                                // krieteria 4
                                                if($jk4 == 2){
                                                    $dataAngka4 = ($nilai4/$kriteriaMaks4)*$bobot4;
                                                }else{
                                                    $dataAngka4 = ($kriteriaMins4/$nilai4)*$bobot4;
                                                }
                                                // krieteria 5
                                                if($jk5 == 2){
                                                    $dataAngka5 = ($nilai5/$kriteriaMaks5)*$bobot5;
                                                }else{
                                                    $dataAngka5 = ($kriteriaMins5/$nilai5)*$bobot5;
                                                }
                                                $totalalternatif = $dataAngka1 + $dataAngka2 + $dataAngka3 + $dataAngka4 + $dataAngka5;


                                                ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $na['alternatif']; ?></td>
                                                    <td><?= round($dataAngka1, 3) ?></td>
                                                    <td><?= round($dataAngka2, 3) ?></td>
                                                    <td><?= round($dataAngka3, 3) ?></td>
                                                    <td><?= round($dataAngka4, 3) ?></td>
                                                    <td><?= round($dataAngka5, 3) ?></td>
                                                    <td class="bg-dark text-white"><?= round(($totalalternatif), 3) ?></td>
                                                </tr>
                                                <?php
                                                $alt = $na['kode_alt'];
                                                $periode = $na['id'];
                                                $peringkat = $totalalternatif;
                                                $tgl = date('Y-m-d');
                                                mysqli_query($conn, "INSERT INTO ranking VALUES('','$kodeRanking','$periode','$alt','$peringkat','$tgl')");
                                                ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="page-wrapper">
                                    <h3 class="mt-5">7. Perangkingan</h3>
                                    <table id="" class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>Nama Alternatif</th>
                                                <th>Nilai Preferensi</th>
                                                <th>Ranking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // ambil kode rank terakhir
                                            $ranking = mysqli_query($conn, "SELECT * FROM ranking ORDER BY kode_rank DESC LIMIT 1");
                                            $kode_rank = mysqli_fetch_array($ranking);
                                            $kode_rank = $kode_rank['kode_rank'];

                                            $peringkat = mysqli_query($conn, "SELECT * FROM ranking JOIN alternatif on ranking.kode_alt=alternatif.kode_alt WHERE kode_rank = '$kode_rank' ORDER BY nilai_preferensi DESC");
                                            ?>
                                            <?php $rank = 1; ?>
                                            <?php foreach ($peringkat as $p) : ?>
                                                <tr>
                                                    <td><?= $p['alternatif']; ?></td>
                                                    <td><?= round($p['nilai_preferensi'], 2); ?></td>
                                                    <td class="bg-dark text-white"><?= $rank++; ?></td>
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
<!-- akhir main content -->

<?php

require('../templates/footer.php');


?>