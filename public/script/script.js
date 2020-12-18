function refresh() {
    hapusposisi();
    hapusRadius();
    sembunyikancari();
    initMap();
    tampillegenda = false;
    $("#legenda").empty();
    $("#legenda").append(
        '<button class="btn btn-default" title="show legend" onclick="legenda()"><i class="fa fa-globe"></i></button>'
    );
}

function tampilkanhasilcari() {
    $("#found").empty();
    $("#peta").addClass("col-md-9");
    $("#tampilanpencarian").show();
    $("#detail-informasi-pencarian").show();
    document.getElementById("panjangtabel").style.height = "76vh";
}

function sembunyikancari() {
    $("#peta").removeClass("col-md-9");
    // $('#tampilanpencarian').hide();
    // $('#found').empty();
    // $('#hidecari').hide();
    // $('#rute').hide();
    $("#detail-informasi-pencarian").hide();
}

function rutetampil() {
    $("#rute").show();
}

function tutuprute() {
    $("#tutuprute").remove();
    clearroute2();
}

function kosongkanhasilrute(){
    $("#detailrute").remove();
    $("#rute").empty();
    $("#rute").hide();
}

function carimodel() {
    a = 0;
    hapusInfo();
    hapusRadius();
    clearroute2();
    hapusMarkerTerdekat();
    $("#hasilcari").empty();
    var model = document.getElementById("model").value;
    console.log("cari model bangunan: " + model);
    tampilkanhasilcari();
    if (document.getElementById("model_ibadah").checked == 1) {
        $.ajax({
            url: `ibadah/model/${model}`,
            data: "",
            dataType: "json",
            success: function(rows) {
                model_ibadah(rows);
                var ibadah = rows.length;
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#gagal").modal("show");
                $("#notifikasi").empty();
                $("#notifikasi").append(xhr.status);
                $("#notifikasi").append(thrownError);
            }
        });
    }

    if (document.getElementById("model_rumah").checked == 1) {
        $.ajax({
            url: `rumah/model/${model}`,
            data: "",
            dataType: "json",
            success: function(rows) {
                model_rumah(rows);
                var rumah = rows.length;
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#gagal").modal("show");
                $("#notifikasi").empty();
                $("#notifikasi").append(xhr.status);
                $("#notifikasi").append(thrownError);
            }
        });
    }

    if (document.getElementById("model_kantor").checked == 1) {
        $.ajax({
            url: `kantor/model/${model}`,
            data: "",
            dataType: "json",
            success: function(rows) {
                model_kantor(rows);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#gagal").modal("show");
                $("#notifikasi").empty();
                $("#notifikasi").append(xhr.status);
                $("#notifikasi").append(thrownError);
            }
        });
    }

    if (document.getElementById("model_pendk").checked == 1) {
        $.ajax({
            url: `pendidikan/model/${model}`,
            data: "",
            dataType: "json",
            success: function(rows) {
                model_pendidikan(rows);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#gagal").modal("show");
                $("#notifikasi").empty();
                $("#notifikasi").append(xhr.status);
                $("#notifikasi").append(thrownError);
            }
        });
    }

    if (document.getElementById("model_kes").checked == 1) {
        $.ajax({
            url: `kesehatan/model/${model}`,
            data: "",
            dataType: "json",
            success: function(rows) {
                model_kesehatan(rows);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#gagal").modal("show");
                $("#notifikasi").empty();
                $("#notifikasi").append(xhr.status);
                $("#notifikasi").append(thrownError);
            }
        });
    }

    if (document.getElementById("model_umkm").checked == 1) {
        $.ajax({
            url: `umkm/model/${model}`,
            data: "",
            dataType: "json",
            success: function(rows) {
                model_umkm(rows);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#gagal").modal("show");
                $("#notifikasi").empty();
                $("#notifikasi").append(xhr.status);
                $("#notifikasi").append(thrownError);
            }
        });
    }
    //alert(a)
}

