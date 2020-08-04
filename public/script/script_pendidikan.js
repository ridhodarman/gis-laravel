function datapendidikan(url){
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
      cari_pendidikan(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function cari_pendidikan(rows) {
  if (rows.length == 0) {
    $('#kosong').modal('show');
    $('#hasilcari').append('<td colspan="2">no result</td>');
  }
  else {
    let a = 0;
    for (let i in rows) {
      let row = rows[i];
      let id = row.educational_building_id;
      let name = row.name_of_educational_building;
      let latitude = row.latitude;
      let longitude = row.longitude;
      centerBaru = new google.maps.LatLng(latitude, longitude);
      marker = new google.maps.Marker({
        position: centerBaru,
        icon: 'assets/ico/sekolah.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindowpendidikan(id);
      map.setZoom(15);
      tampilkanhasilcari();
      $('#hasilcari').append("<tr><td>" + name + "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailpendidikan_infow(\"" + id + "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
      a = a + 1;
    }
    $('#found').append("Found: " + a)
    $('#hidecari').show();
  }
}

function tampilsemuapendidikan() {
  let url = 'pendidikan/semua';
  datapendidikan(url);
}

function carinamapendidikan() { 
  let namapendidikan = document.getElementById("namapendidikan").value;
  let url = `pendidikan/nama/${namapendidikan}`
  datapendidikan(url);
}

function caritingkat_pendidikan() { 
  let tingkat = document.getElementById("tingkatpendidikan").value;
  let url = `pendidikan/tingkat/${tingkat}`;
  datapendidikan(url);
}

function carijenis_pendidikan() { 
  let jenis = document.getElementById("jenispendidikan").value;
  let url = `pendidikan/jenis/${jenis}`;
  datapendidikan(url);
}

function carijorong_pendidikan() { 
  let jorong = document.getElementById("jorong_pendidikan").value;
  let url = `pendidikan/jorong/${jorong}`;
  datapendidikan(url);
}

// function cariRadius_pendidikan() { //menampilkan bang pendidikan berdasarkan radius
//   if (pos == 'null') {
//     $('#atur-posisi').modal('show');
//   }
//   else {
//     radiusStatus = true;
//     $('#hasilcari1').show();
//     let inputradiuspendidikan = document.getElementById("inputradiuspendidikan").value;
//     let radiuspendidikan = inputradiuspendidikan * 100;
//     let lat = document.getElementById("lat").value;
//     let lng = document.getElementById("lng").value;
//     console.log("panggil radiusnyaa, b.pendidikan sekitar dengan koordinat:" + lat + "," + lng + " dan radius=" + radiuspendidikan);
//     let rad = [];
//     rad[0] = pos.lat;
//     rad[1] = pos.lng;
//     rad[2] = radiuspendidikan;
//     let url = `pendidikan/radius/${rad}`;
    
//     $.ajax({
//       url: url,
//       data: "",
//       dataType: 'json',
//       success: function (rows) {
//         cari_pendidikan(rows);
//       },
//       error: function (xhr, ajaxOptions, thrownError) {
//         $('#gagal').modal('show');
//         $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
//         $('#notifikasi').append(thrownError);
//       }
//     });

//     document.getElementById('m_pendidikan').innerHTML = radiuspendidikan;
//     hapusInfo();
//     hapusRadius();
//     clearroute2();
//     hapusMarkerTerdekat();
//     $('#hasilcari').empty();
//     $('#found').empty();
    
//     let circle = new google.maps.Circle({
//       center: pos,
//       radius: parseFloat(inputradiuspendidikan * 100),
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

function klikInfoWindowpendidikan(id) {
  google.maps.event.addListener(marker, "click", function () {
    console.log("marker dengan id=" + id + " diklik");
    detailpendidikan_infow(id);
  });

}

function detailpendidikan_infow(id) { //menampilkan informas
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id=" + id);
    $.ajax({
    url: `pendidikan/info/${id}`,
    data: "",
    dataType: 'json',
    success: function (rows) {
      for (let i in rows) {
        let row = rows[i];
        let id = row.educational_building_id;
        let nama = row.name_of_educational_building;
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
          icon: 'assets/ico/sekolah.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18);
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br>"+image+"<p><i class='fas fa-school'></i><b> "+ nama + "</b><br><button class='btn btn-default' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'><i class='fa fa-car'></i> Show Route</button>&nbsp;<button class='btn btn-default' onclick='detailpendidikan("+'"'+id+'"'+")'><i class='fa fa-info-circle'></i> View Details</button></center></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow);
        hapusInfo();
        infowindow.open(map);
        klikInfoWindowpendidikan(id);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

// function carifasilitas_pendidikan()
// {
//   let arrayFas=[];
//   for(i=0; i<$("input[name=fas_pendidikan]:checked").length;i++){
//     arrayFas.push($("input[name=fas_pendidikan]:checked")[i].value);
//   }
//   if (arrayFas==''){
//     $('#ket-p').empty();
//     $('#peringatan').modal('show');
//     $('#ket-p').append('Choose Facility !');
//   }else{
//     let url = `pendidikan/fasilitas/${arrayFas}`;
//     datapendidikan(url);
//   }
// }