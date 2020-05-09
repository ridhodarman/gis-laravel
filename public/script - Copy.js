var batasnagari;
var polylinenagari;
var warnanagari = "red";
var ketebalan = 3.0;
var njorong = 0;
var digitjorong = [];
var poligonjorong;
var nrumah = 0;
var digitrumah = [];
var poligonrumah;
var numkm = 0;
var digitumkm = [];
var poligonumkm;
var nibadah = 0;
var digitibadah = [];
var poligonibadah;
var nkantor = 0;
var digitkantor = [];
var poligonkantor;
var map;
var server="";
function loadpeta() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: -0.323489,
      lng: 100.349190
    },
    zoom: 14.5,
    mapTypeId: 'satellite'
  });
}

function digitasirumah() {
  $.ajax({
    url: server+'inc/datarumah.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var p1 = '<p> ID : ' + data.properties.id + '</p>';
        var p2 = '<p> Nama : ' + data.properties.nama + '</p>';
        var p3 = p1 + p2 + jenis;

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }

        digitrumah[nrumah] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'yellow',
          strokeOpacity: 2,
          strokeWeight: 0.5,
          fillColor: '#B22222',
          fillOpacity: 0.5,
          zIndex: 1,
          content: p3
        });
        digitrumah[nrumah].setMap(map);
        digitrumah[nrumah].addListener('click', function (event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var info = {
            lat: lat,
            lng: lng
          };
          infoWindow.setContent(this.content);
          infoWindow.setPosition(info);
          infoWindow.open(map);
        });
        nrumah = nrumah + 1;
      }
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
  poligonrumah = true;
}

function digitasiumkm() {
  $.ajax({
    url: server+'inc/dataumkm.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var p1 = '<p> ID : ' + data.properties.id + '</p>';
        var p2 = '<p> Nama : ' + data.properties.nama + '</p>';
        var p3 = p1 + p2 + jenis;

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }

        digitumkm[numkm] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'yellow',
          strokeOpacity: 1,
          strokeWeight: 0.5,
          fillColor: '#8A2BE2',
          fillOpacity: 0.35,
          zIndex: 2,
          content: p3
        });
        digitumkm[numkm].setMap(map);
        digitumkm[numkm].addListener('click', function (event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var info = {
            lat: lat,
            lng: lng
          };
          infoWindow.setContent(this.content);
          infoWindow.setPosition(info);
          infoWindow.open(map);
        });
        numkm = numkm + 1;
      }
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
  poligonumkm = true;
}


function digitasit4ibadah() {
  $.ajax({
    url: server+'inc/datat4ibadah.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var p1 = '<p> ID : ' + data.properties.id + '</p>';
        var p2 = '<p> Nama : ' + data.properties.nama + '</p>';
        var p3 = p1 + p2 + jenis;

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }

        digitibadah[nibadah] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'orange',
          strokeOpacity: 1,
          strokeWeight: 0.5,
          fillColor: 'green',
          fillOpacity: 0.5,
          zIndex: 2,
          content: p3
        });
        digitibadah[nibadah].setMap(map);
        digitibadah[nibadah].addListener('click', function (event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var info = {
            lat: lat,
            lng: lng
          };
          infoWindow.setContent(this.content);
          infoWindow.setPosition(info);
          infoWindow.open(map);
        });
        nibadah = nibadah + 1;
      }
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
  poligonibadah = true;
}

function digitasikantor() {
  $.ajax({
    url: server+'inc/datakantor.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var p1 = '<p> ID : ' + data.properties.id + '</p>';
        var p2 = '<p>' + data.properties.nama + '</p>';
        var p3 = p1 + p2 +'('+jenis+')';

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }

        digitkantor[nkantor] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'orange',
          strokeOpacity: 1,
          strokeWeight: 0.5,
          fillColor: 'blue',
          fillOpacity: 0.5,
          zIndex: 2,
          content: p3
        });
        digitkantor[nkantor].setMap(map);
        digitkantor[nkantor].addListener('click', function (event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var info = {
            lat: lat,
            lng: lng
          };
          infoWindow.setContent(this.content);
          infoWindow.setPosition(info);
          infoWindow.open(map);
        });
        nkantor = nkantor + 1;
      }
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
  poligonibadah = true;
}

