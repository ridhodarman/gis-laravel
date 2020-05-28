@extends('admin.layouts.app')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home2" aria-selected="true"><i class="fa fa-users"></i> Family Card</a>
    </li>
    <li class="nav-item">
        <a onclick="loadcitizen()" class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-user-edit"></i> Citizen</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pendidikan-tab" data-toggle="tab" href="#pendidikan" role="tab" aria-controls="pendidikan" aria-selected="false"><i class="fas fa-user-ninja"></i>Education List</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="kerja-tab" data-toggle="tab" href="#kerja" role="tab" aria-controls="kerja" aria-selected="false"><i class="fas fa-chalkboard-teacher"></i>Job List</a>
    </li>
</ul>
<div class="tab-content mt-3" id="myTabContent">
    <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
        @include('admin.kependudukan.inc.kk')
    </div>
    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
            @include('admin.kependudukan.inc.penduduk')
    </div>
    <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
            @include('admin.kependudukan.inc.pendidikan')
    </div>
    <div class="tab-pane fade" id="kerja" role="tabpanel" aria-labelledby="kerja-tab">
            @include('admin.kependudukan.inc.pekerjaan')
    </div>
</div>
<script type="text/javascript">
    $("#kependudukan").addClass("active");
    $("#data-keluarga").addClass("active");

    function dashboard() {
        window.location.href="../";
    }
</script>
@endsection