function model_ibadah(rows) {
    if (rows.length == 0) {
        $("#hasilcari").append(
            "<tr><td colspan='2'>No worship building data</td></tr>"
        );
    } else {
        for (var i in rows) {
            var row = rows[i];
            var name = `<i class='fas fa-mosque'></i> ${row.name}`;
            let icon = "assets/ico/musajik.png";
            let info =
                "<tr><td>" +
                name +
                "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailibadah_infow(\"" +
                row.id +
                "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>";
            data_model(row.id, name, row.latitude, row.longitude, icon, info);
        }
    }
}

function model_rumah(rows) {
    if (rows.length == 0) {
        $("#hasilcari").append("<tr><td colspan='2'>No house data</td></tr>");
    } else {
        for (var i in rows) {
            var row = rows[i];
            var name = `<i class='ti-home'></i> ${row.name}`;
            let icon = "assets/ico/home.png";
            let info =
                "<tr><td>" +
                name +
                "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailrumah_infow(\"" +
                row.id +
                "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>";
            data_model(row.id, name, row.latitude, row.longitude, icon, info);
            klikInfoWindow(row.id);
        }
    }
}

function model_kantor(rows) {
    if (rows.length == 0) {
        $("#hasilcari").append(
            "<tr><td colspan='2'>No office building data</td></tr>"
        );
    } else {
        for (var i in rows) {
            var row = rows[i];
            var name = `<i class='fa fa-university'></i> ${row.name}`;
            let icon = "assets/ico/kantor.png";
            let info =
                "<tr><td>" +
                name +
                "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailkantor_infow(\"" +
                row.id +
                "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>";
            data_model(row.id, name, row.latitude, row.longitude, icon, info);
            klikInfoWindowkantor(row.id);
        }
    }
}

function model_pendidikan(rows) {
    if (rows.length == 0) {
        $("#hasilcari").append(
            "<tr><td colspan='2'>No educational building data</td></tr>"
        );
    } else {
        for (var i in rows) {
            var row = rows[i];
            var name = `<i class='fas fa-school'></i> ${row.name}`;
            let icon = "assets/ico/sekolah.png";
            let info =
                "<tr><td>" +
                name +
                "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailpendidikan_infow(\"" +
                row.id +
                "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>";
            data_model(row.id, name, row.latitude, row.longitude, icon, info);
            klikInfoWindowpendidikan(row.id);
        }
    }
}

function model_kesehatan(rows) {
    if (rows.length == 0) {
        $("#hasilcari").append(
            "<tr><td colspan='2'>No health building data</td></tr>"
        );
    } else {
        for (var i in rows) {
            var row = rows[i];
            var name = `<i class='fas fa-hospital-alt'></i> ${row.name}`;
            let icon = "assets/ico/kesehatan.png";
            let info =
                "<tr><td>" +
                name +
                "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailkesehatan_infow(\"" +
                row.id +
                "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>";
            data_model(row.id, name, row.latitude, row.longitude, icon, info);
            klikInfoWindowkesehatan(row.id);
        }
    }
}

function model_umkm(rows) {
    if (rows.length == 0) {
        $("#hasilcari").append(
            "<tr><td colspan='2'>No MSME building data</td></tr>"
        );
    } else {
        for (var i in rows) {
            var row = rows[i];
            var name = `<i class='fas fa-store-alt'></i> ${row.name}`;
            let icon = "assets/ico/kadai.png";
            let info =
                "<tr><td>" +
                name +
                "</td><td style='text-align: center'><button class='btn btn-theme04 btn-xs' onclick='detailumkm_infow(\"" +
                row.id +
                "\");' title='tampilkan info'><i class='fa fa-search-plus'></i></button></td></tr>";
            data_model(row.id, name, row.latitude, row.longitude, icon, info);
            klikInfoWindowumkm(row.id);
        }
    }
}

function data_model(id, name, latitude, longitude, icon, info) {
    centerBaru = new google.maps.LatLng(latitude, longitude);
    marker = new google.maps.Marker({
        position: centerBaru,
        icon: icon,
        map: map,
        animation: google.maps.Animation.DROP
    });
    markersDua.push(marker);
    map.setCenter(centerBaru);
    map.setZoom(14);
    tampilkanhasilcari();
    $("#hasilcari").append(info);
    a = a + 1;
    $("#found").empty();
    $("#found").append("Found: " + a);
    $("#hidecari").show();
}
