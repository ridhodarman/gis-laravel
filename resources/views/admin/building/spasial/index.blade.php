@extends('admin.layouts.sidebar')

@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1TwYksj1uQg1V_5yPUZqwqYYtUIvidrY&libraries=drawing"></script>
<script type="text/javascript" src="{{ asset('script/map-tambah.js') }}"></script>
<script src="{{ asset('assets/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/sweetalert2/dist/sweetalert2.min.css') }}">
<script>
    function geom2() {
        Swal.fire({
        title: 'Sweet!',
        text: 'Modal with a custom image.',
        imageUrl: 'https://miro.medium.com/max/960/1*ST2GwMJxuWIAGMchig46SQ.gif',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
        })
    }
</script>
<div class="tombol-atas mt-3 mb-3 mr-5 ml-5" style="text-align: center;">
    <button class="btn btn-default btn-lg" style="width: 100%;" data-toggle="modal"
        data-target="#tambahibadah">+
        Add Worship Building Data 
    </button>
    </div>

<form role="form" action="act/tambah-b-ibadah.php" enctype="multipart/form-data" method="post">
<div class="modal fade bd-example-modal-lg modal-xl modal-dialog-scrollable" id="tambahibadah">
    <div class="modal-dialog modal-lg modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Worship Building Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-7">
                            
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <input id="latlng" type="text" class="form-control" value="" placeholder="Latitude, Longitude">
                                    <div id="notif"></div>
                                </div>
                                <div class="form-group col-sm-6" style="vertical-align:middle">
                                    <button class="btn btn-default" id="btnlatlng" type="button" title="Cari Koordinat"><i class="fa fa-search"></i></button>
                                    &emsp;
                                    <button class="btn btn-default" type="button" title="Hapus Marker" onclick="hapusmarkerdankoor()"><i
                                            class="fa fa-ban"></i></button>
                                    &emsp;
                                    <button class="btn btn-default" id="delete-button" type="button" title="Remove shape"><i
                                            class="fa fa-trash"></i></button>
                                </div>
                            </div>
                            <div class="panel-body" style="padding-top: 1%">
                                <div id="map" style="width:100%;height:450px;"></div>
                            </div>
                            
                        </div>
            <?php include('inc/koneksi2.php');    ?>
                        <div class="col-sm-5" style="margin-top: -10px;">
                            <!-- menampilkan form tambah-->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label><span style="color:red">*</span>ID Survey</label><div id="ids"></div>
                                    <input type="text" class="form-control" name="id" id="id" onkeyup="this.value = this.value.toLocaleUpperCase();" onchange="cekid()" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Construction Type</label>
                                    <select name="konstruksi" class="form-control" style="height: 43px">
                                        <option></option>
                                        <?php                
                                            $sql_j=pg_query("SELECT * FROM type_of_construction ORDER BY name_of_type");
                                            while($row = pg_fetch_assoc($sql_j))
                                            {
                                                echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Building Area (m<sup>2</sup>)</label><label id="lbangs"></label>
                                    <input type="text" class="form-control" name="lbang" value="" onkeypress="return hanyaAngka(event, '#lbangs')">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Standing Year</label><label id="tahuns"></label>
                                    <input type="text" class="form-control" name="tahun" value="" onkeypress="return hanyaAngka(event, '#tahuns')">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Electricity Capacity (VA)</label><label id="listriks"></label>
                                    <input type="text" class="form-control" name="listrik" value="" onkeypress="return hanyaAngka(event, '#listriks')">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Building Model</label>
                                    <select name="model" class="form-control" style="height: 43px">
                                        <option></option>
                                        <?php                
                                            $sql_j=pg_query("SELECT * FROM building_model ORDER BY name_of_model");
                                            while($row = pg_fetch_assoc($sql_j))
                                            {
                                                echo"<option value=".$row['model_id'].">".$row['name_of_model']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control h-25" rows="1" name="alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <nav style="display: flex; font-size: 95%;">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="customRadio1" name="customRadio2" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1" style="padding-left: 18px;">Google Map Drawing Tools</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio4" name="customRadio2" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio4" style="padding-left: 18px;">Input GeoJson</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio5" name="customRadio2" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio5" style="padding-left: 18px;">Add Coordinat List</label> 
                                    </div>
                                </nav>
                                <textarea class="form-control h-25" rows="4"
                                id="geom" name="geom" onclick="geom2()" readonly required></textarea>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-success btn-sm" onclick="inputkoordinat()">
                                        <i class="fas fa-map-pin"></i> add coordinat
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" onclick="hapuskoord()" style="text-shadow: #a1a1a1 0 0 10px;">
                                        <i class="fas fa-minus-circle"></i> remove the last coordinate
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapussemua()">
                                        <i class="fas fa-trash-alt"></i> delete all
                                    </button>
                                    <button type="button" class="btn btn-info btn-xs">
                                        <i class="fas fa-drafting-compass"></i> see GeoJson data on map
                                    </button>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="tambahbangunan">+ Add</button>
                </div>
        </div>
    </div>
</div>
</form>

<script>
    function inputkoordinat() {
        let geom = document.getElementById("geom").value;
        let angka = geom.split(",").length;
        let urutan = angka;
        (async () => {
        $("#tambahibadah .close").click()
        const { value: formValues } = await Swal.fire({
        title: `Enter coordinates (${urutan})`,
        showCloseButton: true,
        showCancelButton: true,
        padding: '3em',
        background: `#fff`,
        backdrop: `
            rgba(0,0,0,0.5)
            bottom right
            no-repeat
        `,
        html:
            '<input id="lat2" class="swal2-input" style="background-color: rgba(255,255,255,0.80)" placeholder="latitude, ex:-0,xx">' +
            '<input id="lng2" class="swal2-input" style="background-color: rgba(255,255,255,0.80)" placeholder="longitude, ex:100,xx">',
        focusConfirm: false,
        preConfirm: () => {
            return [
            document.getElementById('lat2').value,
            document.getElementById('lng2').value
            ]
        }
        })
        if (formValues) {
            let lat = document.getElementById('lng2').value;
            let lng = document.getElementById('lng2').value;
            if (!lat || !lng){
                Swal.fire(
                'The Internet?',
                'That thing is still around?',
                'info'
                )
            }
            else if (lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
                Swal.fire({
                html:
                    `
                    <div>${JSON.stringify(formValues)}</div>
                    <div id="map2" style="width:100%;height:300px;"></div>
                    `,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Great!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                    `<i class="fa fa-thumbs-down"></i> don't add`,
                cancelButtonAriaLabel: `Thumbs down don't add`
                }).then((result) => {
                if (result.value) {
                    let geom = document.getElementById('geom').value;
                    let str = geom.toLowerCase();
                    let check = str.includes("multipolygon(((");
                    if (check) {
                        let check2 = str.includes(")))");
                        if (check2) {
                            let tambah = geom.replace(")))", `,${lat} ${lng})))`);
                            document.getElementById('geom').value=tambah;
                        }
                        else {
                            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Invalid coordinates!' })
                        }
                    }
                    else {
                        document.getElementById('geom').value=`MULTIPOLYGON(((${lat} ${lng})))`
                    }
                    Swal.fire(
                    'Added!',
                    `coordinates: ${JSON.stringify(formValues)} added to textarea.`,
                    'success'
                    )
                }
                })
                const myLatLng = { lat: -25.363, lng: 131.044 };

                const map = new google.maps.Map(
                    document.getElementById("map2"),
                    {
                    zoom: 20,
                    center: myLatLng,
                    mapTypeId: google.maps.MapTypeId.SATELLITE,
                    gestureHandling: 'greedy'
                    }
                );

                new google.maps.Marker({
                    position: myLatLng,
                    map,
                    title: `coordinat location (${urutan})`
                });

            }
            else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid coordinates!'
                })
            }
                $('#tambahibadah').modal('show');
            }
        else {
            $('#tambahibadah').modal('show');
        }
        })()
        $(document).ajaxComplete(function(){
            $('#lat2').focus();
            $('#tambahibadah').modal('show');
        });
    }

    function hapuskoord() {
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d98200',
        cancelButtonColor: '#5c5c5c',
        confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
        if (result.value) {
            Swal.fire(
            'Removed!',
            'Your file has been removed.',
            'success'
            )
        }
        })
    }

    function hapussemua() {
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#5c5c5c',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.value) {
            $( "#delete-button" ).click();
            Swal.fire(
            'Deleted!',
            'Your GeoJson has been deleted.',
            'success'
            )
        }
        })
    }
