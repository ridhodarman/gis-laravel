function dataumkm(url){
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
      cari_umkm(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function tampilsemuaumkm() { //menampilkan semua umkm
  let url = "umkm/semua"
  dataumkm(url);
}

function cari_umkm(rows) {
  if (rows.length == 0) {
    $('#kosong').modal('show');
    $('#hasilcari').append('<td colspan="2">no result</td>');
  }
  else {
    let a = 0;
    for (let i in rows) {
      let row = rows[i];
      let id = row.msme_building_id;
      let name = row.name_of_msme_building;
      let latitude = row.latitude;
      let longitude = row.longitude;
      centerBaru = new google.maps.LatLng(latitude, longitude);
      marker = new google.maps.Marker({
        position: centerBaru,
        icon: 'assets/ico/kadai.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindowumkm(id);
      map.setZoom(14);
      tampilkanhasilcari();
      $('#hasilcari').append("<tr><td>" + name + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailumkm_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
      a = a + 1;
    }
    $('#found').append("Found: " + a)
    $('#hidecari').show();
  }
}

function carinamaumkm() { //menampilkan umkm berdasarkan nama
  let namaumkm = document.getElementById("namaumkm").value;
  let url = `umkm/nama/${namaumkm}`;
  dataumkm(url);
}

function carijenis_umkm() { 
  let jenis = document.getElementById("jenisumkm").value;
  let url = `umkm/jenis/${jenis}`;
  dataumkm(url);
}

function carifasilitas_umkm(){
  let arrayFas=[];
  for(i=0; i<$("input[name=fas_umkm]:checked").length;i++){
    arrayFas.push($("input[name=fas_umkm]:checked")[i].value);
  }
  if (arrayFas==''){
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('Choose Facility !');
  }else{
    console.log(`umkm/fasilitas=${arrayFas}`);
    let url = `umkm/fasilitas/${arrayFas}`;
    dataumkm(url);
  }
}

function carijorong_umkm() { 
  let jorong = document.getElementById("jorong_umkm").value;
  let url = `umkm_cari_jorong/${jorong}`;
  dataumkm(url);
}

function klikInfoWindowumkm(id) {
  google.maps.event.addListener(marker, "click", function () {
    console.log("marker dengan id=" + id + " diklik");
    detailumkm_infow(id);
  });
}

function detailumkm_infow(id) { //menampilkan informas
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id=" + id);
    $.ajax({
    url: `umkm/info/${id}`,
    data: "",
    dataType: 'json',
    success: function (rows) {
      for (let i in rows) {
        let row = rows[i];
        let id = row.msme_building_id;
        let nama = row.name_of_msme_building;
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
          icon: 'assets/ico/kadai.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18);
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: `<div style="text-align: center; color: black; padding-bottom: 2px">
                        Information
                        <div>${image}</div>
                        <div style="padding-top: 2px;"><i class="fas fa-store-alt"></i> ${nama}</div>
                        <div style="padding-left: 2px; padding-right: 2px; padding-bottom: 2px">
                          <button class="btn btn-sm btn-default" onclick="callRoute(centerLokasi, centerBaru);rutetampil();">
                              <i class="fa fa-car"></i> Show Route</button> 
                          <button class="btn btn-sm btn-default" onclick="detailumkm('${id}')">
                              <i class="fa fa-info-circle"></i> View Details</button>
                        </div>
                      </div>
                    `,
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow);
        hapusInfo();
        infowindow.open(map);
        klikInfoWindowumkm(id);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function cariRadius_umkm() { //menampilkan bang umkm berdasarkan radius
  if (pos == 'null') {
    $('#atur-posisi').modal('show');
  }
  else {
    radiusStatus = true;
    $('#hasilcari1').show();
    let inputradiusumkm = document.getElementById("inputradiusumkm").value;
    let radiusumkm = inputradiusumkm * 100;
    let lat = document.getElementById("lat").value;
    let lng = document.getElementById("lng").value;
    console.log("panggil radiusnyaa, b.umkm sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiusumkm);
    let rad = [];
    rad[0] = pos.lat;
    rad[1] = pos.lng;
    rad[2] = radiusumkm;
    let url = `umkm/radius/${lat}/${lng}/${radiusumkm}`;
    
    $.ajax({
      url: url,
      data: "",
      dataType: 'json',
      success: function (rows) {
        cari_umkm(rows);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $('#gagal').modal('show');
        $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
        $('#notifikasi').append(thrownError);
      }
    });

    document.getElementById('km_umkm').innerHTML = radiusumkm;
    hapusInfo();
    hapusRadius();
    clearroute2();
    hapusMarkerTerdekat();
    $('#hasilcari').empty();
    $('#found').empty();
    
    let circle = new google.maps.Circle({
      center: pos,
      radius: parseFloat(inputradiusumkm * 100),
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

function cari_pendumkm() { 
  let awal = document.getElementById("penghasilan-umkm1").value;
  let akhir = document.getElementById("penghasilan-umkm2").value;
  console.log("cari pendapatan umkm dari: " + awal + " - " +akhir);
  $.ajax({
    url: 'act/umkm_cari-pendapatan.php?awal=' + awal + '&akhir=' + akhir,
    data: "",
    dataType: 'json',
    success: function (rows) {
      cari_umkm(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}