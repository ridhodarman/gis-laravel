<!DOCTYPE html>
<html>

<head>
    <!-- untuk meta description, keywords, dan author bisa ganti dan di sesuaikan tapi yang meta charset sama viewport jangan di ganti -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='description' content='' />
    <meta name='keywords' content='' />
    <meta name='Author' content='' />
    <title>WebGIS</title> <!-- title bisa di sesuaikan dengan nama judul WebGIS yang di inginkan -->
    <!-- <link rel="shortcut icon" href="{{ asset('img/ICO.png') }}"> -->
    @include('inc.head')
    <link rel="stylesheet" href="{{ asset('inc/leaflet/leaflet.css') }}"> <!-- memanggil css di folder leaflet -->
    <link rel="stylesheet" href="{{ asset('inc/leaflet/leaflet.groupedlayercontrol/src/leaflet.groupedlayercontrol.css') }}">
    <link rel="stylesheet" href="{{ asset('inc/leaflet/css/style.css') }}"> <!-- memanggil css style -->
    <link rel="stylesheet" href="{{ asset('inc/leaflet/leaflet-search-master/src/leaflet-search.css') }}">
    <link rel="stylesheet" href="{{ asset('inc/leaflet/leaflet.defaultextent-master/dist/leaflet.defaultextent.css') }}">
    <script src="{{ asset('inc/leaflet/leaflet.js') }}"></script> <!-- memanggil leaflet.js di folder leaflet -->
    <!-- <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script> -->
    <script src="{{ asset('inc/leaflet/leaflet-ajax/dist/leaflet.ajax.js') }}"></script>
    <script src="{{ asset('inc/leaflet/leaflet.groupedlayercontrol/src/leaflet.groupedlayercontrol.js') }}"></script>
    <script src="{{ asset('inc/leaflet/leaflet-providers-master/leaflet-providers.js') }}"></script>
    <!-- memanggil leaflet-providers.js-->
    <script src="{{ asset('inc/leaflet/leaflet-search-master/src/leaflet-search.js') }}"></script>
    <script src="{{ asset('inc/leaflet/leaflet.defaultextent-master/dist/leaflet.defaultextent.js') }}"></script>
</head>

