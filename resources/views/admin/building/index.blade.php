@extends('admin.building.inc.layout-bangunan')

@section('title', 'Buildings')

@section('isi')
<style>
    * {
        box-sizing: border-box;
        -webkit-tap-highlight-color: transparent
    }

    .button {
        position: relative;
        padding: 0;
        width: 80%;
        border: 4px solid #888888;
        outline: none;
        background-color: #f4f5f6;
        border-radius: 40px;
        box-shadow: -6px -20px 35px #ffffff, -6px -10px 15px #ffffff, -20px 0px 30px #ffffff, 6px 20px 25px rgba(0, 0, 0, 0.2);
        transition: .13s ease-in-out;
        cursor: pointer;
    }

    .button:active {
        box-shadow: none;
    }

    .button:active .button__content {
        box-shadow: none;
    }

    .button:active .button__content .button__text,
    .button:active .button__content .button__icon {
        transform: translate3d(0px, 0px, 0px);
    }

    .button__content {
        position: relative;
        padding: 20px;
        width: 100%;
        height: 100%;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        box-shadow: inset 0px -8px 0px #dddddd, 0px -8px 0px #f4f5f6;
        border-radius: 40px;
        transition: .13s ease-in-out;
        z-index: 1;
    }

    .button__icon {
        margin-top: -27px;
        transform: translate3d(0px, -4px, 0px);
        grid-column: 4;
        align-self: start;
        justify-self: end;
        width: 32px;
        height: 32px;
        transition: .13s ease-in-out;
        font-size: 22px;
        color: gray;
        float: right;
    }

    .button__icon svg {
        width: 18px;
        height: 18px;
        fill: #aaaaaa;
    }

    .button__text {
        position: relative;
        transform: translate3d(0px, -4px, 0px);
        margin-top: -13px;
        text-align: center;
        font-size: 18px;
        background-color: #888888;
        color: transparent;
        text-shadow: 2px 2px 3px rgba(255, 255, 255, 0.5);
        -webkit-background-clip: text;
        -moz-background-clip: text;
        background-clip: text;
        transition: .13s ease-in-out;
    }

    .credits {
        margin-top: 24px;
    }

    .credits__reference {
        display: inline-block;
        border-bottom: 1px solid transparent;
        color: #0099ff;
        text-decoration: none;
        transition: ease-in .13s;
    }

    .credits__reference:hover {
        border-bottom-color: #0099ff;
    }
</style>
<div class="tab-pane fade show active card" id="bang" role="tabpanel" aria-labelledby="bang-tab">
    <div class="main-content-inner">
        <br />
        <center>
            <!-- <a href="{{ route('spasial') }}" style="font-family: Arial, Helvetica, sans-serif;">
                        <button class="btn btn-light btn-lg tombol-atas">
                             &nbsp; Manage spatial data and building attributes
                        </button>
                    </a> -->
            <a href="{{ route('spasial') }}" style="font-family: Arial, Helvetica, sans-serif;">
                <button class="button">
                    <div class="button__content">
                        <p class="button__text">
                            Manage spatial data and building attributes
                        </p>
                        <div class="button__icon">
                            <i class="fas fa-globe-asia"></i>
                        </div>
                        </p>
                    </div>
                </button>
            </a>
        </center>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6 mt-5 mb-3">
                        <div class="card">
                            <a href="ibadah">
                                <div class="seo-fact sbg2">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="fas fa-mosque fa-3x"></i> Worship Building
                                        </div>
                                        <h2>{{ $ibadah }}<br /><small style="font-size: 45%;">View Details</small></h2>
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
                                        <h2>{{ $rumah }}<br /><small style="font-size: 45%;">View Details</small></h2>
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
                                        <div class="seofct-icon"><i class="fas fa-university fa-3x"></i> Office Building
                                        </div>
                                        <h2>{{ $kantor }}<br /><small style="font-size: 45%;">View Details</small></h2>
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
                                        <div class="seofct-icon"><i class="fas fa-school fa-3x"></i> Educational
                                            Building</div>
                                        <h2>{{ $pendidikan }}<br /><small style="font-size: 45%;">View Details</small>
                                        </h2>
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
                                        <div class="seofct-icon"><i class="fas fa-hospital fa-3x"></i> Health Building
                                        </div>
                                        <h2>{{ $kesehatan }}<br /><small style="font-size: 45%;">View Details</small>
                                        </h2>
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
                                                <div class="col-sm-7">MSME<small> (Micro, Small & Medium Enterprises)
                                                        Building</small></div>
                                                <div class="col-sm-3">
                                                    <h2>{{ $umkm }}<br /><small style="font-size: 45%;">View</small>
                                                    </h2>
                                                </div>
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