@section('title', 'Data Suku')
@extends('layouts.admin.datuk')
@section('isi')
<div class="tab-pane fade show active" id="suku" role="tabpanel" aria-labelledby="suku">
    <div style="text-align: center; padding-top: 3%; padding-bottom:3%">
        <button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" onclick="$('#tambahsuku').modal('show');">
            + Add a new tribe</button>
    </div>

    <div class="modal fade" id="tambahsuku">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add a new tribe</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form method="post" action="/suku">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name of Tribe:</label>
                            <input type="text" class="form-control 
                                            @error('name_of_tribe') is-invalid @enderror" name="name_of_tribe"
                                id="name_of_tribe" onkeyup="javascript:capitalize(this);"
                                value="{{ old('name_of_tribe') }}">
                            @error('name_of_tribe')
                            <script>
                                $(document).ready(function () {
                                    $('#tambahsuku').modal('show');
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
        <h4 style="text-align: center;">Tribe List</h4>
        <table width="100%" class="table table-striped table-bordered table-hover" style="text-align: center"
            id="listsuku">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name of Tribe</th>
                    <th>Number of datuk</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suku as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$s->name_of_tribe}}</td>
                    <td>{{$s->jumlah}}</td>
                    <td>
                        <button class="btn btn-info btn-xs" data-toggle="modal"
                            onclick="edit(`{{$s->id}}`, `{{$s->name_of_tribe}}`)"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-danger btn-xs" title="Hapus"
                            onclick="hapus(`{{$s->id}}`, `{{$s->name_of_tribe}}`, `{{$s->jumlah}}`)"><i class="fa fa-trash"></i>
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
                            <label>Name of Tribe:</label>
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
                    <p>Are you sure you want to delete "<b id="nama"></b>" from the tribal list? <br />
                        There are <b id="jumlah"></b> datuks that have this tribe
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
        function edit(id, suku) {
            $('#edit').modal('show');
            $('#judul-e').html(`Edit '${suku}' `);
            document.getElementById("nama-e").value = escapeHtml(suku);
            document.getElementById("id-e").value = id;
            $('#form-edit').attr('action', `suku/${id}`);
        }

        function hapus(id, suku, jumlah) {
            $('#hapus').modal('show');
            $('#judul').html(`Delete '${suku}' ?`);
            $('#nama').html(suku);
            $('#jumlah').html(jumlah);
            $('#form-hapus').attr('action', `suku/${id}`);
        }

        $(document).ready(function () {
            $('#listsuku').DataTable();
        });

        $("#suku-tab").addClass("active");
    </script>
</div>
@endsection