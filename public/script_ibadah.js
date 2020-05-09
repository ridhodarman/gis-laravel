function datamesjid(url){
  $.ajax({
    url: url,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_ibadah(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function cari_ibadah(rows) {
  hapusInfo();
  hapusRadius();
  clearroute2();
  hapusMarkerTerdekat();
  $('#hasilcari').empty();
  $('#found').empty();
  if (rows == null) {
    $('#kosong').modal('show');
    $('#hasilcari').append('<td colspan="2">no result</td>');
  }
  else {
    let a = 0;
    for (let i in rows) {
      let row = rows[i];
      let id = row.id;
      let name = row.name;
      let latitude = row.latitude;
      let longitude = row.longitude;
      centerBaru = new google.maps.LatLng(latitude, longitude);
      marker = new google.maps.Marker({
        position: centerBaru,
        icon: 'assets/ico/musajik.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindowibadah(id);
      map.setZoom(15);
      tampilkanhasilcari();
      $('#hasilcari').append("<tr><td>" + name + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailibadah_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
      a = a + 1;
    }
    $('#found').append("Found: " + a)
    $('#hidecari').show();
  }
}

function tampilsemuaibadah() {
  let url = `${server}/ibadah_semua`;
  datamesjid(url);
}

function carinamaibadah() { 
  let namaibadah = document.getElementById("namaibadah").value;
  let url = `${server}/ibadah_cari_nama/${namaibadah}`;
  datamesjid(url);
}

function carijenis_ibadah() { 
  let jenis = document.getElementById("jenisibadah").value;
  let url = `${server}/ibadah_cari_jenis/${jenis}`;
  datamesjid(url);
}

function carikons_ibadah() { 
  let konstruksi = document.getElementById("jeniskons_ibadah").value;
  let url = `${server}/ibadah_cari_konstruksi/${konstruksi}`;
  datamesjid(url);
}

function cariluasbang_ibadah() { 
  let luasbang = [];
  luasbang[0] = document.getElementById("ibadah_awalbang").value;
  luasbang[1] = document.getElementById("ibadah_akhirbang").value;
  let url = `${server}/ibadah_cari_luasbang/${luasbang}`;
  datamesjid(url);
}

function cariluastanah_ibadah() { 
  let luastanah = [];
  luastanah[0] = document.getElementById("ibadah_awaltanah").value;
  luastanah[1] = document.getElementById("ibadah_akhirtanah").value;
  let url = `${server}/ibadah_cari_luastanah/${luastanah}`;
  datamesjid(url);
}

function caritahun_ibadah() { 
  let tahun = [];
  tahun[0] = document.getElementById("ibadah_awaltahun").value;
  tahun[1] = document.getElementById("ibadah_akhirtahun").value;
  let url = `${server}/ibadah_cari_tahun/${tahun}`;
  datamesjid(url);
}

function carijorong_ibadah() { 
  let jorong = document.getElementById("jorong_ibadah").value;
  console.log("cari b ibadah dengan jorong: " + jorong);
  $.ajax({
    url: 'act/ibadah_cari-jorong.php?j=' + jorong,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_ibadah(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function klikInfoWindowibadah(id) {
  google.maps.event.addListener(marker, "click", function () {
    console.log("marker dengan id=" + id + " diklik");
    detailibadah_infow(id);
  });

}

function detailibadah_infow(id) { //menampilkan informas
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id=" + id);
    $.ajax({
    url: 'act/ibadah_detail.php?cari=' + id,
    data: "",
    dataType: 'json',
    success: function (rows) {
      for (let i in rows) {
        let row = rows[i];
        let id = row.id;
        let nama = row.name;
        let image = row.image;
        if (image==null) {
          image = "There are no photos for this building";
        }
        else {
          image = "<img src='foto/b-ibadah/"+row.image+"' alt='building photo' width='165'>";
        }
        let latitude = row.latitude;
        let longitude = row.longitude;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon: 'assets/ico/musajik.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18);
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br>"+image+"<p><i class='fas fa-mosque'></i><b> "+ nama + "</b><br><a role='button' class='btn btn-default fa fa-car' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'> Show Route</a>&nbsp<a role='button' class='btn btn-default fa fa-info-circle' id='detail-bang' onclick='detailibadah("+'"'+id+'"'+")'> View Details</a></center></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow);
        hapusInfo();
        infowindow.open(map);
        klikInfoWindowibadah(id);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}


function aktifkanRadiusibadah() { //fungsi radius
  if (pos == 'null') {
    $('#atur-posisi').modal('show');
  } else {
    hapusRadius();
    clearroute2();
    let inputradiusibadah = document.getElementById("inputradiusibadah").value;
    let circle = new google.maps.Circle({
      center: pos,
      radius: parseFloat(inputradiusibadah * 100),
      map: map,
      strokeColor: "blue",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "blue",
      fillOpacity: 0.35
    });
    map.setZoom(15);
    map.setCenter(pos);
    circles.push(circle);
    teksradiusibadah()
  }
  cekRadiusStatus = 'on';
  tampilkanradiusibadah();
}

function teksradiusibadah() {
  document.getElementById('m_ibadah').innerHTML = document.getElementById('inputradiusibadah').value * 100
}

function cekRadiusibadah() {
  radiusibadah = inputradiusibadah.value * 100;
  lat = document.getElementById("lat").value;
  lng = document.getElementById("lng").value;
}

function tampilkanradiusibadah() { //menampilkan bang ibadah berdasarkan radius
  $('#hasilcari1').show();
  $('#hasilcari').empty();
  $('#found').empty();
  hapusInfo();
  hapusMarkerTerdekat();
  cekRadiusibadah();
  clearroute2();
  console.log("panggil radiusnyaa, b.ibadah sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiusibadah);

  $.ajax({
    url: 'act/ibadah_radius.php?lat=' + pos.lat + '&lng=' + pos.lng + '&rad=' + radiusibadah,
    data: "",
    dataType: 'json',
    success: function (rows) {
      if (rows != null ){
        let a = 0;
        for (let i in rows) {
          let row = rows[i];
          let id = row.id;
          let nama = row.name;
          let latitude = row.latitude;
          let longitude = row.longitude;
          centerBaru = new google.maps.LatLng(latitude, longitude);
          marker = new google.maps.Marker({
            position: centerBaru,
            icon: 'assets/ico/musajik.png',
            map: map,
            animation: google.maps.Animation.DROP,
          });
          markersDua.push(marker);
          map.setCenter(centerBaru);
          klikInfoWindowibadah(id);
          map.setZoom(15);
          tampilkanhasilcari();
          $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailibadah_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
          a = a + 1;
        }
        $('#found').append("Found: " + a)
        $('#hidecari').show();
      }
      else {
        $('#hasilcari').append('<td colspan="2">no result</td>');
      }
    }
  });
}

function carifasilitas_ibadah(){

  $('#hasilcari1').show();
  $('#hasilcari').empty();
  hapusInfo();
  clearroute2();
  hapusRadius();
  hapusMarkerTerdekat();
  let arrayFas=[];
  for(i=0; i<$("input[name=fas_ibadah]:checked").length;i++){
    arrayFas.push($("input[name=fas_ibadah]:checked")[i].value);
  }
  if (arrayFas==''){
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('Choose Facility !');
  }else{
    $.ajax({ url: server+'act/ibadah_cari-fasilitas.php?fas='+arrayFas, data: "", dataType: 'json', success: function(rows){
      console.log(server+'act/ibadah_cari-fasilitas.php?fas='+arrayFas);
      $('#found').empty();
      $('#hasilcari').empty();
      if(rows==null)
            {
              $('#kosong').modal('show');
              $('#hasilcari').append('<td colspan="2">no result</td>');
            }
      else {
        let a = 0;
        for (let i in rows) 
            {   
              let row     = rows[i];
              let id   = row.id;
              let nama   = row.name;
              let latitude  = row.latitude ;
              let longitude = row.longitude ;
              centerBaru = new google.maps.LatLng(latitude, longitude);
              marker = new google.maps.Marker
            ({
              position: centerBaru,
              icon:'assets/ico/musajik.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
              markersDua.push(marker);
              map.setCenter(centerBaru);
              klikInfoWindowibadah(id)
              map.setZoom(15);
              tampilkanhasilcari();
              $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailibadah_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
              a = a + 1;
          }
          $('#found').append("Found: " + a)
          $('#hidecari').show();
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
  }
}