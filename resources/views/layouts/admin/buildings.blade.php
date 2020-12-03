<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a href="{{ route('bangunan') }}" class="nav-link" id="bang-tab" role="tab" aria-controls="bang"><i class="far fa-building"></i> Manage Building Data</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('konstruksi') }}" class="nav-link" id="konstruksi-tab" role="tab" aria-controls="konstruksi"><i class="fas fa-hammer"></i> Manage Data on Types of Construction</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('model') }}" class="nav-link" id="model-tab" role="tab" aria-controls="model"><i class="fas fa-home"></i> Manage Building Model Data</a>
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