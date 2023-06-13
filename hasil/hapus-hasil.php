<?php

require '../functions.php';

$kode = $_GET["kode"];

if (hapus_hasil($kode) > 0) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = '../hasil/hasil-keputusan.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = '../hasil/hasil-keputusan.php';
		</script>
	";
}
