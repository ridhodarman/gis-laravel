<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a href="{{ route('datuk') }}" class="nav-link" id="datuk-tab" role="tab" aria-controls="datuk" aria-selected="true"><i class="ti-user"></i> Manage Datuk List</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('suku') }}" class="nav-link" id="suku-tab" role="tab" aria-controls="suku" aria-selected="false"><i class="fas fa-project-diagram"></i> Manage Tribe List</a>
    </li>
</ul>
<div class="tab-content card" id="myTabContent">
    @yield('isi')
</div>
<script type="text/javascript">
    $("#datuk").addClass("active");
</script>