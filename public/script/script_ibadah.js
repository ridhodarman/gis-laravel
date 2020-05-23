function datamesjid(url){
  $.ajax({
    url: url,
    data: "",
    dataType: 'json',
    success: function (rows) {
      hapusInfo();
      hapusRadius();
      clearroute2();
      hapusMarkerTerdekat();
      $('#hasilcari').empty();
      $('#found').empty();
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
  if (rows.length == 0 ) {
    $('#kosong').modal('show');
    $('#hasilcari').append('<td colspan="2">no result</td>');
  }
  else {
    let a = 0;
    for (let i in rows) {
      let row = rows[i];
      let id = row.worship_building_id
      let name = row.name_of_worship_building;
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
  let url = `ibadah_semua`;
  datamesjid(url);
}

function carinamaibadah() { 
  let namaibadah = document.getElementById("namaibadah").value;
  let url = `ibadah_cari_nama/${namaibadah}`;
  datamesjid(url);
}

function carijenis_ibadah() { 
  let jenis = document.getElementById("jenisibadah").value;
  let url = `ibadah_cari_jenis/${jenis}`;
  datamesjid(url);
}

function carikons_ibadah() { 
  let konstruksi = document.getElementById("jeniskons_ibadah").value;
  let url = `ibadah_cari_konstruksi/${konstruksi}`;
  datamesjid(url);
}

function cariluasbang_ibadah() { 
  let luasbang = [];
  luasbang[0] = document.getElementById("ibadah_awalbang").value;
  luasbang[1] = document.getElementById("ibadah_akhirbang").value;
  let url = `ibadah_cari_luasbang/${luasbang}`;
  datamesjid(url);
}

function cariluastanah_ibadah() { 
  let luastanah = [];
  luastanah[0] = document.getElementById("ibadah_awaltanah").value;
  luastanah[1] = document.getElementById("ibadah_akhirtanah").value;
  let url = `ibadah_cari_luastanah/${luastanah}`;
  datamesjid(url);
}

function caritahun_ibadah() { 
  let tahun = [];
  tahun[0] = document.getElementById("ibadah_awaltahun").value;
  tahun[1] = document.getElementById("ibadah_akhirtahun").value;
  let url = `ibadah_cari_tahun/${tahun}`;
  datamesjid(url);
}

function carijorong_ibadah() { 
  let jorong = document.getElementById("jorong_ibadah").value;
  let url = `ibadah_cari_jorong/${jorong}`;
  datamesjid(url);
}

function carifasilitas_ibadah(){
  let arrayFas=[];
  for(i=0; i<$("input[name=fas_ibadah]:checked").length;i++){
    arrayFas.push($("input[name=fas_ibadah]:checked")[i].value);
  }
  if (arrayFas==''){
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('Choose Facility !');
  }else{
    let url = `ibadah_cari_fasilitas/${arrayFas}`;
    datamesjid(url);
  }
}

function cariRadius_ibadah() { //menampilkan bang ibadah berdasarkan radius
  if (pos == 'null') {
    $('#atur-posisi').modal('show');
  }
  else {
    radiusStatus = true;
    $('#hasilcari1').show();
    let inputradiusibadah = document.getElementById("inputradiusibadah").value;
    let radiusibadah = inputradiusibadah * 100;
    let lat = document.getElementById("lat").value;
    let lng = document.getElementById("lng").value;
    console.log("panggil radiusnyaa, b.ibadah sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiusibadah);
    let rad = [];
    rad[0] = pos.lat;
    rad[1] = pos.lng;
    rad[2] = radiusibadah;
    let url = `ibadah_cari_radius/${rad}`;
    
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

    document.getElementById('m_ibadah').innerHTML = radiusibadah;
    hapusInfo();
    hapusRadius();
    clearroute2();
    hapusMarkerTerdekat();
    $('#hasilcari').empty();
    $('#found').empty();
    
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
      
  }
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
    url: `ibadah_info/${id}`,
    data: "",
    dataType: 'json',
    success: function (rows) {
      for (let i in rows) {
        let row = rows[i];
        let id = row.worship_building_id;
        let nama = row.name_of_worship_building;
        let image = row.photo_url;
        if (image==null) {
          image = "There are no photos for this building";
        }
        else {
          image = `<img src='/foto/bangunan/${row.photo_url}' alt='building photo' width='165'>`;
        }
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
          content: "<span style=color:black><center><b>Information</b><br>"+image+"<p><i class='fas fa-mosque'></i><b> "+ nama + "</b><br><button class='btn btn-default' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'><i class='fa fa-car'></i> Show Route</button>&nbsp<button class='btn btn-default' id='detail-bang' onclick='detailibadah("+'"'+id+'"'+")'><i class='fa fa-info-circle'></i> View Details<button></center></span>",
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