function viewdigitnagari() {
  batasnagari = new google.maps.Data();
  batasnagari.loadGeoJson(server+'inc/batasnagari.php');
  batasnagari.setStyle(function (feature) {
    return ({
      strokeWeight: ketebalan,
      strokeColor: warnanagari,
      clickable: false,
    });
  });
  batasnagari.setMap(map);
  polylinenagari = true;
}


function digitasijorong() {
  $.ajax({
    url: server+'inc/jorong.php',
    dataType: 'json',
    cache: false,
    success: function (arrays) {
      for (i = 0; i < arrays.features.length; i++) {
        var data = arrays.features[i];
        var arrayGeometries = data.geometry.coordinates;
        var jenis = data.jenis;
        var p2 = data.properties.nama;
        var p3 = 'Jorong: ' + p2;

        var idTitik = 0;
        var hitungTitik = [];
        while (idTitik < arrayGeometries[0][0].length) {
          var aa = arrayGeometries[0][0][idTitik][0];
          var bb = arrayGeometries[0][0][idTitik][1];
          hitungTitik[idTitik] = {
            lat: bb,
            lng: aa
          };
          idTitik += 1;
        }
        if (data.properties.id == 1) {
          var warna = 'orange';
        } else if (data.properties.id == 2) {
          var warna = '#90EE90';
        } else if (data.properties.id == 3) {
          var warna = '#663399';
        }

        digitjorong[njorong] = new google.maps.Polygon({
          paths: hitungTitik,
          strokeColor: 'black',
          strokeOpacity: 0.4,
          strokeWeight: 2.5,
          fillColor: warna,
          fillOpacity: 0.2,
          zIndex: 0,
          clickable: false
        });
        digitjorong[njorong].setMap(map);
        njorong = njorong + 1;
      }
    }
  });
  var infoWindow = new google.maps.InfoWindow({
    map: map
  });
  var poligonjorong = true;
}


function layernagari() {
  if (document.getElementById("nagari").checked == 1) {
    if (polylinenagari == false) {
      batasnagari.setStyle(function (feature) {
        return {
          strokeWeight: ketebalan,
          strokeColor: warnanagari
        }
      });
    }
    cek();
  } else {
    // batasnagari.setMap(null);
    batasnagari.setStyle(function (feature) {
      return {
        strokeWeight: 0
      }
    });
    polylinenagari = false;
    document.getElementById("semua").checked = 0;
  }
}

