<script src="{{ asset('pages2/inc/slideshow/jquery.resize.js') }}"></script>
<script src="{{ asset('pages2/inc/slideshow/jquery.waitforimages.min.js') }}"></script>
<script src="{{ asset('pages2/inc/slideshow/modernizr.js') }}"></script>
<script src="{{ asset('pages2/inc/slideshow/jquery.carousel-3d.js') }}"></script>
<link rel="stylesheet" href="{{ asset('pages2/inc/slideshow/jquery.carousel-3d.default.css') }}">
@php
$n=1;$foto;$tglfoto;
foreach ($photo as $p){
$foto[$n]=$p->photo_url;
$tglfoto[$n]=$p->updated_at;
$n++;
}
$img="";
$server='foto/bangunan/';
$img=$img. '<div data-carousel-3d>';
    if ( count($photo)
    <1 ) { $img=$img. '
                    <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                        <img src="foto/bangunan.png" />
                        <a class="icon-container" style="background-color: #d8dbff" href="#">
                            <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                        </a>
                    </div>
                    <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                        <img src="foto/bangunan.png" />
                        <a class="icon-container" style="background-color: #d8dbff" href="#">
                            <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                        </a>
                    </div>
            ' ; } else{ $i=1; while($i<$n){ $img=$img. '
                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                    <img src="' .$server.$foto[$i].'" />
    <label>Uploaded: '.$tglfoto[$i].'</label>
    <a class="icon-container" style="background-color: #d8dbff" href="'.$server.$foto[$i].'" target="_blank">
        <span class="ti-zoom-in"></span><span class="icon-name">Fullscreen</span>
    </a>
</div>';
$i++;
}

}

if ($n==2) {
$img=$img. '
<div
    style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
    <img src="'.$server.$foto[$i-1].'" />
    <label>Uploaded: '.$tglfoto[$i-1].'</label>
    <a class="icon-container" style="background-color: #d8dbff" href="'.$server.$foto[$i-1].'" target="_blank">
        <span class="ti-zoom-in"></span><span class="icon-name">Fullscreen</span>
    </a>
</div>';
}
$img=$img. '</div>';
$jumlah=$n-1;
$img=$img. "Total Photo: ".$jumlah;

@endphp

<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            @foreach ($info as $i)
                            <h6>ID:
                                {{$i->house_building_id}}
                            </h6>
                            <br />
                            <table style="width: 100%;">
                                <tr>
                                    <td>Address </td>
                                    <td>:</td>
                                    <td>
                                        {{$i->address}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Building Model </td>
                                    <td>:</td>
                                    <td>
                                        {{$i->name_of_model}}
                                    </td>
                                </tr>
                            </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5>Photo
                                <!-- <button id="ukuranpenuh" class="btn btn-warning btn-sm" title="show all images in full screen">
                                    <i class="ti-fullscreen"></i>
                                </button> -->
                            </h5><br />
                            @php echo $img; @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('status'))
        <div class="col-lg-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h6>Family Card</h6>
                            @if ( count($kk) <1 ) 
                                no family card data 
                            @else 
                            @foreach ($kk as $k) 
                                {{$k->family_card_number}}
                                <span class="badge badge-secondary"><a href="/{{$k->family_card_number}}">i</a>  </span>
                                &emsp;
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>