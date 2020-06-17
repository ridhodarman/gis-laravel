@extends('admin.layouts.app')

@section('content')
<script>$("#konten").removeClass("card");</script>
<?php include('inc/koneksi.php'); 
                $id="KG165";

                $querysearch = "SELECT W.worship_building_id, W.name_of_worship_building, W.building_area, W.land_area, W.parking_area, W.standing_year, W.electricity_capacity, W.address, W.type_of_construction, W.type_of_worship, M.name_of_model,
                                ST_X(ST_Centroid(W.geom)) AS longitude, ST_Y(ST_CENTROID(W.geom)) As latitude,
                                T.name_of_type AS constr, J.name_of_type AS type, ST_AsText(geom) AS geom, 
                                T.type_id AS constr_id, J.type_id AS type_wid, W.model_id
					            FROM worship_building AS W
                                LEFT JOIN type_of_construction AS T ON W.type_of_construction=T.type_id
                                LEFT JOIN type_of_worship AS J ON W.type_of_worship=J.type_id
                                LEFT JOIN building_model AS M ON M.model_id=W.model_id
                                WHERE W.worship_building_id='$id' 
				            ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $longitude = $row['longitude'];
                    $latitude = $row['latitude'];
                    $nama = $row['name_of_worship_building'];
                    $bang = $row['building_area'];
                    $lahan = $row['land_area'];
                    $parkir = $row['parking_area'];
                    $tahun = $row['standing_year'];
                    $listrik = $row['electricity_capacity'];
                    $alamat = $row['address'];
                    $konstruksi = $row['constr'];
                    $jenis = $row['type'];
                    $id_kons = $row['constr_id'];
                    $id_jenis = $row['type_wid'];
                    $geom = $row['geom'];
                    $model = $row['name_of_model'];
                    $id_model = $row['model_id'];
                }

                

                function tampilfoto(){
                    $id="KG165";
                    $sql = pg_query("SELECT photo_url, upload_date FROM worship_building_gallery WHERE worship_building_id='$id' 
                            ");
                    $cek = pg_num_rows($sql);

                    $n=0;$foto;$tglfoto;
                    while ($row = pg_fetch_assoc($sql)) {
                        $foto[$n]=$row['photo_url'];
                        $tglfoto[$n]=$row['upload_date'];
                        $n++;
                    }

                    $server='../../foto/b-ibadah/';
                    echo '<div data-carousel-3d>';
                    if ($cek<1) {
                        echo '
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="../../foto/ibadah.png" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="../../foto/ibadah.png" />
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

            
<h3>Building Info</h3>
<div class="row">
    <div class="col-lg-5 mt-5">
    <div class="card">
    <div class="card-body">
        <div class="media mb-5">
            <div class="media-body">
                <button type="button" class="btn btn-info btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#editinfo" style="float: right;"><i class="fa fa-edit"></i> Edit</button><br/>
                <h6>ID:
                    <?php echo $id ?>
                </h6>
                <br />
                <table style="width: 100%;">
                        <td>Building Area </td>
                        <td>:</td>
                        <td>
                            <?php echo $bang; ?> m<sup>2</sup>
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
                        <td>Building Model </td>
                        <td>:</td>
                        <td>
                            <?php echo $model ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Address </td>
                        <td>:</td>
                        <td>
                            <?php echo $alamat; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
            <!-- Modal -->
<div class="modal fade" id="editinfo">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="act/info-edit.php" style="width: 150%; background-color: white; border-radius: 1%">
            <div class="modal-header">
                <h6 class="modal-title">Edit Building Info</h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label> ID Survey</label><div id="ids"></div>
                        <input type="text" class="form-control" name="id" value="<?php echo $id ?>" id="id" onkeyup="besarkan()" onchange="cekid()" required>
                        <input type="hidden" name="id-temp" value="<?php echo $id ?>"/>
                    </div>
                    <div class="form-group col-sm-4" id="konstruksi">
                        <label>Construction Type</label>
                        <select name="konstruksi" class="form-control" style="height: 43px">
                            <?php                
                                $sql_jibadah=pg_query("SELECT * FROM type_of_construction ORDER BY name_of_type");
                                while($row = pg_fetch_assoc($sql_jibadah))
                                {
                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Building Area (m<sup>2</sup>)</label><label id="lbangs"></label>
                        <input type="text" class="form-control" name="lbang" id="lbang" onkeypress="return hanyaAngka(event, '#lbangs')" value="<?php echo $bang ?>">
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Electricity Capacity (kWh)</label><label id="listriks"></label>
                        <input type="text" class="form-control" name="listrik" value="<?php echo $listrik ?>" onkeypress="return hanyaAngka(event, '#listriks')">
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Standing Year</label><label id="tahuns"></label>
                        <input type="text" class="form-control" name="tahun" value="<?php echo $tahun ?>" onkeypress="return hanyaAngka(event, '#tahuns')">
                    </div>
                    <div class="form-group col-sm-4" id="model">
                        <label>Building Model</label>
                        <select name="model" class="form-control" style="height: 43px">
                            <?php                
                                $sql_j=pg_query("SELECT * FROM building_model ORDER BY name_of_model");
                                while($row = pg_fetch_assoc($sql_j))
                                {
                                    echo"<option value=".$row['model_id'].">".$row['name_of_model']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-8">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat"><?php echo $alamat ?></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="simpan">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php
$id_ada = '<div class="alert alert-danger alert-dismissible fade show" role="alert">This <strong>ID</strong> is already registered</div>';
?>

<script type="text/javascript">
    $("#jenis select").val(<?php echo "'".$id_jenis."'" ?>);
    $("#konstruksi select").val(<?php echo "'".$id_kons."'" ?>);
    $("#model select").val(<?php echo "'".$id_model."'" ?>);

    function besarkan() {
        var id=document.getElementById('id').value.toUpperCase();
        document.getElementById('id').value=id;
    }

    function cekid () {
        var id=document.getElementById('id').value
        var ketemu=false;
        <?php 
          $sql = pg_query("SELECT worship_building_id FROM worship_building WHERE worship_building_id NOT LIKE '$id'");
          while ($data = pg_fetch_array($sql))
          {
            $idnya = $data['worship_building_id'];
            echo "if (id == \"".$idnya."\")";
            echo "{
                    ketemu=true;
                    $('#ids').html('".$id_ada."');
                    $('#simpan').prop('disabled', true);
                  }";

          }
        ?>
         if (ketemu==false){
                $('#ids').empty();
                $('#simpan').prop('disabled', false);
            }
    }
</script>
                    </div>
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="media mb-5">
                                    <div class="media-body">
                                    <link rel="stylesheet" type="text/css" href="../../assets/css/dataTables.bootstrap4.min.css">

<a style="float: right; padding-right: 1%;">
<button type="button" class="btn btn-info btn-sm btn-flat btn-lg" data-toggle="modal" data-target="#editfoto"><i class="fa fa-edit"></i> Edit</button>
</a>
            <!-- Modal -->
<div class="modal fade bd-example-modal-lg modal-xl" id="editfoto">
    <div class="modal-dialog modal-lg modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit Photo: <?php echo $nama." (".$id.")" ?></h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="font-size: 110%">
            <?php
                $tgl=date('Y-m-d');
                //echo date("Ymdhis");
            ?>
                <form action="act/info-tambahfoto.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="file" name="gambar[]" multiple class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" name="kirim" value="+ Add Photo" class="btn btn-primary">
                        </div>
                    </div>
                    <br>
                    <input type="hidden" name="id-bang" value="<?php echo $id ?>">
                    <input type="hidden" name="tgl" value="<?php echo $tgl ?>">
                </form>

                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Upload Date</th>
                            <th>File Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = pg_query("SELECT photo_url, upload_date FROM worship_building_gallery WHERE worship_building_id='$id' 
                                ");
                        $server='../../foto/b-ibadah/';
                        while ($row = pg_fetch_assoc($sql)) {
                            $foto=$row['photo_url'];
                            $id2 = base64_encode($foto);
                            //$file = $server.$foto;
                            $file="http://127.0.0.1:8000/foto/bangunan/37C.jpg";
                            $b =fsize($file);
                            //$alamat = $_SERVER["HTTP_HOST"]$_SERVER["REQUEST_URI"];
                            echo "<tr>";
                            echo '<td><img src="'.$file.'" style="height: 50px;"/></td>';
                            echo '<td>'.$row['upload_date'];               
                            echo "<td>".$b."</td>";
                            echo '<td><a href="'.$file.'" target="_blank"><button type="button" class="btn btn-info btn-sm"><i class="ti-zoom-in"></i> Show Fullscreen</button></a>/
                                <button type="button" class="btn btn-danger btn-sm" onclick="hapusfoto('."'".$id."',"."'".$id2."'".')"><i class="fa fa-trash"></i> Delete</button>
                                </td>
                            ';
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
function fsize($file){
    $a = array("B", "KB", "MB", "GB", "TB", "PB");
    $pos = 0;
    //$size = filesize($file);
    $size = 1000;
    while ($size >= 1024)
    {
    $size /= 1024;
    $pos++;
    }
    return round ($size,2)." ".$a[$pos];
}
?>
<script type="text/javascript">
    function hapusfoto(idbang, idfoto) {
        reset();
        alertify.set({ labels: { ok: "Cancel", cancel: "Delete" } });
        alertify.confirm("Are you sure to delete this photo ?", function (e) {
            if (e) {
                alertify.success("You've clicked Cancel");
            } else {
                window.location.href = "act/info-hapusfoto.php?id-bang="+idbang+"&&id-foto="+idfoto;
            }
        });
        return false;
    }
</script>
                                        <h5 class="mb-3">Photo
                                            <button data-toggle="modal" data-target="#ukuranpenuh" class="btn btn-warning btn-sm"
                                                title="show all images in full screen">
                                                <i class="ti-fullscreen"></i>
                                            </button>
                                        </h5>
                                        <?php tampilfoto() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5">
                    <div class="card">
    <div class="card-body">
        <div class="media mb-5">
            <div class="media-body">

            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah-fas" style="float: right;">+ Add</button>
            
            <div class="modal fade" id="tambah-fas">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form method="post" action="act/info-tambahfas.php">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Worship Facilities</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p>Name of Worship Facilities:</p>
                                <select class="form-control" name="fasilitas" style="height: 43px">
                                <?php
                                    $sql_fas= pg_query("SELECT * FROM worship_building_facilities ORDER BY name_of_facility ASC");
                                    while($row = pg_fetch_assoc($sql_fas))
                                    {
                                        echo"<option value=".$row['facility_id'].">".$row['name_of_facility']."</option>";
                                    }
                                ?>
                                </select>
                                <br/>
                                <p>Quantity of facilities:<label id="fass"></label></p>
                                <input type="text" class="form-control" name="total-fas" id="total-fas" placeholder="quantity of facilities.." onkeypress="return hanyaAngka(event, '#fass')" onkeyup="cek_t()">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="tambahkanfas">+ Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <h5 class="mb-3">Facility</h5>

            <table width="100%" class="table table-striped table-bordered table-hover">
                <thead style="text-align: center;">
                    <th>Name of Facility</th>
                    <th>Qty</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php
                $nomor=1;
                $sql=pg_query("SELECT D.worship_building_id, D.facility_id, D.quantity_of_facilities, F.name_of_facility
                    FROM detail_worship_building_facilities AS D 
                    LEFT JOIN worship_building_facilities AS F ON F.facility_id=D.facility_id
                    WHERE D.worship_building_id = '$id'
                    ");
                $cekfas=pg_num_rows($sql);
                if ($cekfas==0) {
                    echo "<tr style='text-align: center;'><td colspan='3'>No facility data</td></tr>";
                }
                while ($data=pg_fetch_assoc($sql)) {
                    //$id_bang=str_replace(' ', '',$data['worship_building_id']);
                    $id_fas=$data['facility_id'];
                    $namafas =$data['name_of_facility'];
                    $qty = $data['quantity_of_facilities'];
                    echo "<tr>";
                    echo "<td>".$namafas."</td>";
                    echo "<td>".$qty."</td>";
                    echo '<td>
                        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-fas'.$nomor.'"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-fas'.$nomor.'"><i class="fa fa-trash"></i> Delete</button>
                        </td>';
                    echo "</tr>";
                    echo '
                        <div class="modal fade" id="edit-fas'.$nomor.'">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <form method="post" action="act/info-editfas.php">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Quantity of <b>'.$namafas.'</b>:<label id="fass2'.$nomor.'"></label></p>
                                        <input type="text" class="form-control" name="total-fas-edit" id="total-fas-edit'.$nomor.'" placeholder="quantity of facilities.." onkeypress="return hanyaAngka(event, '."'".'#fass2'."$nomor'".')" value="'.$qty.'" onkeyup="cek_e'.$nomor.'()">
                                            <input type="hidden" name="id-bang" value="'.$id.'">
                                            <input type="hidden" name="id-fas" value="'.$id_fas.'">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="fas-edit" id="fas-edit'.$nomor.'"><i class="ti-save"></i> Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                    	function cek_e'.$nomor.'() {
							var e = document.getElementById("total-fas-edit'.$nomor.'").value;
							console.log(e);
							if (e >= 1) {
								$("#fas-edit'.$nomor.'").prop("disabled", false);
							}
							else {
								$("#fas-edit'.$nomor.'").prop("disabled", true);	
							}
						}
                    </script>


                        <div class="modal fade" id="delete-fas'.$nomor.'">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete '.$namafas.' ?</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to delete "'.$namafas.'" from the list of facilities ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a href="act/info-deletefas.php?id-bang='.$id.'&&id-fas='.$id_fas.'"><button type="button" class="btn btn-danger">Delete</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                    $nomor=$nomor+1;
                }
            ?>
                    
                </tbody>
            </table>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$('#tambahkanfas').prop('disabled', true);
	function cek_t() {
		var t = document.getElementById('total-fas').value;
		if (t >= 1) {
			$('#tambahkanfas').prop('disabled', false);
		}
		else {
			$('#tambahkanfas').prop('disabled', true);	
		}
	}

	$("[name='fas-edit']").prop('disabled', true);
</script>
                    </div>
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="media mb-5">
                                    <div class="media-body">
                                        <h5 class="mb-3">Location</h5>
                                        <script src="../inc/mapupd.js" type="text/javascript"></script>
<style type="text/css">
    .readonly {
        background-color: #eee;
        cursor: col-resize;
    }
</style>

<a style="float: right; padding-right: 1%; padding-bottom: 6%; ">
<button type="button" class="btn btn-info btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#editlokasi"><i class="fa fa-edit"></i> Edit</button>
</a>
            <!-- Modal -->
<div class="modal fade bd-example-modal-lg modal-xl" id="editlokasi">
    <div class="modal-dialog modal-lg modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit Spasial Data / Location : <?php echo $nama." (".$id.")" ?></h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="post" action="act/info-editspasial.php">
                <div class="modal-body" style="font-size: 110%">
                    <!-- menampilkan peta-->
                    <div class="row">
                        <div class="col-lg-8">
                                <header class="panel-heading">
                                <h3>
                                <div class="row">
                                 <div class="col-lg-8">                    
                                  <input id="latlng" type="text" class="form-control" value="" placeholder="Latitude, Longitude"> <p/>
                                 </div>
                                 <div class="col-lg-4">
                                  <button class="btn btn-default my-btn" id="btnlatlng" type="button" title="Geocode"><i class="fa fa-search"></i></button>
                                  <button class="btn btn-default my-btn" type="button" title="Hapus Marker" onclick="hapusmarkerdankoor()"><i class="fa fa-ban"></i></button>
                                  <button class="btn btn-default my-btn" id="delete-button" type="button" title="Remove shape"><i class="fa fa-trash"></i></button> 
                                 </div>
                                </h3>
                                </header>
                              <div class="panel-body">
                                  <div id="map" style="width:100%;height:420px;"></div>
                              </div>
                        </div>
                        <div class="col-lg-4">
                            <input type="hidden" class="form-control" name="id-bang" value="<?php echo $id ?>">
                            <br/><br/><br/>
                            <label for="geom"><span style="color:red">*</span> Coordinat</label>
                            <textarea class="form-control readonly" id="geom" name="geom" required style="height: 50%"><?php echo $geom; ?></textarea>  
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });

    $("#geom").on( 'click', function () {
        reset();
        alertify.alert('<img src="../../inc/poligon.gif" width="150px"><br/>please draw the area with polygon on the map');
        return false;
    });
</script>
                                        <div style="padding-left: 1%; padding-bottom: 1%;">
                                            <?php //include('../../inc/aturlayer.php') ?>
                                        </div>
                                        <div style="width:100%; height: 360px;" id="map2"></div>
                                        <script>
                                            function initMap() {
                                                posisi = {lat: <?php echo $latitude ?>, lng: <?php echo $longitude ?>}
                                                map = new google.maps.Map(document.getElementById('map2'), {
                                                    center: posisi,
                                                    zoom: 19,
                                                    mapTypeId: 'satellite'
                                                });
                                                server='../../'
                                                semuadigitasi();

                                                var marker = new google.maps.Marker({
                                                position: posisi,
                                                icon:server+'assets/ico/musajik.png',
                                                animation: google.maps.Animation.BOUNCE,
                                                map: map
                                                });
                                            }

                                            initMap();
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
             <!-- SAMPAI DISINI BATAS ROW-->

            <div class="modal fade bd-example-modal-lg modal-xl" id="ukuranpenuh">
                <div class="modal-dialog modal-lg modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Foto</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <?php tampilfoto() ?>
                        </div>
                    </div>
                </div>
            </div>
@endsection