@extends('admin.layouts.app')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" onclick="location.href = 'datuk';">
        <a class="nav-link" id="datuk-tab" data-toggle="tab" href="#datuk" role="tab" aria-controls="datuk" aria-selected="true"><i class="ti-user"></i> Manage Datuk List</a>
    </li>
    <li class="nav-item" onclick="location.href = 'suku';">
        <a class="nav-link" id="suku-tab" data-toggle="tab" href="#suku" role="tab" aria-controls="suku" aria-selected="false"><i class="fas fa-project-diagram"></i> Manage Tribe List</a>
    </li>
</ul>
<div class="tab-content mt-3" id="myTabContent">
    @yield('isi')
</div>
<script type="text/javascript">
    $("#datuk").addClass("active");
</script>
@endsection