<body>
    <script>let info;</script>
    <div id="map">
        <div id='ajax-wait2' style="z-index: 999; position: fixed; width: 100%;">
            <div style="text-align: center;">
                <font color="#5186db" size="3pt" style="text-shadow: #ffffff 0 0 30px;"><b> Loading...</b></font>
            </div>
        </div>
        <!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
        <script>
            // MENGATUR TITIK KOORDINAT TITIK TENGAN & LEVEL ZOOM PADA BASEMAP
            var map = L.map('map').setView([-0.322189, 100.34919], 15);

            // MENAMPILKAN SKALA
            L.control.scale({ imperial: false }).addTo(map);
            // ------------------- VECTOR ----------------------------
            var layer_rumah = new L.GeoJSON.AJAX("rumah/digit", { // layer geologi berada di dalam variabel layer_rumah
                style: function (feature) {
                    return { color: "#999", dashArray: '2', weight: 1.5, fillColor: "#db9174", fillOpacity: 0.6 }; // style border sertaa transparansi
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup(`<center>
                                        <strong>${feature.properties.id}</strong>
                                        <br/> ${feature.jenis}
                                        <br/>
                                        <button class='btn btn-info btn-xs' title='View Details' onclick="detailrumah('${feature.properties.id}')">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                        </center>`), // popup yang akan ditampilkan diambil dari field nama dan keterangan
                        that = this; // perintah agar menghasilkan efek hover pada objek layer

                    layer.on('mouseover', function (e) {
                        this.setStyle({
                            weight: 1.5,
                            color: '#522500',
                            dashArray: '',
                            fillOpacity: 0.8
                        });

                        // if (!L.Browser.ie && !L.Browser.opera) {
                        //     layer.bringToFront();
                        // }

                        info.update(layer.feature.properties);
                    });
                    layer.on('mouseout', function (e) {
                        layer_rumah.resetStyle(e.target); // isi dengan nama variabel dari layer
                        info.update();
                    });
                }
            }).addTo(map);

            var layer_umkm = new L.GeoJSON.AJAX("umkm/digit", { // sekarang perintahnya diawali dengan variabel
                style: function (feature) {
                    return { color: "#999", dashArray: '2', weight: 1.5, fillColor: "#a579ab", fillOpacity: 0.6 }; // style border sertaa transparansi
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup("<center>" + feature.properties.nama + "</center>"), // popup yang akan ditampilkan diambil dari filed kab_kot
                        that = this; // perintah agar menghasilkan efek hover pada objek layer

                    layer.on('mouseover', function (e) {
                        this.setStyle({
                            weight: 1.5,
                            color: '#330c42',
                            dashArray: '',
                            fillOpacity: 0.8
                        });

                        info.update(layer.feature.properties);
                    });
                    layer.on('mouseout', function (e) {
                        layer_umkm.resetStyle(e.target); // isi dengan nama variabel dari layer
                        info.update();
                    });
                }
            }).addTo(map);

            var layer_pendidikan = new L.GeoJSON.AJAX("pendidikan/digit", { 
                style: function (feature) {
                    return { color: "#999", dashArray: '2', weight: 1.5, fillColor: "#4b5057", fillOpacity: 0.6 }; 
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup("<center>" + feature.properties.nama + "</center>"), 
                        that = this; 

                    layer.on('mouseover', function (e) {
                        this.setStyle({
                            weight: 1.5,
                            color: '#000000',
                            dashArray: '',
                            fillOpacity: 0.8
                        });

                        info.update(layer.feature.properties);
                    });
                    layer.on('mouseout', function (e) {
                        layer_pendidikan.resetStyle(e.target); 
                        info.update();
                    });
                }
            }).addTo(map);

            var layer_kantor = new L.GeoJSON.AJAX("kantor/digit", { 
                style: function (feature) {
                    return { color: "#999", dashArray: '2', weight: 1.5, fillColor: "#3f45ab", fillOpacity: 0.6 }; 
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup("<center>" + feature.properties.nama + "</center>"), 
                        that = this; 

                    layer.on('mouseover', function (e) {
                        this.setStyle({
                            weight: 1.5,
                            color: '#0a104a',
                            dashArray: '',
                            fillOpacity: 0.8
                        });

                        info.update(layer.feature.properties);
                    });
                    layer.on('mouseout', function (e) {
                        layer_kantor.resetStyle(e.target); 
                        info.update();
                    });
                }
            }).addTo(map);

            var layer_kesehatan = new L.GeoJSON.AJAX("kesehatan/digit", { 
                style: function (feature) {
                    return { color: "#999", dashArray: '2', weight: 1.5, fillColor: "#ff002b", fillOpacity: 0.4 }; 
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup("<center>" + feature.properties.nama + "</center>"), 
                        that = this; 

                    layer.on('mouseover', function (e) {
                        this.setStyle({
                            weight: 1.5,
                            color: '#ff0000',
                            dashArray: '',
                            fillOpacity: 0.8
                        });

                        info.update(layer.feature.properties);
                    });
                    layer.on('mouseout', function (e) {
                        layer_kesehatan.resetStyle(e.target); 
                        info.update();
                    });
                }
            }).addTo(map);

            var layer_ibadah = new L.GeoJSON.AJAX("ibadah/digit", { 
                style: function (feature) {
                    return { color: "#999", dashArray: '2', weight: 1.5, fillColor: "#7fc779", fillOpacity: 0.6 }; 
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup("<center>" + feature.properties.nama + "</center>"), 
                        that = this; 

                    layer.on('mouseover', function (e) {
                        this.setStyle({
                            weight: 1.5,
                            color: '#004202',
                            dashArray: '',
                            fillOpacity: 0.8
                        });

                        info.update(layer.feature.properties);
                    });
                    layer.on('mouseout', function (e) {
                        layer_ibadah.resetStyle(e.target); 
                        info.update();
                    });
                }
            }).addTo(map);

            var layer_jorong = new L.GeoJSON.AJAX("jorong/digit", { 
                style: function (feature) {
                    var fillColor, // ini style yang akan digunakan
                        kode = feature.properties.id; // perwarnaan objek polygon berdasarkan field kode  di dalam file geojson
                    if (kode == "GT") fillColor = "#C2DBC0";
                    else if (kode == "KG") fillColor = "#F6F6C3";
                    else if (kode == "SJ") fillColor = "#D0DEF5";
                    else fillColor = "#d9d9d9";  // no data
                    return { color: fillColor, dashArray: '0', weight: 0.1, fillColor: fillColor, fillOpacity: 0.25 };  // style border sertaa transparansi
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup("<center>Jorong: " + feature.properties.nama + "</center>"), 
                        that = this; 

                    // layer.on('mouseover', function (e) {
                    //     this.setStyle({
                    //         weight: 2,
                    //         color: '#004202',
                    //         dashArray: '',
                    //         fillOpacity: 0.1
                    //     });
                    //     info.update(layer.feature.properties);
                    // });
                    // layer.on('mouseout', function (e) {
                    //     layer_jorong.resetStyle(e.target); 
                    //     info.update();
                    // });
                }
            }).addTo(map);

            var layer_nagari = new L.GeoJSON.AJAX("nagari/digit", { 
                style: function (feature) {
                    return { color: "#ff0011", dashArray: '4', weight: 2, fillColor: "#ffffff", fillOpacity: 0 }; 
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup("<center>" + feature.properties.nama + "</center>"), 
                        that = this; 

                    layer.on('mouseover', function (e) {
                        this.setStyle({
                            weight: 2,
                            color: '#ad000c',
                            dashArray: '',
                            fillOpacity: 0.8
                        });

                        info.update(layer.feature.properties);
                    });
                    layer.on('mouseout', function (e) {
                        layer_nagari.resetStyle(e.target); 
                        info.update();
                    });
                }
            }).addTo(map);

            // MENAMBAHKAN TOOL PENCARIAN
            var searchlayer = L.featureGroup([layer_ibadah, layer_rumah, layer_kantor, layer_pendidikan, layer_kesehatan, layer_umkm]);
            L.Control.Search.include({
                _recordsFromLayer: function () { //return table: key,value from layer
                    var that = this,
                        retRecords = {},
                        propName = this.options.propertyName,
                        loc;

                    function searchInLayer(layer) {
                        if (layer instanceof L.Control.Search.Marker) return;

                        if (layer instanceof L.Marker || layer instanceof L.CircleMarker) {
                            if (that._getPath(layer.options, propName)) {
                                loc = layer.getLatLng();
                                loc.layer = layer;
                                retRecords[that._getPath(layer.options, propName)] = loc;

                            } else if (that._getPath(layer.feature.properties, propName)) {

                                loc = layer.getLatLng();
                                loc.layer = layer;
                                retRecords[that._getPath(layer.feature.properties, propName)] = loc;

                            } else {
                                throw new Error("propertyName '" + propName + "' not found in marker");
                            }
                        } else if (layer.hasOwnProperty('feature')) { //GeoJSON

                            if (layer.feature.properties.hasOwnProperty(propName)) {
                                loc = layer.getBounds().getCenter();
                                loc.layer = layer;
                                retRecords[layer.feature.properties[propName]] = loc;
                            } else {
                                throw new Error("propertyName '" + propName + "' not found in feature");
                            }
                        } else if (layer instanceof L.LayerGroup) {
                            //TODO: Optimize
                            layer.eachLayer(searchInLayer, this);
                        }
                    }

                    this._layer.eachLayer(searchInLayer, this);

                    return retRecords;
                }
            });

            L.control.search({

                layer: searchlayer,

                propertyName: 'id', // nama field yang akan dijadikan acuan di dalam tool pencarian
                moveToLocation: function (latlng, title, map) {
                    //map.fitBounds( latlng.layer.getBounds() );
                    var zoom = map.getBoundsZoom(latlng.layer.getBounds());
                    map.setView(latlng, zoom); // access the zoom
                }
            })
                .addTo(map);

            // menambahkan tools defautl extent
            L.control.defaultExtent().addTo(map);
            // PILIHAN BASEMAP YANG AKAN DITAMPILKAN
            var baseLayers = {
                'Esri.WorldTopoMap': L.tileLayer.provider('Esri.WorldTopoMap',{maxNativeZoom:17,maxZoom:23}).addTo(map),
                'Esri WorldImagery': L.tileLayer.provider('Esri.WorldImagery', {maxNativeZoom:17,maxZoom:18})
            };
            // membuat pilihan untuk menampilkan layer
            var overlays = {
                "PROVINSI BALI": {
                    "Administrasi": layer_ibadah,
                    "Geologi": layer_rumah
                }
            };
            var options = {
                exclusiveGroups: ["PROVINSI BALI"]
            };

            var mixed = {
                "House/residence": layer_rumah,
                "Eduational Building": layer_pendidikan,
                "Office Building": layer_kantor,
                "Health Service": layer_kesehatan,
                "MSME": layer_umkm,
                "Worship Place": layer_ibadah,
                "Nagari Border": layer_nagari,
                "Jorong Area": layer_jorong
            };

            $(window).bind("load", function () {
                layer_rumah.bringToFront();
                layer_pendidikan.bringToFront();
                layer_kantor.bringToFront();
                layer_kesehatan.bringToFront();
                layer_umkm.bringToFront();
                layer_ibadah.bringToFront();
                $("#ajax-wait2").fadeOut();
            });

            // MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
            //L.control.groupedLayers(baseLayers, options).addTo(map);
            L.control.layers(baseLayers, mixed).addTo(map);
        </script>
    </div>
