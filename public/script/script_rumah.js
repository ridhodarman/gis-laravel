function datarumah(url) {
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
      cari_rumah(rows);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      $('#gagal').modal('show');
      $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
      $('#notifikasi').append(thrownError);
    }
  });
}

function cari_rumah(rows)
{   
  //alert(rows.length)
  if(rows.length==0)
    {
      //alert("kosong")
      $('#kosong').modal('show');
      }
  let a=0;
  $('#found').empty();
  for (let i in rows) 
      {   
        let row     = rows[i];
        let id   = row.house_building_id;
        let result   = row.result;
        let latitude  = row.latitude ;
        let longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(latitude, longitude);
        marker = new google.maps.Marker
            ({
              position: centerBaru,
              icon:'assets/ico/home.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
            markersDua.push(marker);
            map.setCenter(centerBaru);
            klikInfoWindow(id);
            map.setZoom(14);            
            tampilkanhasilcari();
            $('#hasilcari').append("<tr><td>"+result+"</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailrumah_infow(\""+id+"\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>");
            
            a=a+1;
      }
      $('#found').append("Found: "+a)
      $('#hidecari').show();
  }

function cari_idrumah() { 
  let idrumah = document.getElementById("id-rumah").value;
  if (idrumah==null || idrumah=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter survey ID !');
  }
  else {
    let url = `rumah/id/${idrumah}`;
    datarumah(url);
  }
}

function cari_pemilik() { 
  let pemilik = document.getElementById("pemilik").value;
  if (pemilik==null || pemilik=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter owner name !');
  }
  else {
    let url = `rumah/namapemilik/${pemilik}`;
    datarumah(url);
  }
}

function cari_nikpemilik() { 
  let nikpemilik = document.getElementById("nikpemilik").value;
  if (nikpemilik==null || nikpemilik=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter National ID Number of owner !');
  }
  else {
    let url = `rumah/nikpemilik/${nikpemilik}`;
    datarumah(url);
  }
}

function cari_penghuni() { 
  let penghuni = document.getElementById("penghuni").value;
  if (penghuni==null || penghuni=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter householder name !');
  }
  else {
    let url = `rumah/namapenghuni/${penghuni}`;
    datarumah(url);
  }
}

function cari_nikpenghuni() { 
  let nikpenghuni = document.getElementById("nikpenghuni").value;
  if (nikpenghuni==null || nikpenghuni=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter National ID Number of householder !');
  }
  else {
    let url = `rumah/nikpenghuni/${nikpenghuni}`;
    datarumah(url);
  }
}

function cari_kk() { 
  let kk = document.getElementById("kk").value;
  if (kk==null || kk=="") {
    $('#ket-p').empty();
    $('#peringatan').modal('show');
    $('#ket-p').append('enter family card number !');
  }
  else {
    let url = `rumah/kkpenghuni/${kk}`;
    datarumah(url);
  }
}

function cari_suku() { 
  let suku = document.getElementById("suku").value;
  let url = `rumah/sukupemilik/${suku}`;
  datarumah(url);
}

function carikons_rumah() { 
  let jenis_k = document.getElementById("jeniskons_rumah").value;
  let url = `rumah/konstruksi/${jenis_k}`;
  datarumah(url);
}

function caritahun_rumah() { 
  let tahun = [];
  tahun[0] = document.getElementById("rumah_awaltahun").value;
  tahun[1] = document.getElementById("rumah_akhirtahun").value;
  let url = `rumah/tahun/${tahun}`;
  datarumah(url);
}

function carilistrik_rumah() { 
  let listrik = [];
  listrik[0] = document.getElementById("rumah_awallistrik").value;
  listrik[1] = document.getElementById("rumah_akhirlistrik").value;
  let url = `rumah/listrik/${listrik}`;
  datarumah(url);
}

function rumahkosong(){ 
  let url = `rumah/status/0`;
  datarumah(url);
}

function rumahberpenghuni(){ 
  let url = `rumah/status/1`;
  datarumah(url);
}


function klikInfoWindow(id)
{
    google.maps.event.addListener(marker, "click", function(){
        console.log("marker dengan id="+id+" diklik");
        detailrumah_infow(id);
      });
}


function detailrumah_infow(id){  //menampilkan informasi rumah
  hapusInfo();
  clearroute2();
  console.log("fungsi info marker id="+id);
    $.ajax({
      url: `rumah_info/${id}`,
      data: "", dataType: 'json', success: function(rows)
      {
         for (let i in rows) 
          { 
            let row = rows[i];
            let id = row.house_building_id;
            let image = row.photo_url;
            //let nama = row.name;
            if (image==null) {
              image = "There are no photos for this building";
            }
            else {
              image = `<img src='/foto/bangunan/${row.photo_url}' alt='building photo' width='165'>`;
            }
            let latitude  = row.latitude; 
            let longitude = row.longitude ;
            console.log(image);
            centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
            marker = new google.maps.Marker
            ({
              position: centerBaru,
              icon:'assets/ico/home.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
            markersDua.push(marker);
            map.setCenter(centerBaru);
            klikInfoWindow(id);
            map.setZoom(18); 
            infowindow = new google.maps.InfoWindow({
            position: centerBaru,
            content: `<div style="text-align: center; color: black; padding-bottom: 2px">
                        Information
                        <div>${image}</div>
                        <div style="padding-top: 2px;"><i class="fa fa-home"></i> ${id}</div>
                        <div style="padding-left: 2px; padding-right: 2px; padding-bottom: 2px">
                          <button class="btn btn-sm btn-default" onclick="callRoute(centerLokasi, centerBaru);rutetampil();">
                              <i class="fa fa-car"></i> Show Route</button> 
                          <button class="btn btn-sm btn-default" onclick="detailrumah('${id}')">
                              <i class="fa fa-info-circle"></i> View Details</button>
                        </div>
                      </div>`,
            pixelOffset: new google.maps.Size(0, -33)
            });
            infoDua.push(infowindow); 
            hapusInfo();
            infowindow.open(map);
          }  
        }
      }); 
}

// function cari_datuk() { 
//   let datuk = document.getElementById("datuk").value;
//   console.log("cari rumah id datuk: " + datuk);
//     $.ajax({
//       url: 'act/rumah_cari-datuk.php?datuk=' + datuk,
//       data: "",
//       dataType: 'json',
//       success: function (rows) {
//         cari_rumah(rows);
//       },
//       error: function (xhr, ajaxOptions, thrownError) {
//         $('#gagal').modal('show');
//         $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
//         $('#notifikasi').append(thrownError);
//       }
//     });
// }


// function cari_pendapatan() { 
//   let awal = document.getElementById("penghasilan1").value;
//   let akhir = document.getElementById("penghasilan2").value;
//   console.log("cari pendapatan keluarga dg: " + awal + " - " +akhir);
//   $.ajax({
//     url: 'act/rumah_cari-pendapatan.php?awal=' + awal + '&akhir=' + akhir,
//     data: "",
//     dataType: 'json',
//     success: function (rows) {
//       cari_rumah(rows);
//     },
//     error: function (xhr, ajaxOptions, thrownError) {
//       $('#gagal').modal('show');
//       $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
//       $('#notifikasi').append(thrownError);
//     }
//   });
// }

// function cari_kampung() { 
//   let kampung = document.getElementById("kampung").value;
//     $.ajax({
//       url: 'act/rumah_cari-kampung.php?kampung=' + kampung,
//       data: "",
//       dataType: 'json',
//       success: function (rows) {
//         cari_rumah(rows);
//       },
//       error: function (xhr, ajaxOptions, thrownError) {
//         $('#gagal').modal('show');
//         $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
//         $('#notifikasi').append(thrownError);
//       }
//     });
// }

// function cari_pendkk() { 
//   let pendkk = document.getElementById("pendkk").value;
//     $.ajax({
//       url: 'act/rumah_cari-pendkk.php?pendkk=' + pendkk,
//       data: "",
//       dataType: 'json',
//       success: function (rows) {
//         cari_rumah(rows);
//       },
//       error: function (xhr, ajaxOptions, thrownError) {
//         $('#gagal').modal('show');
//         $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
//         $('#notifikasi').append(thrownError);
//       }
//     });
// }
