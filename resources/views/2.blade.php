<!DOCTYPE html>
<html>

<head>
    <!-- untuk meta description, keywords, dan author bisa ganti dan di sesuaikan tapi yang meta charset sama viewport jangan di ganti -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='description' content='WebGIS info-geospasial.com menyajikan berbagai informasi spasial di indonesia' />
    <meta name='keywords' content='WebGIS, WebGIS info-geospasial, WebGIS Indoensia' />
    <meta name='Author' content='Egi Septiana' />
    <title>WebGIS</title> <!-- title bisa di sesuaikan dengan nama judul WebGIS yang di inginkan -->
    <!-- <link rel="shortcut icon" href="img/ICO.png"/> -->
    <link rel="stylesheet" href="inc/leaflet/leaflet.css" /> <!-- memanggil css di folder leaflet -->
    <link rel="stylesheet" href="inc/leaflet/leaflet.groupedlayercontrol/src/leaflet.groupedlayercontrol.css" />
    <link rel="stylesheet" href="inc/leaflet/css/style.css" /> <!-- memanggil css style -->
    <link rel="stylesheet" href="inc/leaflet/leaflet-search-master/src/leaflet-search.css" />
    <link rel="stylesheet" href="inc/leaflet/leaflet.defaultextent-master/dist/leaflet.defaultextent.css" />
    <script src="inc/leaflet/leaflet.js"></script> <!-- memanggil leaflet.js di folder leaflet -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="inc/leaflet/leaflet-ajax/dist/leaflet.ajax.js"></script>
    <script src="inc/leaflet/leaflet.groupedlayercontrol/src/leaflet.groupedlayercontrol.js"></script>
    <script src="inc/leaflet/leaflet-providers-master/leaflet-providers.js"></script>
    <!-- memanggil leaflet-providers.js-->
    <script src="inc/leaflet/leaflet-search-master/src/leaflet-search.js"></script>
    <script src="inc/leaflet/leaflet.defaultextent-master/dist/leaflet.defaultextent.js"></script>
</head>

