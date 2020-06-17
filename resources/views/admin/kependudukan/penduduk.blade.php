@extends('admin.kependudukan.inc.layout-kependudukan')

@section('isi')
    <div class="tab-pane fade show active" id="kk" role="tabpanel" aria-labelledby="kk-tab">
            @include('admin.kependudukan.inc.penduduk')
    </div>
<script type="text/javascript">
    $("#penduduk-tab").addClass("active");
</script>
@endsection