<div>
    <a href="{{ route('keluarga') }}">kk</a>
    <br/>
    @foreach ($citizen as $row)
        {{$row->national_identity_number}}
        &emsp;
        {{$row->name}}
        <br/>
    @endforeach
</div>