</body>
<div class="modal fade bd-example-modal-lg modal-xl" id="info-bang">
    <div class="modal-dialog modal-lg modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jenis-bang"></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="background-color: #eee">
                <div id='ajax-wait' style="z-index: 999; position: fixed;">
                    <center>
                        <img alt='loading...' src='inc/loading-x.gif' width='65' height='65' />
                        &emsp;
                        <font color="#5186db" size="5pt"><b> Loading...</b></font>
                    </center>
                </div>
                <div id="konten-bang"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</html>
</body>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('#detail-informasi-pencarian').hide();
    function detailumkm(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-store-alt'></i> Micro, Small, Medium, Enterprise Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load(`umkm/detail/${id}`);
    }

    function detailibadah(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-mosque'></i> Worship Building Info")
        $('#info-bang').modal('show');
        //$('#konten-bang').load("inc/detail-ibadah.php?id="+id);
        //$('#konten-bang').load(`ibadah_detail/${id}`);
        $('#konten-bang').load(`ibadah/detail/${id}`);
    }

    function detailpendidikan(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-school'></i> Educational Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load(`pendidikan/detail/${id}`);
    }

    function detailkesehatan(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-hospital-alt'></i> Health Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load(`kesehatan/detail/${id}`);
    }

    function detailkantor(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fa fa-bank'></i> Office Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load(`kantor/detail/${id}`);
    }

    function detailrumah(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='ti-home'></i> House Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load(`rumah/detail/${id}`);
    }

    function load_popup() {
        $(document).ajaxStart(function () {
            $("#ajax-wait").css({
                left: ($(window).width() - 32) / 2 + "px", // 32 = lebar gambar
                top: ($(window).height() - 32) / 2 + "px", // 32 = tinggi gambar
                display: "block"
            })
        }).ajaxComplete(function () {
            $("#ajax-wait").fadeOut();
        });
    }


    $(document).ajaxStart(function () {
        $("#ajax-wait2").fadeIn();
        $("#ajax-wait2").css({
            left: ($(window).width() - 32) / 2 + "px", // 32 = lebar gambar
            top: ($(window).height() - 32) / 2 + "px", // 32 = tinggi gambar
            display: "block"
        })
    }).ajaxComplete(function () {
        $("#ajax-wait2").fadeOut();
    });
</script>
</html>