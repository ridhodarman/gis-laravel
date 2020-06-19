@extends('admin.datuk.inc.layout-datuk')

@section('isi')
<div class="tab-pane fade show active" id="datuk" role="tabpanel" aria-labelledby="datuk">
    <div style="text-align: center; padding-top: 3%; padding-bottom:3%">
        <button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal"
            data-target="#tambahdatuk">+
            Add new datuk</button>
    </div>

    <div class="modal fade" id="tambahdatuk">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new datuk</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form method="post" action="/datuk">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Datuk Name:</label>
                            <input type="text" class="form-control 
                                            @error('datuk_name') is-invalid @enderror" name="datuk_name"
                                id="datuk_name" onkeyup="javascript:capitalize(this);"
                                value="{{ old('datuk_name') }}">
                            @error('datuk_name')
                            <script>
                                $(document).ready(function () {
                                    $('#tambahdatuk').modal('show');
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
        <h4 style="text-align: center;">Datuk List</h4>
        <table width="100%" class="table table-striped table-bordered table-hover" style="text-align: center"
            id="listdatuk">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Datuk Name</th>
                    <th>Number of citizen</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datuk as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$d->datuk_name}}</td>
                    <td>{{$d->jumlah}}</td>
                    <td>
                        <button class="btn btn-info btn-xs" data-toggle="modal"
                            onclick="edit(`{{$d->id}}`, `{{$d->datuk_name}}`)"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-danger btn-xs" title="Hapus"
                            onclick="hapus(`{{$d->id}}`, `{{$d->datuk_name}}`, `{{$d->jumlah}}`)"><i class="fa fa-trash"></i>
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
                    <p>Are you sure you want to delete "<b id="nama"></b>" from the datuk list? <br />
                        There are <b id="jumlah"></b> citizens that have this datuk
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
        function edit(id, datuk) {
            $('#edit').modal('show');
            $('#judul-e').html(`Edit '${datuk}' `);
            document.getElementById("nama-e").value = escapeHtml(datuk);
            document.getElementById("id-e").value = id;
            $('#form-edit').attr('action', `datuk/${id}`);
        }

        function hapus(id, datuk, jumlah) {
            $('#hapus').modal('show');
            $('#judul').html(`Delete '${datuk}' ?`);
            $('#nama').html(datuk);
            $('#jumlah').html(jumlah);
            $('#form-hapus').attr('action', `datuk/${id}`);
        }

        $(document).ready(function () {
            $('#listdatuk').DataTable();
        });

        $("#datuk-tab").addClass("active");
    </script>
</div>
@endsection