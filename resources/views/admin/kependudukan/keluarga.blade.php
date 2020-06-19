@extends('admin.kependudukan.inc.layout-kependudukan')

@section('isi')
<div class="tab-pane fade show active" id="kk" role="tabpanel" aria-labelledby="kk">
    <div style="text-align: center; padding-top: 3%; padding-bottom:3%">
        <button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal"
            data-target="#tambahkk">+
            Add Family Card Data</button>
    </div>

    <div class="modal fade" id="tambahkk">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="/keluarga" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h6 class="modal-title">Add Family Card Data</h6>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body" style="font-size: 110%">
                        <div class="form-group">
                            Family Card Number:
                            <input class="form-control @error('family_card_number') is-invalid @enderror" type="text"
                                name="family_card_number" value="{{ old('family_card_number') }}">
                        </div>
                        @error('family_card_number')
                        <script>
                            $(document).ready(function () {
                                $('#tambahkk').modal('show');
                                tampilnilai();
                            });
                        </script>
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            Category:
                            <select class="form-control" name="category" style="height: 43px" id="kategori">
                                <option></option>
                                <option value="0">Poor Family</option>
                                <option value="1">Capable Family</option>
                            </select>
                        </div>
                        <div class="form-group" id="combobox-rumah">
                            <div class="row">
                                <div class="form-group col-sm-12" id="rumah">
                                    <select class="selectpicker form-control" data-container="body"
                                        data-live-search="true" title="Select house.." data-hide-disabled=" true"
                                        name="house_building_id" id="id_rumah">
                                        <option></option>
                                        @foreach ($rumah as $r)
                                        <option value="{{$r->house_building_id}}">{{$r->house_building_id}}</option>"
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-2" id="view_rumah">
                                    <button class="btn btn-default btn-sm" id="tombol_rumah" title="see house details">
                                        <i class="fas fa-door-open"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="tinggal">
                            Residence Status:
                            <select class="form-control" name="residence_status" style="height: 43px" id="residence">
                                <option></option>
                                <option value="0">Contract</option>
                                <option value="1">Stay</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="tambahkanholder">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('status'))
    <script>
        $(document).ready(function () {
            $('#sukses').modal('show');
            $("#pesan-sukses").append("{!! session('status') !!}");
        });
    </script>
    @endif

    <div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%">
        <h4 style="text-align: center;">Family Card List</h4>
        <table width="100%" class="table table-striped table-bordered table-hover" style="text-align: center"
            id="listkk">
            <thead>
                <tr>
                    <th>Family Card Number</th>
                    <th>House ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kk as $row)
                <tr>
                    <td>{{$row->family_card_number}}</td>
                    <td>{{$row->house_building_id}}</td>
                    <td>
                        <button class="btn btn-info btn-xs" data-toggle="modal"
                            onclick="edit(`{{$row->family_card_number}}`)"><i class="fa fa-edit"></i>
                            Edit</button>
                        <button class="btn btn-danger btn-xs" title="Hapus"
                            onclick="hapus(`{{$row->family_card_number}}`, `{{$row->jumlah}}`)"><i
                                class="fa fa-trash"></i>
                            Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="post" style="width:100%;" action="" id="form-edit">
                @method('patch')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="judul-e">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Datuk Name:</label>
                            <input type="hidden" class="form-control" name="id_e" id="id-e">
                            <input type="text" name="nama_e" id="nama-e" class="form-control"
                                onkeyup="javascript:capitalize(this);">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="ti-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="hapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judul"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="text-align: center">
                    <p>Are you sure you want to delete "<b id="nama"></b>" from the family card list? <br />
                        There are <b id="jumlah"></b> citizens that have this family card
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="" method="POST" id="form-hapus">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (session('status-hapus'))
    <script>
        $(document).ready(function () {
            $('#sukses-hapus').modal('show');
            $("#pesan-hapus").append("{!! session('status-hapus') !!}");
        });
    </script>
    @endif

    @if (session('gagal-edit'))
    <script>
        $(document).ready(function () {
            //edit(`{{ session('id_edit') }}`, `{{ $row->family_card_number }}`);
            $('#warning').modal('show');
            $("#pesan-warning").append(`<b> {{ session('nama_baru') }} </b> = {!! session('gagal-edit') !!}`);
        });
    </script>
    @endif

    <script type="text/javascript">
        function edit(id, jenis) {
            $('#edit').modal('show');
            $('#judul-e').html(`Edit '${jenis}' `);
            document.getElementById("nama-e").value = jenis;
            document.getElementById("id-e").value = id;
            $('#form-edit').attr('action', `keluarga/${id}`);
        }

        function hapus(kk, jumlah) {
            $('#hapus').modal('show');
            $('#judul').html(`Delete '${kk}' ?`);
            $('#nama').html(kk);
            $('#jumlah').html(jumlah);
            $('#form-hapus').attr('action', `keluarga/${kk}`);
        }

        function tampilnilai() {
            $("#id_rumah").val("{{ old('house_building_id') }}").change();
            cekrumah();
            $("#kategori").val("{{ old('category') }}").change();
            $("#residence").val("{{ old('residence_status') }}").change();
        }

        $("#view_rumah").hide(); $("#tinggal").hide();
        function cekrumah() {
            if (document.getElementById("id_rumah").value) {
                $("#rumah").removeClass("col-sm-12");
                $("#rumah").addClass("col-sm-10");
                $("#view_rumah").show(); $("#tinggal").show();
            }
            else {
                $("#rumah").removeClass("col-sm-10");
                $("#rumah").addClass("col-sm-12");
                $("#view_rumah").hide(); $("#tinggal").hide();
            }
        }

        $("#id_rumah").change(function () {
            cekrumah();
        });
        $(function () {
            $('#tombol_rumah').click(function () {
                window.open(`/rumah/${document.getElementById("id_rumah").value}`);
                return false;
            });
        });

        $(document).ready(function () {
            $('#listkk').DataTable();
        });

        $("#kk-tab").addClass("active");

    </script>
</div>
@endsection