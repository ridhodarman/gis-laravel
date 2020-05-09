<script src="pages/inc/slideshow/jquery.resize.js"></script>
<script src="pages/inc/slideshow/jquery.waitforimages.min.js"></script>
<script src="pages/inc/slideshow/modernizr.js"></script>
<script src="pages/inc/slideshow/jquery.carousel-3d.js"></script>
<link rel="stylesheet" href="pages/inc/slideshow/jquery.carousel-3d.default.css">
            <?php
                include ("inc/koneksi.php");
                $id=$_GET['id'];

                $querysearch = "SELECT E.educational_building_id, E.name_of_educational_building, L.name_of_level AS level, 
                                E.school_type, E.headmaster_name, E.total_students, E.total_teachers, E.building_area, E.land_area, 
                                E.parking_area, E.standing_year, T.name_of_type AS constr, E.electricity_capacity, E.address, 
                                M.name_of_model FROM educational_building AS E
                                LEFT JOIN type_of_construction AS T ON E.type_of_construction=T.type_id
                                LEFT JOIN level_of_education AS L ON E.id_level_of_education=L.level_id
                                LEFT JOIN building_model AS M ON M.model_id=E.model_id
                                WHERE E.educational_building_id='$id' 
                            ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $nama = $row['name_of_educational_building'];
                    $bang = $row['building_area'];
                    $lahan = $row['land_area'];
                    $parkir = $row['parking_area'];
                    $tahun = $row['standing_year'];
                    $listrik = $row['electricity_capacity'];
                    $alamat = $row['address'];
                    $konstruksi = $row['constr'];
                    $tingkat = $row['level'];
                    $kepala = $row['headmaster_name'];
                    $murid = $row['total_students'];
                    $guru = $row['total_teachers'];
                    $id_t = $row['school_type'];
                    if ($id_t==0) {
                        $jenis = "Public School";
                    }
                    else if ($id_t==1) {
                        $jenis = "Private School";
                    }
                    $model = $row['name_of_model'];
                }


                function tampilfoto(){
                    $id=$_GET['id'];
                    $sql = pg_query("SELECT photo_url, upload_date FROM educational_building_gallery WHERE educational_building_id='$id' 
                            ");
                    $cek = pg_num_rows($sql);

                    $n=0;$foto;$tglfoto;
                    while ($row = pg_fetch_assoc($sql)) {
                        $foto[$n]=$row['photo_url'];
                        $tglfoto[$n]=$row['upload_date'];
                        $n++;
                    }

                    $server='foto/b-pendidikan/';
                    echo '<div data-carousel-3d>';
                    if ($cek<1) {
                        echo '
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <div><img src="foto/sekolah.png" /></div>
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <div><img src="foto/sekolah.png" /></div>
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                        ';
                    }
                    else{
                        $i=0;
                        while($i<$n){
                            echo'
                            <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                <img src="'.$server.$foto[$i].'" />
                                <label>Uploaded: '.$tglfoto[$i].'</label>
                                <a class="icon-container" style="background-color: #d8dbff" href="'.$server.$foto[$i].'" target="_blank">
                                    <span class="ti-zoom-in"></span><span class="icon-name">Fullscreen</span>
                                </a>
                            </div>';
                            $i++;
                        }
                        
                    }
                    
                    if ($n==1) {
                        echo '
                                    <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="'.$server.$foto[$i-1].'" />
                                    <label>Uploaded: '.$tglfoto[$i-1].'</label>
                                    <a class="icon-container" style="background-color: #d8dbff" href="'.$server.$foto[$i-1].'" target="_blank">
                                        <span class="ti-zoom-in"></span><span class="icon-name">Fullscreen</span>
                                    </a>
                                </div>';
                    }
                    echo '</div>';    
                    
                    echo "Total Photo: ".$cek;
                    
                     
                }

            ?>

            <div class="main-content-inner">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                    <h6>ID:
                                        <?php echo $id ?>
                                    </h6>
                                    <br />
                                    <table style="width: 100%;">
                                        <tr>
                                            <td>Nama </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $nama ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Level of Education </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $tingkat ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>School Type </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $jenis; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Headmaster Name </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $kepala; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Students </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $murid; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Teachers </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $guru; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Building Size </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $bang; ?> m<sup>2</sup>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Land Area </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $lahan; ?> m<sup>2</sup>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Parking Area </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $parkir; ?> m<sup>2</sup>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Standing Year </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $tahun ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Construction Type </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $konstruksi; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Electricity Capacity </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $listrik; ?> kWh
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Address </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $alamat; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Building Model: </td>
                                            <td>:</td>
                                            <td>
                                                <?php echo $model; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mb-3">Photo
                                            <!-- <button id="ukuranpenuh" class="btn btn-warning btn-sm" title="show all images in full screen">
                                                <i class="ti-fullscreen"></i>
                                            </button> -->
                                        </h5>
                                        <?php tampilfoto() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mb-3">Facility</h5>
                                        <table width="100%" class="table-striped table-bordered table-hover">
                                            <thead style="text-align: center;">
                                                <th>Name of Facility</th>
                                                <th>Qty</th>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sql=pg_query("SELECT D.educational_building_id, D.facility_id, D.quantity_of_facilities, F.name_of_facility
                                                FROM detail_educational_building_facilities AS D 
                                                LEFT JOIN educational_building_facilities AS F ON F.facility_id=D.facility_id
                                                WHERE D.educational_building_id = '$id'
                                                ");
                                            if (pg_num_rows($sql)>0) {
                                                while ($data=pg_fetch_assoc($sql)) {
                                                    //$id_bang=str_replace(' ', '',$data['worship_building_id']);
                                                    $id_fas=$data['facility_id'];
                                                    $namafas =$data['name_of_facility'];
                                                    $qty = $data['quantity_of_facilities'];
                                                    echo "<tr>";
                                                    echo "<td>".$namafas."</td>";
                                                    echo "<td>".$qty."</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            else {
                                                echo '</tbody><td colspan="2">no facility data</td>';
                                            }
                                        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div> <!-- SAMPAI DISINI BATAS ROW-->


            <!-- main content area end -->
            <!-- footer area start-->