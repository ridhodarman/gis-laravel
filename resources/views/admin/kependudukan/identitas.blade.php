@extends('admin.layouts.app')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pendidikan-tab" data-toggle="tab" href="#pendidikan" role="tab" aria-controls="pendidikan" aria-selected="false"><i class="fas fa-user-ninja"></i> Education List</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="kerja-tab" data-toggle="tab" href="#kerja" role="tab" aria-controls="kerja" aria-selected="false"><i class="fas fa-chalkboard-teacher"></i> Job List</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="suku-tab" data-toggle="tab" href="#suku" role="tab" aria-controls="suku" aria-selected="false"><i class="fas fa-project-diagram"></i> Tribe List</a>
    </li>
</ul>
<div class="tab-content mt-3" id="myTabContent">
    <div class="tab-pane fade show active" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
            @include('admin.kependudukan.inc.pendidikan')
    </div>
    <div class="tab-pane fade" id="kerja" role="tabpanel" aria-labelledby="kerja-tab">
            @include('admin.kependudukan.inc.pekerjaan')
    </div>
    <div class="tab-pane fade" id="suku" role="tabpanel" aria-labelledby="suku-tab">
            @include('admin.kependudukan.inc.suku')
    </div>
</div>
<script type="text/javascript">
    $("#kependudukan").addClass("active");
    $("#data-identitas").addClass("active");

    function dashboard() {
        window.location.href="../";
    }
</script>
@endsection