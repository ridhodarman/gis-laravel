<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a href="{{ route('keluarga') }}" class="nav-link" id="kk-tab" role="tab" aria-controls="kk" aria-selected="false"><i class="fa fa-users"></i> Family Card</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('penduduk') }}" class="nav-link" id="penduduk-tab" role="tab" aria-controls="penduduk" aria-selected="false"><i class="fas fa-user-ninja"></i> Citizen</a>
    </li>
    <li class="nav-item" onclick="location.href = 'pendidikan';">
        <a class="nav-link" id="pendidikan-tab" data-toggle="tab" href="#pendidikan" role="tab" aria-controls="pendidikan" aria-selected="false"><i class="fas fa-user-ninja"></i> Education List</a>
    </li>
    <li class="nav-item" onclick="location.href = 'pekerjaan';">
        <a class="nav-link" id="kerja-tab" data-toggle="tab" href="#kerja" role="tab" aria-controls="kerja" aria-selected="false"><i class="fas fa-chalkboard-teacher"></i> Job List</a>
    </li>
</ul>
<div class="tab-content card" id="myTabContent">
    @yield('isi')
</div>
<script type="text/javascript">
    $("#keluarga").addClass("active");
</script>