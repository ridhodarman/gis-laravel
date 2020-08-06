@extends('admin.layouts.sidebar')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" onclick="location.href = 'bangunan';">
        <a class="nav-link" id="bang-tab" data-toggle="tab" href="#bang" role="tab" aria-controls="bang" aria-selected="true"><i class="far fa-building"></i> Manage Building Data</a>
    </li>
    <li class="nav-item" onclick="location.href = 'konstruksi';">
        <a class="nav-link" id="konstruksi-tab" data-toggle="tab" href="#konstruksi" role="tab" aria-controls="konstruksi" aria-selected="false"><i class="fas fa-hammer"></i> Manage Data on Types of Construction</a>
    </li>
    <li class="nav-item" onclick="location.href = 'model';">
        <a class="nav-link" id="model-tab" data-toggle="tab" href="#model" role="tab" aria-controls="model" aria-selected="false"><i class="fas fa-home"></i> Manage Building Model Data</a>
    </li>
</ul>
<div class="tab-content card" id="myTabContent">
    @yield('isi')
    <!-- <div class="tab-pane fade show active" id="bang" role="tabpanel" aria-labelledby="bang-tab">
        
    </div>
    <div class="tab-pane fade" id="konstruksi" role="tabpanel" aria-labelledby="konstruksi">
        
    </div>
    <div class="tab-pane fade" id="model" role="tabpanel" aria-labelledby="model">
            
    </div> -->
</div>
<script type="text/javascript">
    $("#databangunan").addClass("active");
</script>
@endsection