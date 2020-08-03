function datakantor(url) {
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
      cari_kantor(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function cari_kantor(rows) {
  if (rows.length == 0) {
    $('#kosong').modal('show');
    $('#hasilcari').append('<td colspan="2">no result</td>');
  }
  else {
    let a = 0;
    for (let i in rows) {
      let row = rows[i];
      let id = row.office_building_id;
      let name = row.name_of_office_building;
      let latitude = row.latitude;
      let longitude = row.longitude;
      centerBaru = new google.maps.LatLng(latitude, longitude);
      marker = new google.maps.Marker({
        position: centerBaru,
        icon: 'assets/ico/kantor.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindowkantor(id);
      map.setZoom(15);
      tampilkanhasilcari();
      $('#hasilcari').append("<tr><td>" + name + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailkantor_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
      a = a + 1;
    }
    $('#found').append("Found: " + a)
    $('#hidecari').show();
  }
}

function tampilsemuakantor() {
  let url = 'kantor/semua';
  datakantor(url)
}

function carinamakantor() { 
  let namakantor = document.getElementById("namakantor").value;
  let url = `kantor/nama/${namakantor}`;
  datakantor(url);
}

function carijenis_kantor() { 
  let jenis = document.getElementById("jeniskantor").value;
  let url = `kantor/jenis/${jenis}`;
  datakantor(url);
}

function caritahun_kantor() { 
  let tahun = [];
  tahun[0] = document.getElementById("kantor_awaltahun").value;
  tahun[1] = document.getElementById("kantor_akhirtahun").value;
  let url = `kantor/tahun/${tahun}`;
  datakantor(url);
}

function klikInfoWindowkantor(id) {
  google.maps.event.addListener(marker, "click", function () {
    console.log("marker dengan id=" + id + " diklik");
    detailkantor_infow(id);
  });

}

function detailkantor_infow(id) { //menampilkan informas
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id=" + id);
    $.ajax({
    url: `kantor/info/${id}`,
    data: "",
    dataType: 'json',
    success: function (rows) {
      for (let i in rows) {
        let row = rows[i];
        let id = row.office_building_id;
        let nama = row.name_of_office_building;
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
          icon: 'assets/ico/kantor.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18);
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br>"+image+"<p><i class='fa fa-university'></i><b> "+ nama + "</b><br><button class='btn btn-default' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'><i class='fa fa-car'></i> Show Route</button>&nbsp;<button class='btn btn-default' onclick='detailkantor("+'"'+id+'"'+")'><i class='fa fa-info-circle'></i> View Details</button></center></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow);
        hapusInfo();
        infowindow.open(map);
        klikInfoWindowkantor(id);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

// function carifasilitas_kantor(){
//   let arrayFas=[];
//   for(i=0; i<$("input[name=fas_kantor]:checked").length;i++){
//     arrayFas.push($("input[name=fas_kantor]:checked")[i].value);
//   }
//   if (arrayFas==''){
//     $('#ket-p').empty();
//     $('#peringatan').modal('show');
//     $('#ket-p').append('Choose Facility !');
//   }else{
//     let url = `kantor/fasilitas/${arrayFas}`;
//     datakantor(url);
//   }
// }

// function cariRadius_kantor() { //menampilkan bang kantor berdasarkan radius
//   if (pos == 'null') {
//     $('#atur-posisi').modal('show');
//   }
//   else {
//     radiusStatus = true;
//     $('#hasilcari1').show();
//     let inputradiuskantor = document.getElementById("inputradiuskantor").value;
//     let radiuskantor = inputradiuskantor * 100;
//     let lat = document.getElementById("lat").value;
//     let lng = document.getElementById("lng").value;
//     console.log("panggil radiusnyaa, b.kantor sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiuskantor);
//     let rad = [];
//     rad[0] = pos.lat;
//     rad[1] = pos.lng;
//     rad[2] = radiuskantor;
//     let url = `kantor/radius/${rad}`;
    
//     $.ajax({
//       url: url,
//       data: "",
//       dataType: 'json',
//       success: function (rows) {
//         cari_kantor(rows);
//       },
//       error: function (xhr, ajaxOptions, thrownError) {
//         $('#gagal').modal('show');
//         $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
//         $('#notifikasi').append(thrownError);
//       }
//     });

//     document.getElementById('m_kantor').innerHTML = radiuskantor;
//     hapusInfo();
//     hapusRadius();
//     clearroute2();
//     hapusMarkerTerdekat();
//     $('#hasilcari').empty();
//     $('#found').empty();
    
//     let circle = new google.maps.Circle({
//       center: pos,
//       radius: parseFloat(inputradiuskantor * 100),
//       map: map,
//       strokeColor: "blue",
//       strokeOpacity: 0.8,
//       strokeWeight: 2,
//       fillColor: "blue",
//       fillOpacity: 0.35
//     });
//     map.setZoom(15);
//     map.setCenter(pos);
//     circles.push(circle); 
      
//   }
// }