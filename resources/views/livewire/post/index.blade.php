@if (session()->has('success'))
    <script>
        swal("{!! session('success') !!}");    
    </script>
@endif

<div style="padding: 20px;">
    <a href="{{ route('post.create') }}" class="btn btn-primary">Tambah</a>
    <br/><br/>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name of model</th>
                <th>Number of buildings</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$m->name_of_model}}</td>
                <td>{{$m->jumlah}}</td>
                <td>
                    <a href="{{ route('post.edit', $m->id) }}">
                        <button class="btn btn-info btn-xs">Edit</button>
                    </a>
                    <button class="btn btn-danger btn-xs" title="Hapus" wire:click="destroy({{ $m->id }})">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
      {{ $posts->links() }}
</div>
