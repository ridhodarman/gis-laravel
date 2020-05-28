@extends('admin.layouts.app')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="far fa-building"></i> Manage Building Data</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="konstruksi-tab" data-toggle="tab" href="#konstruksi" role="tab" aria-controls="konstruksi" aria-selected="false"><i class="fas fa-hammer"></i> Manage Data on Types of Construction</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="model-tab" data-toggle="tab" href="#model" role="tab" aria-controls="model" aria-selected="false"><i class="fas fa-home"></i> Manage Building Model Data</a>
    </li>
</ul>
<div class="tab-content mt-3" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        @include('admin.building.inc.jenisbangunan')
    </div>
    <div class="tab-pane fade" id="konstruksi" role="tabpanel" aria-labelledby="konstruksi">
        @include('admin.building.inc.jeniskonstruksi')
    </div>
    <div class="tab-pane fade" id="model" role="tabpanel" aria-labelledby="model">
            @include('admin.building.inc.model')
    </div>
</div>
<script type="text/javascript">
    $("#databangunan").addClass("active");
    $("#data-atribut").addClass("active");

    function dashboard() {
        window.location.href="../";
    }
</script>
@endsection