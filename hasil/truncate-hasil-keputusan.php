<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require '../functions.php';

if (truncateHasilKeputusan() > 0) {
	echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = '../hasil/hasil-keputusan.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data berhasil dikosongkan!');
			document.location.href = '../hasil/hasil-keputusan.php';
		</script>
	";
}