function layerjorong() {
  if (document.getElementById("jorong").checked == 1) {
    if (poligonjorong == false) {
      var n = 0;
      while (n < njorong) {
        digitjorong[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
      poligonjorong = true;
    }
    cek();
  } else {
    var n = 0;
    while (n < njorong) {
      digitjorong[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    poligonjorong = false;
    document.getElementById("semua").checked = 0;
  }
}

function layerrumah() {
  if (document.getElementById("rumah").checked == 1) {
    if (poligonrumah == false) {
      var n = 0;
      while (n < nrumah) {
        digitrumah[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
      poligonrumah = true;
    }
    cek();
  } else {
    var n = 0;
    while (n < nrumah) {
      digitrumah[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    poligonrumah = false;
    document.getElementById("semua").checked = 0;
  }
}

function layerumkm() {
  if (document.getElementById("umkm").checked == 1) {
    if (poligonumkm == false) {
      var n = 0;
      while (n < numkm) {
        digitumkm[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
      poligonumkm = true;
    }
    cek();
  } else {
    var n = 0;
    while (n < numkm) {
      digitumkm[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    poligonumkm = false;
    document.getElementById("semua").checked = 0;
  }
}

function layeribadah() {
  if (document.getElementById("ibadah").checked == 1) {
    if (poligonibadah == false) {
      var n = 0;
      while (n < nibadah) {
        digitibadah[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
      poligonibadah = true;
    }
    cek();
  } else {
    var n = 0;
    while (n < numkm) {
      digitibadah[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    poligonibadah = false;
    document.getElementById("semua").checked = 0;
  }
}

function layerkantor() {
  if (document.getElementById("kantor").checked == 1) {
    if (poligonkantor == false) {
      var n = 0;
      while (n < nkantor) {
        digitkantor[n].setOptions({
          visible: true
        });
        n = n + 1;
      }
      poligonkantor = true;
    }
    cek();
  } else {
    var n = 0;
    while (n < nkantor) {
      digitkantor[n].setOptions({
        visible: false
      });
      n = n + 1;
    }
    poligonkantor = false;
    document.getElementById("semua").checked = 0;
  }
}

function ceklis() {
  var x = document.getElementsByName("layerpeta");
  if (document.getElementById("semua").checked == 1) {
    var i;
    for (i = 0; i < x.length; i++) {    
      document.getElementsByName("layerpeta")[i].checked = 1; 
    }
  }
  else {
    var i;
    for (i = 0; i < x.length; i++) {    
      document.getElementsByName("layerpeta")[i].checked = 0; 
    }
  }
  layernagari();
  layerjorong();
  layerumkm();
  layerrumah();
  layerkantor();
  layeribadah();
}


function cek() {
  x = document.getElementsByName("layerpeta");
  var stats=true;
  var i;
  for (i = 0; i < x.length; i++) {    
    if (document.getElementsByName("layerpeta")[i].checked == 0) {
      stats=false;
    }
  }
  if (stats==true) {
    document.getElementById("semua").checked = 1;
  } 
}

var markersDua = [];
var centerBaru;
var infoDua = [];
var fotosrc = 'foto/';
var markers = [];
var circles = [];
var pos = 'null';
var infowindow;
var centerLokasi;
var tampillegenda = false;


function legenda() {
  $('#legenda').empty();
  $('#legenda').append('<a class="btn btn-default" role="button" id="hidelegenda" data-toggle="tooltip" onclick="hideLegenda()" title="Hide Legend"><i class="fa fa-eye-slash" style="color:black;"></i></a>');

  if (tampillegenda == false) {
    var legend = document.getElementById('legend');
    var div = document.createElement('div');
    var isilegend = document.createElement('div');
    var content = [];
    content.push('<font style="color:red;"><b><sup>___</sup></b></font>Nagari Border<p/>');
    content.push('<p><div class="color a"></div>Jorong Ganting</p>');
    content.push('<p><div class="color b"></div>Jorong Koto Gadang</p>');
    content.push('<p><div class="color c"></div>Jorong Sutijo</p>');
    content.push('<p><div class="color e"></div>Place of Worship</p>');
    content.push('<p><div class="color f"></div>Tourism</p>');
    content.push('<p><div class="color g"></div>Small Industry</p>');
    content.push('<p><div class="color h"></div>Restaurant</p>');
    content.push('<p><div class="color i"></div>Hotel</p>');
    content.push('<p><div class="color j"></div>Culinary</p>');
    content.push('<p><div class="color k"></div>Souvenir</p>');
    content.push('<p><div class="color l"></div>Route Angkot</p>');
    isilegend.innerHTML = content.join('');
    legend.appendChild(isilegend);
    map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
    $('#legend').show();
    tampillegenda = true;
  } 
  else {
    $('#legend').show();
  }

}

function hideLegenda() {
  $('#legend').hide();
  $('#legenda').empty();
  $('#legenda').append('<button class="btn btn-default" title="show legend" onclick="legenda()"><i class="fa fa-globe"></i></button>');
}



function hapusInfo() {
  for (var i = 0; i < infoDua.length; i++) {
    infoDua[i].setMap(null);
  }
}

function aktifkanGeolocation() { //posisi saat ini
  navigator.geolocation.getCurrentPosition(function (position) {
    hapusMarkerInfowindow();
    hapusInfo();
    pos = {
      lat: position.coords.latitude,
      lng: position.coords.longitude

    };
    marker = new google.maps.Marker({
      position: pos,
      map: map,
      animation: google.maps.Animation.BOUNCE,
    });
    centerLokasi = new google.maps.LatLng(pos.lat, pos.lng);
    markers.push(marker);
    infowindow = new google.maps.InfoWindow({
      position: pos,
      content: "<a style='color:black;'>You Are Here</a> "
    });
    infowindow.open(map, marker);
    map.setCenter(pos);
  });
  document.getElementById("lat").value = pos.lat;
  document.getElementById("lng").value = pos.lng;
}

function hapusMarkerInfowindow() {
  setMapOnAll(null);
  hapusMarkerTerdekat();
  pos = 'null';
}

function hapusMarkerTerdekat() {
  for (var i = 0; i < markersDua.length; i++) {
    markersDua[i].setMap(null);
  }
}

function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

function manualLocation() { //posisi manual
  $('#posisimanual').modal('show');
  map.addListener('click', function (event) {
    addMarker(event.latLng);
  });
}

function addMarker(location) {
  hapusposisi();
  marker = new google.maps.Marker({
    position: location,
    map: map,
    animation: google.maps.Animation.DROP,
  });
  pos = {
    lat: location.lat(),
    lng: location.lng()
  }
  centerLokasi = new google.maps.LatLng(pos.lat, pos.lng);
  markers.push(marker);
  infowindow = new google.maps.InfoWindow();
  infowindow.setContent('Current Position');
  infowindow.open(map, marker);
  usegeolocation = true;
  google.maps.event.clearListeners(map, 'click');
  clearroute2();
  document.getElementById("lat").value = pos.lat;
  document.getElementById("lng").value = pos.lng;
}

function hapusposisi() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  markers = [];
}


function hapusRadius() {
  for (var i = 0; i < circles.length; i++) {
    circles[i].setMap(null);
  }
  circles = [];
  cekRadiusStatus = 'off';
}


function callRoute(start, end, nama) {
  if (pos == 'null' || typeof (pos) == "undefined") {
    $('#atur-posisi').modal('show');
  } 
  else {
    clearroute2();
    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;


    directionsService.route({
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
      },
      function (response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      }
    );
    directionsDisplay.setMap(map);
    map.setZoom(16);
    $('#detailrute').empty();
    $('#rute').show();
    $('#rute').append('<button class="btn btn-default btn-xs" onclick="tutuprute()" id="tutuprute" style="float: right;"><i class="fas fa-snowplow"></i> Clear Route</button>')
    $('#rute').append("<div class='panel-body' style='max-height:350px;overflow:auto;'><div class='form-group' id='detailrute'></div></div></div>");
    directionsDisplay.setPanel(document.getElementById('detailrute'));
  }
}


function tampilkanhasilcari() {
  $('#found').empty();
  $("#peta").addClass("col-md-9");
  $('#tampilanpencarian').show();
  $('#detail-informasi-pencarian').show();
  document.getElementById('panjangtabel').style.height = "460px";
}

function sembunyikancari() {
  $("#peta").removeClass("col-md-9");
  // $('#tampilanpencarian').hide();
  // $('#found').empty();
  // $('#hidecari').hide();
  // $('#rute').hide();
  $('#detail-informasi-pencarian').hide();
}

function resultt() {
  $("#result").show();
  $("#resultaround").hide();
  $("#eventt").hide();
  $("#infoo").hide();
  $("#att1").hide();
  $("#hide2").show();
  $("#showlist").hide();
  $("#radiuss").hide();
  $("#infoo1").hide();
  $("#att2").hide();
  $("#infoev").hide();
}

function rutetampil() {
  $("#att2").show();
  $("#att1").hide();
  $("#radiuss").hide();
  $("#infoo1").hide();
  $("#infoev").hide();
  $("#infoo").show();
  $("#rute").show();
}


function clearroute2() {
  if (typeof (directionsDisplay) != "undefined" && directionsDisplay.getMap() != undefined) {
    directionsDisplay.setMap(null);
    $("#detailrute").remove();
    $("#rute").empty();
    $("#rute").hide();
  }
}

function tutuprute() {
  $("#tutuprute").remove();
  clearroute2();
}

function refresh() {
  hapusposisi();
  sembunyikancari();
  initMap();
  $('#legenda').empty();
  $('#legenda').append('<button class="btn btn-default" title="show legend" onclick="legenda()"><i class="fa fa-globe"></i></button>');
}