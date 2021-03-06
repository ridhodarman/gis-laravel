function datakesehatan(url){
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
      cari_kesehatan(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function cari_kesehatan(rows) {
  if (rows.length == 0) {
    $('#kosong').modal('show');
    $('#hasilcari').append('<td colspan="2">no result</td>');
  }
  else {
    let a = 0;
    for (let i in rows) {
      let row = rows[i];
      let id = row.health_service_building_id;
      let name = row.name_of_health_service_building;
      let latitude = row.latitude;
      let longitude = row.longitude;
      centerBaru = new google.maps.LatLng(latitude, longitude);
      marker = new google.maps.Marker({
        position: centerBaru,
        icon: 'assets/ico/kesehatan.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindowkesehatan(id);
      map.setZoom(15);
      tampilkanhasilcari();
      $('#hasilcari').append("<tr><td>" + name + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailkesehatan_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
      a = a + 1;
    }
    $('#found').append("Found: " + a)
    $('#hidecari').show();
  }
}

function tampilsemuakesehatan() {
  let url = 'kesehatan/semua'
  datakesehatan(url);
}

function carinamakesehatan() { 
  let namakesehatan = document.getElementById("namakesehatan").value;
  let url = `kesehatan/nama/${namakesehatan}`  
  datakesehatan(url);
}

function carijenis_kesehatan() { 
  let jenis = document.getElementById("jeniskesehatan").value;
  let url = `kesehatan/jenis/${jenis}`;
  datakesehatan(url);
}

function carijorong_kesehatan() { 
  let jorong = document.getElementById("jorong_kesehatan").value;
  let url = `kesehatan/jorong/${jorong}`;
  datakesehatan(url);
}

function cariRadius_kesehatan() { //menampilkan bang kesehatan berdasarkan radius
  if (pos == 'null') {
    $('#atur-posisi').modal('show');
    document.getElementById("inputradiuskesehatan").value=0;
  }
  else {
    radiusStatus = true;
    $('#hasilcari1').show();
    let inputradiuskesehatan = document.getElementById("inputradiuskesehatan").value;
    let radiuskesehatan = inputradiuskesehatan * 100;
    let lat = document.getElementById("lat").value;
    let lng = document.getElementById("lng").value;
    console.log("panggil radiusnyaa, b.kesehatan sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiuskesehatan);
    let url = `kesehatan/radius/${lat}/${lng}/${radiuskesehatan}`;
    
    $.ajax({
      url: url,
      data: "",
      dataType: 'json',
      success: function (rows) {
        cari_kesehatan(rows);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $('#gagal').modal('show');
        $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
        $('#notifikasi').append(thrownError);
      }
    });

    document.getElementById('m_kesehatan').innerHTML = radiuskesehatan;
    hapusInfo();
    hapusRadius();
    clearroute2();
    hapusMarkerTerdekat();
    $('#hasilcari').empty();
    $('#found').empty();
    
    let circle = new google.maps.Circle({
      center: pos,
      radius: parseFloat(inputradiuskesehatan * 100),
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

function klikInfoWindowkesehatan(id) {
  google.maps.event.addListener(marker, "click", function () {
    console.log("marker dengan id=" + id + " diklik");
    detailkesehatan_infow(id);
  });

}

function detailkesehatan_infow(id) { //menampilkan informas
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id=" + id);
  console.log(`kesehatan/info/${id}`)
    $.ajax({
    url: `kesehatan/info/${id}`,
    data: "",
    dataType: 'json',
    success: function (rows) {
      for (let i in rows) {
        let row = rows[i];
        let id = row.health_service_building_id;
        let nama = row.name_of_health_service_building;
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
          icon: 'assets/ico/kesehatan.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18);
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br>"+image+"<p><i class='fas fa-hospital-alt'></i><b> "+ nama + "</b><br><button class='btn btn-default' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'><i class='fa fa-car'></i> Show Route</button>&nbsp;<button class='btn btn-default' onclick='detailkesehatan("+'"'+id+'"'+")'><i class='fa fa-info-circle'></i> View Details</button></center></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow);
        hapusInfo();
        infowindow.open(map);
        klikInfoWindowkesehatan(id);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function carifasilitas_kesehatan(){
  let arrayFas=[];
  for(i=0; i<$("input[name=fas_kesehatan]:checked").length;i++){
    arrayFas.push($("input[name=fas_kesehatan]:checked")[i].value);
  }
  if (arrayFas==''){
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('Choose Facility !');
  }else{
    //console.log(`umkm/fasilitas=${arrayFas}`);
    let url = `kesehatan/fasilitas/${arrayFas}`;
    datakesehatan(url);
    $('#fas-kesehatan').modal('hide');
  }
}