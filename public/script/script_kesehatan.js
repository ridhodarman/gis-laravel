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
      let id = row.health_building_id;
      let name = row.name_of_health_building;
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
  $.ajax({
    url: 'kesehatan_semua',
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
}

function carinamakesehatan() { 
  let namakesehatan = document.getElementById("namakesehatan").value;
  let url = `kesehatan_cari_nama/${namakesehatan}`  
  datakesehatan(url);
}

function carijenis_kesehatan() { 
  let jenis = document.getElementById("jeniskesehatan").value;
  let url = `kesehatan_cari_jenis/${jenis}`;
  datakesehatan(url);
}

function carijorong_kesehatan() { 
  let jorong = document.getElementById("jorong_kesehatan").value;
  let url = `kesehatan_cari_jorong/${jorong}`;
  datakesehatan(url);
}

function cariRadius_kesehatan() { //menampilkan bang kesehatan berdasarkan radius
  if (pos == 'null') {
    $('#atur-posisi').modal('show');
  }
  else {
    radiusStatus = true;
    $('#hasilcari1').show();
    let inputradiuskesehatan = document.getElementById("inputradiuskesehatan").value;
    let radiuskesehatan = inputradiuskesehatan * 100;
    let lat = document.getElementById("lat").value;
    let lng = document.getElementById("lng").value;
    console.log("panggil radiusnyaa, b.kesehatan sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiuskesehatan);
    let rad = [];
    rad[0] = pos.lat;
    rad[1] = pos.lng;
    rad[2] = radiuskesehatan;
    let url = `kesehatan_cari_radius/${rad}`;
    
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
  console.log(`kesehatan_info/${id}`)
    $.ajax({
    url: `kesehatan_info/${id}`,
    data: "",
    dataType: 'json',
    success: function (rows) {
      for (let i in rows) {
        let row = rows[i];
        let id = row.health_building_id;
        let nama = row.name_of_health_building;
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
          content: "<span style=color:black><center><b>Information</b><br>"+image+"<p><i class='fas fa-hospital-alt'></i><b> "+ nama + "</b><br><a role='button' class='btn btn-default fa fa-car' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'> Show Route</a>&nbsp<a role='button' class='btn btn-default fa fa-info-circle' onclick='detailkesehatan("+'"'+id+'"'+")'> View Details</a></center></span>",
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

  $('#hasilcari1').show();
  $('#hasilcari').empty();
  hapusInfo();
  clearroute2();
  hapusRadius();
  hapusMarkerTerdekat();
  let arrayFas=[];
  for(i=0; i<$("input[name=fas_kesehatan]:checked").length;i++){
    arrayFas.push($("input[name=fas_kesehatan]:checked")[i].value);
  }
  if (arrayFas==''){
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('Choose Facility !');
  }else{
    $.ajax({ url: server+'act/kesehatan_cari-fasilitas.php?fas='+arrayFas, data: "", dataType: 'json', success: function(rows){
      console.log(server+'act/kesehatan_cari-fasilitas.php?fas='+arrayFas);
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
              icon:'assets/ico/kesehatan.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
              markersDua.push(marker);
              map.setCenter(centerBaru);
              klikInfoWindowkesehatan(id)
              map.setZoom(15);
              tampilkanhasilcari();
              $('#hasilcari').append("<tr><td>" + nama + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailkesehatan_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
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