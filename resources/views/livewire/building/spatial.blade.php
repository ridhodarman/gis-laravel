@section('title', 'Data Bangunan (Spasial)')
<div style="margin-top: -20px; float: right;">
    <a href="{{ route('bangunan') }}">
        <button class="btn btn-sm"> 
            <i class="fa fa-angle-double-left"></i>
            Back to previous page 
        </button>
    </a>
</div>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1TwYksj1uQg1V_5yPUZqwqYYtUIvidrY&libraries=drawing,places&v=weekly"></script>
<script type="text/javascript" src="{{ asset('script/map-tambah.js') }}"></script>
<script src="{{ asset('assets/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/sweetalert2/dist/sweetalert2.min.css') }}">
<div class="tombol-atas mt-5 mb-3 mr-5 ml-5" style="text-align: center;">
    <button class="btn btn-default btn-lg" style="width: 100%;" data-toggle="modal" data-target="#tambahibadah">
        + Add New Building Data
    </button>
</div>

<form role="form" action="{{ route('bangunan') }}" enctype="multipart/form-data" method="post">
    <div class="modal fade bd-example-modal-lg modal-xl modal-dialog-scrollable" id="tambahibadah">
        <div class="modal-dialog modal-lg modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Building Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php include('inc/koneksi2.php');    ?>
                        <div class="col-sm-5">
                            <!-- menampilkan form tambah-->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label><span style="color:red">*</span>ID Survey</label>
                                    <div id="ids"></div>
                                    <input type="text" class="form-control" name="building_id" id="id"
                                        onkeyup="this.value = this.value.toLocaleUpperCase();"
                                        required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Construction Type</label>
                                    <select name="type_of_construction" class="form-control" style="height: 43px">
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
                                    <input type="text" class="form-control" name="building_area" value="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Standing Year</label><label id="tahuns"></label>
                                    <input type="text" class="form-control" name="standing_year" value="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Electricity Capacity (VA)</label><label id="listriks"></label>
                                    <input type="text" class="form-control" name="electricity_capacity" value="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Building Model</label>
                                    <select name="building_model" class="form-control" style="height: 43px">
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
                                <textarea class="form-control h-25" rows="2" name="address"></textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Standing on a land of heirlooms?</strong></label>
                                <nav style="display: flex;">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked="true" id="antah" class="custom-control-input"
                                        name="heirloom_status_of_the_land">
                                        <label class="custom-control-label" for="antah" style="padding-left: 18px;">Not
                                            known</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="pusako" class="custom-control-input"
                                        name="heirloom_status_of_the_land" value="true">
                                        <label class="custom-control-label" for="pusako"
                                            style="padding-left: 18px;">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="indak" class="custom-control-input"
                                        name="heirloom_status_of_the_land" value="false">
                                        <label class="custom-control-label" for="indak"
                                            style="padding-left: 18px;">No</label>
                                    </div>
                                </nav>
                            </div>
                            <br />
                            <div class="form-group">
                                <label><strong>Is this a building with an heirloom status?</strong></label>
                                <nav style="display: flex;">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked="true" id="ntah" class="custom-control-input"
                                        name="heirloom_status_of_the_building">
                                        <label class="custom-control-label" for="ntah" style="padding-left: 18px;">Not
                                            known</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="iyo" class="custom-control-input"
                                        name="heirloom_status_of_the_building" value="true">
                                        <label class="custom-control-label" for="iyo"
                                            style="padding-left: 18px;">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="ndak" class="custom-control-input"
                                        name="heirloom_status_of_the_building" value="false">
                                        <label class="custom-control-label" for="ndak"
                                            style="padding-left: 18px;">No</label>
                                    </div>
                                </nav>
                            </div>
                            <div class="form-group">
                                <label><strong>have a source of tap water?</strong></label>
                                <nav style="display: flex;">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked="true" id="ntah" class="custom-control-input"
                                        name="tap_water">
                                        <label class="custom-control-label" for="ntah" style="padding-left: 18px;">
                                            Not known</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="iyo" class="custom-control-input"
                                        name="tap_water" value="true">
                                        <label class="custom-control-label" for="iyo"
                                            style="padding-left: 18px;">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="ndak" class="custom-control-input"
                                        name="tap_water" value="false">
                                        <label class="custom-control-label" for="ndak"
                                            style="padding-left: 18px;">No</label>
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <nav style="display: flex;">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="googlemaps" name="customRadio2"
                                            class="custom-control-input" onchange="spasial()">
                                        <label class="custom-control-label" for="googlemaps"
                                            style="padding-left: 18px;">Google Map Drawing Tools</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" onchange="spasial()">
                                        <input type="radio" id="geojson" name="customRadio2"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="geojson"
                                            style="padding-left: 18px;">Input GeoJson</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" onchange="spasial()">
                                        <input type="radio" id="koordinat" name="customRadio2"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="koordinat"
                                            style="padding-left: 18px;">Add Coordinat List</label>
                                    </div>
                                </nav>
                                <div id="inputgeom2"></div>
                            </div>
                            <div class="row" style="margin-left: 1%;" id="kontrolpeta">
                                <div class="col-sm-12">
                                    <div class="row">


                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <input id="latlng" type="text" class="form-control"
                                                    placeholder="Latitude, Longitude">
                                                <div class="input-group-append">
                                                    <button class="btn btn-default" type="button" id="btnlatlng"
                                                        title="search coordinate.."><b><i
                                                                class="fa fa-search"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <input id="pac-input" class="form-control" type="text"
                                                placeholder="Search places..." />
                                            <table>
                                                <tr>
                                                    <td>
                                                        <!-- <label for="address">find a place:</label> -->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input id="address" placeholder="find a place..." type="text"
                                                            tabindex="1" class="form-control" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div id="results" class="pac-container"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-default" type="button" title="Hapus Marker"
                                                onclick="hapusmarkerdankoor()"><i class="fa fa-ban"></i></button>
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-default" id="delete-button" type="button"
                                                title="Remove shape"><i class="fa fa-trash"></i></button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" style="padding-top: 1%;">
                                <div id="map" style="width:100%; height:450px;"></div>
                                <div id="mapcheck" style="width:100%; height:400px;"></div>
                            </div>
                            <div id="inputgeom"></div>
                            <div id="inputgeom1">
                                <textarea class="form-control h-25" rows="2" id="geom" name="geom" onclick="geom2()"
                                    readonly required></textarea>
                                <div id="kontroljson" class="table-responsive">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success btn-sm" onclick="tambahkoordinat()"
                                            name="ukoordinat">
                                            <i class="fas fa-map-pin"></i> add coordinates
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" onclick="hapuskoord()"
                                            style="text-shadow: #a1a1a1 0 0 10px;" name="ukoordinat">
                                            <i class="fas fa-minus-circle"></i> remove the last coordinate
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            title="delete all GeoJson data on this text area" onclick="hapussemua()"
                                            name="ukoordinat">
                                            <i class="fas fa-trash-alt"></i> delete GeoJson
                                        </button>
                                        <button type="button" class="btn btn-default btn-xs" name="ukoordinat">
                                            <i class="fas fa-paper-plane"></i> check the coordinate list
                                        </button>
                                        <button type="button" class="btn btn-info btn-xs"
                                            title="visualize the geojson data results in the text area on the map"
                                            onclick="check_geojson()">
                                            <i class="fas fa-drafting-compass"></i> check GeoJson data on map
                                        </button>
                                    </div>
                                    <label id="multipolygon"><span style="color:red">*</span>must be
                                        multipolygon</label>
                                    <div id="ids"></div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline btn-success" onclick="hitungluas()">calculate
                                the area</button>
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
    spasial(); //initAutocomplete();
    function geom2() {
        if ($('#googlemaps').is(':checked')) {
            Swal.fire({
                text: 'please draw polygons on the map',
                imageUrl: "{{ asset('assets/draw.gif') }}",
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        }
        if ($('#koordinat').is(':checked')) {
            Swal.fire({
                text: 'please enter the coordinates by pressing the add coordinates button',
                imageUrl: "{{ asset('assets/koordinat.gif') }}",
                imageWidth: 400,
                imageHeight: 300,
                imageAlt: 'Custom image',
            })
        }
    }

    function spasial() {
        if ($('#koordinat').is(':checked')) {
            jQuery("#inputgeom1").detach().prependTo('#inputgeom2');
            $('#kontrolpeta').hide();
            $("textarea[id*=geom]").attr('rows', '4');
            $('#geom').prop('readonly', true);
            $('#kontroljson').show();
            $("[name='ukoordinat']").show();
            $('#map').hide();
            $('#multipolygon').hide();
        }
        else if ($('#geojson').is(':checked')) {
            jQuery("#inputgeom1").detach().prependTo('#inputgeom2');
            $('#kontrolpeta').hide();
            $("textarea[id*=geom]").attr('rows', '4');
            $('#geom').prop('readonly', false);
            $('#kontroljson').show();
            $("[name='ukoordinat']").hide();
            $('#map').hide();
            $('#multipolygon').show();
        }
        else if ($('#googlemaps').is(':checked')) {
            if (gmapslayer == false) {
                initialize();
            }
            jQuery("#inputgeom1").detach().prependTo('#inputgeom');
            $('#kontrolpeta').show();
            $("textarea[id*=geom]").attr('rows', '2');
            $('#geom').prop('readonly', true);
            $('#kontroljson').hide();
            $('#map').show();
            $('#mapcheck').hide();
            $('#multipolygon').hide();
        }
    }
    function tambahkoordinat() {
        let geom = document.getElementById("geom").value;
        let angka = geom.split(",").length;
        let urutan = angka;
        let lat;
        let lng;
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
                lat = document.getElementById('lat2').value;
                lng = document.getElementById('lng2').value;
                if (!lat || !lng) {
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
                                    document.getElementById('geom').value = tambah;
                                }
                                else {
                                    let tambah = `,${lat} ${lng})))`;
                                    document.getElementById('geom').value = tambah;
                                }
                            }
                            else {
                                document.getElementById('geom').value = `MULTIPOLYGON(((${lat} ${lng})))`
                            }
                            Swal.fire(
                                'Added!',
                                `coordinates: ${JSON.stringify(formValues)} added to textarea.`,
                                'success'
                            )
                        }
                    })
                    
                    let lat2 = Number(lat);
                    let lng2 = Number(lng);
                    let myLatLng = { lat: lat2, lng: lng2 };

                    let map = new google.maps.Map(
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
        $(document).ajaxComplete(function () {
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
                $("#delete-button").click();
                document.getElementById("geom").value = "";
                Swal.fire(
                    'Deleted!',
                    'Your GeoJson has been deleted.',
                    'success'
                )
            }
        })
    }

    function check_geojson() {
        $('#map').hide();
        $('#mapcheck').show();
        const map = new google.maps.Map(
            document.getElementById("mapcheck"),
            {
                zoom: 17,
                center: { lat: -0.31248978140928513, lng: 100.34191559230665 },
                mapTypeId: "satellite"
            }
        );

        // Define the LatLng coordinates for the polygon's path.
        let geom = document.getElementById("geom").value;
        let str = geom.toLowerCase();
        let check = str.includes("multipolygon(((");
        let check2 = str.includes(")))");
        let teks;
        if (check && check2) {
            teks = str.replace("multipolygon(((", "");
            teks = teks.replace(")))", "");
        }
        console.log(teks);
        let jumlahkoordinat = (teks.match(/,/g) || []).length + 1;
        console.log(jumlahkoordinat);
        let array = teks.split(/,| /) ;
        console.log(array);

        var point = 0;
        var id_point = 0;
        var hitungpoint = [];
        let a,b;
        while (point < jumlahkoordinat*2) {
            a = Number(array[point]);
            point = point + 1;
            b = Number(array[point]);
            point = point + 1;
            hitungpoint[id_point] = { lat: b, lng: a };
            id_point = id_point + 1;
        }

        tampilkandigit = new google.maps.Polygon({
            paths: hitungpoint,
            strokeColor: "blue",
            strokeOpacity: 0.5,
            strokeWeight: 1,
            fillColor: "black",
            fillOpacity: 0.7,
        });
        tampilkandigit.setMap(map);
        
        //center terakhir
        map.setCenter({lat: b, lng: a});

        // //center tengah
        // let y1 = array[0+1];
        // let y2 = array[point-1];
        // let x1 = array[0];
        // let x2 = array[point-2];

        // let x = x1 + ((x2 - x1) / 2);
        // let y = y1 + ((y2 - y1) / 2);
        // map.setCenter({ lat:  Number(y), lng:  Number(x) });

        //alert(tampilkandigit.my_getBounds().getCenter())
        
        // const triangleCoords = [
        //     { lat: 25.774, lng: -80.19 },
        //     { lat: 18.466, lng: -66.118 },
        //     { lat: 32.321, lng: -64.757 },
        //     { lat: 25.774, lng: -80.19 }
        // ];

        // // Construct the polygon.
        // const bermudaTriangle = new google.maps.Polygon({
        //     paths: triangleCoords,
        //     strokeColor: "#FF0000",
        //     strokeOpacity: 0.8,
        //     strokeWeight: 2,
        //     fillColor: "#FF0000",
        //     fillOpacity: 0.35
        // });
        //bermudaTriangle.setMap(map);

    }

    function hitungluas() {
        Swal.fire('Anyone can use a computer');
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
    $(document).ready(function () {
        $("#tambahkan").click(function () {
            var jkonstruksi = document.getElementById('jenis').value;
            if (jkonstruksi == null || jkonstruksi == '') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-tambahjenis').serialize();
                $.ajax({
                    type: 'POST',
                    url: "tab/act/tambah-jeniskonstruksi.php",
                    data: data,
                    success: function () {
                        $('#tabel-jeniskonstruksi').load("tab/inc/load-jeniskonstruksi.php");
                        $('#tambahjenis').modal('hide');
                        $('#sukses-tambah').modal('show');
                        document.getElementById('jenis').value = null;
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $("#notifikasi").empty();
                        $('#gagal').modal('show');
                        $("#notifikasi").append("<p>" + xhr.status + "</p>");
                        $("#notifikasi").append("<p>" + thrownError + "</p>");
                    }
                });
            }
        });
    });

    //hapus data
    function hapusjenis(id, idtemp) {
        $.ajax({
            url: 'tab/act/hapus-jeniskonstruksi.php?id=' + id,
            data: "",
            success: function () {
                $('#tabel-jeniskonstruksi').load("tab/inc/load-jeniskonstruksi.php");
                $('#sukses-hapus').modal('show');
                $('#delete-jenis' + idtemp).modal('hide');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#notifikasi").empty();
                $('#gagal').modal('show');
                $("#notifikasi").append("<p>" + xhr.status + "</p>");
                $("#notifikasi").append("<p>" + thrownError + "</p>");
            }
        });
    }

    //edit data
    function editjenis(id) {
        var jkonstruksi_baru = document.getElementById('jenis-baru' + id).value;
        if (jkonstruksi_baru == null || jkonstruksi_baru == '') {
            $('#datakosong').modal('show');
        }
        else {
            var data = $('#form-editjenis' + id).serialize();
            $.ajax({
                url: "tab/act/edit-jeniskonstruksi.php?id=" + id + "&jenis-baru=" + jkonstruksi_baru,
                data: "",
                success: function () {
                    $('#tabel-jeniskonstruksi').load("tab/inc/load-jeniskonstruksi.php");
                    $('#edit-k' + id).modal('hide');
                    $('#sukses-update').modal('show');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#notifikasi").empty();
                    $('#gagal').modal('show');
                    $("#notifikasi").append("<p>" + xhr.status + "</p>");
                    $("#notifikasi").append("<p>" + thrownError + "</p>");
                }
            });
        }
    }

    $(document).ready(function () {
        $('#listkonstruksi').DataTable();
    });
</script>

<script type="text/javascript">
    $("#databangunan").addClass("active");
</script>