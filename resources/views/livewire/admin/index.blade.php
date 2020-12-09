@section('title', 'Data Admin')
<div class="panel-body card" style="margin: 1%;">
<div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin">
    <div style="text-align: center; padding-top: 3%; padding-bottom:3%">
        <button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" onclick="$('#tambahadmin').modal('show');">
            + Add new admin</button>
    </div>

    <div class="modal fade" id="tambahadmin">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new admin</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form method="post" action="/admin">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>admin Name:</label>
                            <input type="text" class="form-control 
                                            @error('admin_name') is-invalid @enderror" name="admin_name"
                                id="admin_name" onkeyup="javascript:capitalize(this);"
                                value="{{ old('admin_name') }}">
                            @error('admin_name')
                            <script>
                                $(document).ready(function () {
                                    $('#tambahadmin').modal('show');
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

    
        <h4 style="text-align: center;">Admin List</h4>
        <table width="100%" class="table table-striped table-bordered table-hover" style="text-align: center"
            id="listadmin" data-turbolinks="false">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $u)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$u->name}}</td>
                    <td>{{$u->username}}</td>
                    <td>{{$u->email}}</td>
                    <td>
                        <button class="btn btn-info btn-xs" data-toggle="modal"
                            onclick="edit(`{{$u->id}}`, `{{$u->admin_name}}`)"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-danger btn-xs" title="Hapus"
                            onclick="hapus(`{{$u->id}}`, `{{$u->admin_name}}`, `{{$u->jumlah}}`)"><i class="fa fa-trash"></i>
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
                            <label>admin Name:</label>
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
                    <p>Are you sure you want to delete "<b id="nama"></b>" from the admin list? <br />
                        There are <b id="jumlah"></b> citizens that have this admin
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
        function edit(id, admin) {
            $('#edit').modal('show');
            $('#judul-e').html(`Edit '${admin}' `);
            document.getElementById("nama-e").value = escapeHtml(admin);
            document.getElementById("id-e").value = id;
            $('#form-edit').attr('action', `admin/${id}`);
        }

        function hapus(id, admin, jumlah) {
            $('#hapus').modal('show');
            $('#judul').html(`Delete '${admin}' ?`);
            $('#nama').html(admin);
            $('#jumlah').html(jumlah);
            $('#form-hapus').attr('action', `admin/${id}`);
        }

        $(document).ready(function () {
            //$('#listadmin').DataTable();
            if( $('#listadmin_filter').length )        
            {
                
            }
            else {
                $('#listadmin').DataTable();
            }
        });

        $("#admin").addClass("active");
    </script>
</div>