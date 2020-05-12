<script src="{{ asset('pages/inc/slideshow/jquery.resize.js') }}"></script>
<script src="{{ asset('pages/inc/slideshow/jquery.waitforimages.min.js') }}"></script>
<script src="{{ asset('pages/inc/slideshow/modernizr.js') }}"></script>
<script src="{{ asset('pages/inc/slideshow/jquery.carousel-3d.js') }}"></script>
<link rel="stylesheet" href="{{ asset('pages/inc/slideshow/jquery.carousel-3d.default.css') }}">
<?php
$n=1;$foto;$tglfoto;
foreach ($photo as $p){
    $foto[$n]=$p->photo_url;
    $tglfoto[$n]=$p->upload_date;
    $n++;
}
$img="";
$server='foto/bangunan/';
        $img=$img. '<div data-carousel-3d>';
        if ($n==0) { 
            $img=$img. '
                    <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                        <img src="foto/ibadah.png" />
                        <a class="icon-container" style="background-color: #d8dbff" href="#">
                            <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                        </a>
                    </div>
                    <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                        <img src="foto/ibadah.png" />
                        <a class="icon-container" style="background-color: #d8dbff" href="#">
                            <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                        </a>
                    </div>
            ';
        }
        else{ 
            $i=1;
            while($i<$n){
                $img=$img. '
                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                    <img src="'.$server.$foto[$i].'" />
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
                        <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
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

?>
 
<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                        @foreach ($info as $i)
                            <h6>ID:
                                {{$i->worship_building_id}}
                            </h6>
                            <br />
                            <table style="width: 100%;">
                                <tr>
                                    <td>Nama </td>
                                    <td>:</td>
                                    <td>
                                        {{$i->name_of_worship_building}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Worship Type </td>
                                    <td>:</td>
                                    <td>
                                        {{$i->jenis}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Building Size </td>
                                    <td>:</td>
                                    <td>
                                        {{$i->building_area}} m<sup>2</sup>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Land Area </td>
                                    <td>:</td>
                                    <td>
                                        {{$i->land_area}} m<sup>2</sup>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Parking Area </td>
                                    <td>:</td>
                                    <td>
                                        {{0+$i->parking_area}} m<sup>2</sup>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Standing Year </td>
                                    <td>:</td>
                                    <td>
                                        {{$i->standing_year}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Construction Type </td>
                                    <td>:</td>
                                    <td>
                                        {{$i->constr}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Electricity Capacity </td>
                                    <td>:</td>
                                    <td>
                                        {{0+$i->electricity_capacity}} VA
                                    </td>
                                </tr>
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
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5>Photo
                                <!-- <button id="ukuranpenuh" class="btn btn-warning btn-sm" title="show all images in full screen">
                                    <i class="ti-fullscreen"></i>
                                </button> -->
                            </h5><br/>
                            <?php echo $img; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                        <h6>Facility</h6>
                        <br/>
                        <table width="100%" class="table-striped table-bordered table-hover">
                            <thead style="text-align: center;">
                                <th>Name of Facility</th>
                                <th>Qty</th>
                            </thead>
                            <tbody>
                            	@foreach ($fasilitas as $f)
                                    <tr style="height: 200%">
                                    <td>{{$f->name_of_facility}}</td>
                                    <td>{{$f->quantity_of_facilities}}</td>
                                    </tr>
                                @endforeach
                                
                            <?php
                            if (count($fasilitas)<1) {
                            	echo '<td colspan="2"><center>no facility data</center></td>';
                            }
                            ?>
                                
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 