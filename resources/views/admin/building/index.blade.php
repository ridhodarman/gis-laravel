@extends('admin.building.inc.layout-bangunan')

@section('title', 'Buildings')

@section('isi')
    <div class="tab-pane fade show active card" id="bang" role="tabpanel" aria-labelledby="bang-tab">
            <div class="main-content-inner">
                <br/>
                <center>
                    <button onclick="location.href='/spasial'" class="btn btn-light btn-lg" style="width: 90%; border-color: #e8e8e8;">
                        <i class="fas fa-globe-asia"></i> &nbsp; Manage spatial data and building attributes
                    </button>
                </center>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mt-5 mb-3">
                                <div class="card">
                                    <a href="ibadah">
                                    <div class="seo-fact sbg2">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="fas fa-mosque fa-3x"></i> Worship Building</div>
                                            <h2>{{ $ibadah }}<br/><small style="font-size: 45%;">View Details</small></h2>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
            
                            <div class="col-md-6 mt-5 mb-3">
                                <div class="card">
                                    <a href="rumah">
                                    <div class="seo-fact cokelat">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="ti-home"></i> House Building</div>
                                            <h2>{{ $rumah }}<br/><small style="font-size: 45%;">View Details</small></h2>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
            
                            <div class="col-md-6 mt-5 mb-3">
                                <div class="card">
                                    <a href="kantor">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="fas fa-university fa-3x"></i> Office Building</div>
                                            <h2>{{ $kantor }}<br/><small style="font-size: 45%;">View Details</small></h2>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
            
                            <div class="col-md-6 mt-5 mb-3">
                                <div class="card">
                                    <a href="pendidikan">
                                    <div class="seo-fact hitam">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="fas fa-school fa-3x"></i> Educational Building</div>
                                            <h2>{{ $pendidikan }}<br/><small style="font-size: 45%;">View Details</small></h2>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
            
                            <div class="col-md-6 mt-5 mb-3">
                                <div class="card">
                                    <a href="kesehatan">
                                    <div class="seo-fact sbg3">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="fas fa-hospital fa-3x"></i> Health Building</div>
                                            <h2>{{ $kesehatan }}<br/><small style="font-size: 45%;">View Details</small></h2>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
            
                            <div class="col-md-6 mt-5 mb-3">
                                <div class="card">
                                    <a href="umkm">
                                    <div class="seo-fact ungu">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-store-alt fa-3x"></i></div>
                                                    <div class="col-sm-7">MSME<small> (Micro, Small & Medium Enterprises) Building</small></div>
                                                    <div class="col-sm-3"><h2>{{ $umkm }}<br/><small style="font-size: 45%;">View</small></h2></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script type="text/javascript">
        $("#bang-tab").addClass("active");
    </script>
@endsection