<body>
    <div id="map">
        <!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
        <script>
            // MENGATUR TITIK KOORDINAT TITIK TENGAN & LEVEL ZOOM PADA BASEMAP
            var map = L.map('map').setView([-0.322189, 100.34919], 15);

            // MENAMPILKAN SKALA
            L.control.scale({ imperial: false }).addTo(map);
            // ------------------- VECTOR ----------------------------
            var layer_GEOLOGI = new L.GeoJSON.AJAX("house_digit", { // layer geologi berada di dalam variabel layer_geologi
                style: function (feature) {
                    var fillColor, // ini style yang akan digunakan
                        kode = feature.properties.id; // perwarnaan objek polygon berdasarkan field kode  di dalam file geojson
                    if (kode != 17) fillColor = "#ffd700";
                    else if (kode > 16) fillColor = "#E3912B";
                    else if (kode > 15) fillColor = "#ED6933";
                    else if (kode > 14) fillColor = "#0070FF";
                    else if (kode > 13) fillColor = "#F5731C";
                    else if (kode > 12) fillColor = "#BFD9FF";
                    else if (kode > 11) fillColor = "#8C140D";
                    else if (kode > 10) fillColor = "#FFC400";
                    else if (kode > 9) fillColor = "#FF5500";
                    else if (kode > 8) fillColor = "#F79400";
                    else if (kode > 7) fillColor = "#FFBEBE";
                    else if (kode > 6) fillColor = "#97DBF2";
                    else if (kode > 5) fillColor = "#FF4766";
                    else if (kode > 4) fillColor = "#F27066";
                    else if (kode > 3) fillColor = "#732400";
                    else if (kode > 2) fillColor = "#A83800";
                    else if (kode > 1) fillColor = "#E64200";
                    else fillColor = "#FFFFED";  // no data
                    return { color: "#999", dashArray: '3', weight: 2, fillColor: fillColor, fillOpacity: 1 }; // style border sertaa transparansi
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup("<center>" + "<strong>" + feature.properties.id + "</strong>" + "<br/>" + feature.jenis + "</center>"), // popup yang akan ditampilkan diambil dari field nama dan keterangan
                        that = this; // perintah agar menghasilkan efek hover pada objek layer

                    layer.on('mouseover', function (e) {
                        this.setStyle({
                            weight: 2,
                            color: '#72152b',
                            dashArray: '',
                            fillOpacity: 0.8
                        });

                        if (!L.Browser.ie && !L.Browser.opera) {
                            layer.bringToFront();
                        }

                        info.update(layer.feature.properties);
                    });
                    layer.on('mouseout', function (e) {
                        layer_GEOLOGI.resetStyle(e.target); // isi dengan nama variabel dari layer
                        info.update();
                    });
                }
            }).addTo(map);
            var layer_ADMINISTRASI = new L.GeoJSON.AJAX("ibadah/digit", { // sekarang perintahnya diawali dengan variabel
                style: function (feature) {
                    var fillColor, // ini style yang akan digunakan
                        kode = feature.properties.id; // perwarnaan objek polygon berdasarkan kode kabupaten di dalam file geojson
                    if (kode > 5171) fillColor = "#ffd700";
                    else if (kode > 5108) fillColor = "#4ba754";
                    else if (kode > 5107) fillColor = "#9b3339";
                    else if (kode > 5106) fillColor = "#dd38e0";
                    else if (kode > 5105) fillColor = "#908965";
                    else if (kode > 5104) fillColor = "#3ab7e9";
                    else if (kode > 5103) fillColor = "#c8cf06";
                    else if (kode > 5102) fillColor = "#2f838c";
                    else if (kode > 5101) fillColor = "#fede36";
                    else fillColor = "#ff4040";  // no data
                    return { color: "#999", dashArray: '3', weight: 2, fillColor: fillColor, fillOpacity: 1 }; // style border sertaa transparansi
                },
                onEachFeature: function (feature, layer) {
                    layer.bindPopup("<center>" + feature.properties.nama + "</center>"), // popup yang akan ditampilkan diambil dari filed kab_kot
                        that = this; // perintah agar menghasilkan efek hover pada objek layer

                    layer.on('mouseover', function (e) {
                        this.setStyle({
                            weight: 2,
                            color: '#72152b',
                            dashArray: '',
                            fillOpacity: 0.8
                        });

                        if (!L.Browser.ie && !L.Browser.opera) {
                            layer.bringToFront();
                        }

                        info.update(layer.feature.properties);
                    });
                    layer.on('mouseout', function (e) {
                        layer_ADMINISTRASI.resetStyle(e.target); // isi dengan nama variabel dari layer
                        info.update();
                    });
                }
            }).addTo(map);
            layer_ADMINISTRASI.bringToFront()
            // MENAMBAHKAN TOOL PENCARIAN
            var searchlayer = L.featureGroup([layer_ADMINISTRASI, layer_GEOLOGI]);
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

                propertyName: 'nama', // nama field yang akan dijadikan acuan di dalam tool pencarian
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
                'Esri.WorldTopoMap': L.tileLayer.provider('Esri.WorldTopoMap').addTo(map),
                'Esri WorldImagery': L.tileLayer.provider('Esri.WorldImagery')
            };
            // membuat pilihan untuk menampilkan layer
            var overlays = {
                "PROVINSI BALI": {
                    "Administrasi": layer_ADMINISTRASI,
                    "Geologi": layer_GEOLOGI
                }
            };
            var options = {
                exclusiveGroups: ["PROVINSI BALI"]
            };

            var mixed = {
                "Geologi": layer_GEOLOGI,
                "Administrasi": layer_ADMINISTRASI
            };

            // MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
            //L.control.groupedLayers(baseLayers, options).addTo(map);
            L.control.layers(baseLayers, mixed).addTo(map);
        </script>
    </div>
</body>

</html>
</body>

</html>