<?php
	session_start();
    if(isset($_SESSION['username'])) {
		include ('../../../inc/koneksi.php');
		include ('../../inc/notif-act.php');
		$id = base64_decode( $_GET['id-foto'] );
		$bang = $_GET['id-bang'];
		$sql = pg_query("DELETE FROM health_building_gallery WHERE photo_url = '$id'");
		if ($sql){
			$tempat_foto = '../../../foto/b-kesehatan/'.$id;
    		unlink($tempat_foto);
			echo '<script>
				$("#hapus").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-b-kesehatan.php?id='.$bang.'">
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../info-b-kesehatan.php?id='.$bang.'">
				';
		}
	}
	else {
		echo '<script>window.location="../../../assets/403"</script>';
	}
?>