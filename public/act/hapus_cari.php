<?php
	session_start();
	include ('../inc/koneksi.php');
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/themify-icons.css">
<link rel="stylesheet" href="../assets/css/metisMenu.css">
<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="../assets/css/slicknav.min.css">
<link rel="stylesheet" type="text/css" href="../assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/css/typography.css">
<link rel="stylesheet" href="../assets/css/default-css.css">
<link rel="stylesheet" href="../assets/css/styles.css">
<link rel="stylesheet" href="../assets/css/responsive.css">
<link rel="stylesheet" href="../assets/css/style2.css">
<script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="../assets/fontawesome-free-5.6.3-web/css/all.css">
<link rel="stylesheet" href="../assets/fontawesome-free-5.6.3-web/css/all.min.css">
<script type="text/javascript" src="../assets/fontawesome-free-5.6.3-web/js/all.js"></script>
<script type="text/javascript" src="../assets/fontawesome-free-5.6.3-web/js/all.min.js"></script>
<div class="modal fade" id="sukses">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center>
                        <div>
                            <p style="font-size: 400%; color: green"><i class="ti-check"></i></p>
                            <p>Data added successfully</p>
                        </div>
                        <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="hapus">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center>
                        <div>
                            <p style="font-size: 400%; color: green"><i class="ti-check"></i></p>
                            <p>Data successfully deleted</p>
                        </div>
                        <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="gagal">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center>
                        <div>
                            <p style="font-size: 400%; color: red"><i class="far fa-times-circle"></i></p>
                            <p>Oopss..,  Something went wrong!</p>
                            <div id="notifikasi"><?php  ?></div>
                        </div>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="updated">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center>
                        <div>
                            <p style="font-size: 400%; color: green"><i class="ti-check"></i></p>
                            <p>Data updated successfully</p>
                        </div>
                        <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="sudah">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center>
                        <div>
                            <p style="font-size: 400%; color: #edd83b"><i class="fas fa-exclamation-circle"></i></p>
                            <p>Facility data already exists</p>
                        </div>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/metisMenu.min.js"></script>
<script src="../assets/js/jquery.slimscroll.min.js"></script>
<script src="../assets/js/jquery.slicknav.min.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/scripts.js"></script>


<?php
	$nik = $_GET['nik'];
	$nomor = $_GET['no'];
    if(isset($_SESSION['username'])) {
    	if (empty($nik) || is_null($nomor)) {
    		echo '<script>window.location="../assets/403"</script>';
    	}
		$sql = pg_query("DELETE FROM search_history WHERE national_identity_number_of_applicant = '$nik' and serial_number = '$nomor' ");
		if ($sql){
			echo '<script>
				$("#hapus").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../riwayat_pencarian.php">
				';
		}
		else {
			echo '<script>
				$("#gagal").modal("show");
				</script>
				<meta http-equiv="REFRESH" content="1;url=../riwayat_pencarian.php">
				';
		}
	}
	else {
		echo '<script>window.location="../assets/403"</script>';
	}
?>