</script>
    <div class="panel-body card" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-jeniskonstruksi">
        <h4 style="text-align: center;">Building List</h4>
        <table width="100%" class="table table-striped table-bordered table-hover" id="listkonstruksi">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include('inc/koneksi2.php');
                    $no=1;
                    $sql=pg_query("SELECT * from building");
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['building_id'];
                        $id_enc = "'".base64_encode($id)."'";
                        $jenis=$data['address'];
                        $ids="'".$id."'";
                        echo "<tr>";
                        echo "<td>".$id."</td>";
                        echo "<td>".$jenis."</td>";
                        echo '<td>
                                <a href="editbang"><button class="btn btn-info btn-xs"><i class="fa fa-info-circle"></i> View Detail</button></a>
                                <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-jenis'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                              </td>';
                        echo "</tr>";
                        $rumah=0;
                        $umkm=0;
                        $pendidikan=0;
                        $kesehatan=0;
                        $ibadah=0;
                        $kantor=0;
                        $total=0;
                        echo '
                                <div class="modal fade" id="delete-jenis'.$id.'">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete '.$jenis.' ?</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to delete "'.$jenis.'" from construction type list ? <br/>
                                                There are as many as <b> '.$total.' </b> building(s) that have this construction type.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-danger" onclick="hapusjenis('.$id_enc.','.$ids.')">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        ';
                        $no++;
                    }
                ?>
            </tbody>
        </table>
    </div>
    
    <script type="text/javascript">
    $("#geojson").prop('checked', false)
    
        //tambah data
        $(document).ready(function(){
            $("#tambahkan").click(function(){ 
                var jkonstruksi = document.getElementById('jenis').value;
                if (jkonstruksi==null || jkonstruksi=='') {
                    $('#datakosong').modal('show');
                }
                else {
                    var data = $('#form-tambahjenis').serialize();
                    $.ajax({
                        type: 'POST',
                        url: "tab/act/tambah-jeniskonstruksi.php",
                        data: data,
                        success: function() {
                            $('#tabel-jeniskonstruksi').load("tab/inc/load-jeniskonstruksi.php");
                            $('#tambahjenis').modal('hide');
                            $('#sukses-tambah').modal('show');
                            document.getElementById('jenis').value=null;
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $("#notifikasi").empty();
                            $('#gagal').modal('show');
                            $("#notifikasi").append("<p>"+xhr.status+"</p>");
                            $("#notifikasi").append("<p>"+thrownError+"</p>");
                        }
                    });
                }
            });
        });
    
        //hapus data
        function hapusjenis(id, idtemp) {
            $.ajax({ 
                url: 'tab/act/hapus-jeniskonstruksi.php?id='+id,
                data: "",
                success: function() {
                    $('#tabel-jeniskonstruksi').load("tab/inc/load-jeniskonstruksi.php");
                    $('#sukses-hapus').modal('show');
                    $('#delete-jenis'+idtemp).modal('hide');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#notifikasi").empty();
                    $('#gagal').modal('show');
                    $("#notifikasi").append("<p>"+xhr.status+"</p>");
                    $("#notifikasi").append("<p>"+thrownError+"</p>");
                }
            });
        }
    
        //edit data
        function editjenis(id) {
            var jkonstruksi_baru = document.getElementById('jenis-baru'+id).value;
                if (jkonstruksi_baru==null || jkonstruksi_baru=='') {
                    $('#datakosong').modal('show');
                }
                else {
                    var data = $('#form-editjenis'+id).serialize();
                    $.ajax({
                        url: "tab/act/edit-jeniskonstruksi.php?id="+id+"&jenis-baru="+jkonstruksi_baru,
                        data: "",
                        success: function() {
                            $('#tabel-jeniskonstruksi').load("tab/inc/load-jeniskonstruksi.php");
                            $('#edit-k'+id).modal('hide');
                            $('#sukses-update').modal('show');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $("#notifikasi").empty();
                            $('#gagal').modal('show');
                            $("#notifikasi").append("<p>"+xhr.status+"</p>");
                            $("#notifikasi").append("<p>"+thrownError+"</p>");
                        }
                    });
                }
        }
    
        $(document).ready(function() {
            $('#listkonstruksi').DataTable();
        } );
    </script>

<script type="text/javascript">
    $("#databangunan").addClass("active");
</script>
@endsection