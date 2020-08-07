@extends('admin.building.inc.layout-bangunan')

@section('isi')
<div class="tab-pane fade show active" id="konstruksi" role="tabpanel" aria-labelledby="konstruksi">
    <div class="tombol-atas mt-5 mb-3 mr-5 ml-5" style="text-align: center;">
        <button class="btn btn-default btn-lg" style="width: 100%;" data-toggle="modal"
            data-target="#tambahjenis">+
            Add New Types of Construction</button>
    </div>

    <div class="modal fade" id="tambahjenis">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Types of Construction</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form method="post" action="/konstruksi">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name of Type:</label>
                            <input type="text" class="form-control 
                                            @error('name_of_type') is-invalid @enderror" name="name_of_type"
                                id="name_of_type" onkeyup="javascript:capitalize(this);"
                                value="{{ old('name_of_type') }}">
                            @error('name_of_type')
                            <script>
                                $(document).ready(function () {
                                    $('#tambahjenis').modal('show');
                                });
                            </script>
                            <br />
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">+ Add</button>
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
        <h4 style="text-align: center;">Construction Type List</h4>
        <table width="100%" class="table table-striped table-bordered table-hover" style="text-align: center"
            id="listkonstruksi">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Type of Construction</th>
                    <th>Number of buildings</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($konstruksi as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$k->name_of_type}}</td>
                    <td>{{$k->jumlah}}</td>
                    <td>
                        <button class="btn btn-info btn-xs" data-toggle="modal"
                            onclick="edit(`{{$k->id}}`, `{{$k->name_of_type}}`)"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-danger btn-xs" title="Hapus"
                            onclick="hapus(`{{$k->id}}`, `{{$k->name_of_type}}`, `{{$k->jumlah}}`)"><i class="fa fa-trash"></i>
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
                            <label>Name of Construction Type:</label>
                            <input type="hidden" class="form-control" name="id_e" id="id-e">
                            <input type="text" name="new_name" id="nama-e" class="form-control"
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
                    <p>Are you sure you want to delete "<b id="nama"></b>" from this type of construction? <br />
                        There are <b id="jumlah"></b> buildings that have this type of construction
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
            edit(`{{ session('id_edit') }}`, `{{ session('nama_edit') }}`);
            $('#warning').modal('show');
            $("#pesan-warning").append(`{!! session('gagal-edit') !!}`);
        });
    </script>
    @endif

    <script type="text/javascript">
        function edit(id, jenis) {
            $('#edit').modal('show');
            $('#judul-e').html(`Edit '${jenis}' `);
            document.getElementById("nama-e").value = escapeHtml(jenis);
            document.getElementById("id-e").value = id;
            $('#form-edit').attr('action', `konstruksi/${id}`);
        }

        function hapus(id, jenis, jumlah) {
            $('#hapus').modal('show');
            $('#judul').html(`Delete '${jenis}' ?`);
            $('#nama').html(jenis);
            $('#jumlah').html(jumlah);
            $('#form-hapus').attr('action', `konstruksi/${id}`);
            //$('#form-hapus').attr('action', id);
        }

        $(document).ready(function () {
            $('#listkonstruksi').DataTable();
        });

        $("#konstruksi-tab").addClass("active");
    </script>
</div>
@endsection