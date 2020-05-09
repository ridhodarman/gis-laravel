<div class="main-menu">
    <div class="menu-inner">
        <nav>
            <ul class="metismenu" id="menu">
                <li>
                    <a href="riwayat_pencarian.php" aria-expanded="true" name="terbatas"><i class="fas fa-search-location"></i><span>History of Search Request</span></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php
	if(is_null($_SESSION['username'])){
        echo '<script>window.location="assets/403"</script>';
    }
?>