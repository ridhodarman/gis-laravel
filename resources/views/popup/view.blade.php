<script src="{{ asset('pages/inc/slideshow/jquery.resize.js') }}"></script>
<script src="{{ asset('pages/inc/slideshow/jquery.waitforimages.min.js') }}"></script>
<script src="{{ asset('pages/inc/slideshow/modernizr.js') }}"></script>
<script src="{{ asset('pages/inc/slideshow/jquery.carousel-3d.js') }}"></script>
<link rel="stylesheet" href="{{ asset('pages/inc/slideshow/jquery.carousel-3d.default.css') }}">
@php
$n=1;$foto;$tglfoto;
foreach ($photo as $p){
    $foto[$n]=$p->photo_url;
    $tglfoto[$n]=$p->upload_date;
    $n++;
}
$img="";
$server='foto/bangunan/';
        $img=$img. '<div data-carousel-3d>';
        if ($n==1) { 
            $img=$img. '
                    <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                        <img src="foto/rumah.png" />
                        <a class="icon-container" style="background-color: #d8dbff" href="#">
                            <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                        </a>
                    </div>
                    <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                        <img src="foto/rumah.png" />
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

@endphp

<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                        @if($type=="worship")
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
                            @endforeach
                        @elseif($type=="msme")
                            @foreach ($info as $i)
                            <h6>ID:
                                    {{$i->msme_building_id}}
                                </h6>
                                <br />
                                <table style="width: 100%;">
                                    <tr>
                                        <td>Nama </td>
                                        <td>:</td>
                                        <td>
                                            {{$i->name_of_msme_building}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Type of MSME </td>
                                        <td>:</td>
                                        <td>
                                            {{$i->jenis}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Owner Name</td>
                                        <td>:</td>
                                        <td>
                                            {{$i->owner_name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Contact Person</td>
                                        <td>:</td>
                                        <td>
                                            {{$i->contact_person}}
                                        </td>
                                    </tr>
                            @endforeach
                        @elseif($type=="office")
                            @foreach ($info as $i)
                            <h6>ID:
                                    {{$i->office_building_id}}
                                </h6>
                                <br />
                                <table style="width: 100%;">
                                    <tr>
                                        <td>Nama </td>
                                        <td>:</td>
                                        <td>
                                            {{$i->name_of_office_building}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Type of Office </td>
                                        <td>:</td>
                                        <td>
                                            {{$i->jenis}}
                                        </td>
                                    </tr>
                            @endforeach
                        @elseif($type=="educational")
                            @foreach ($info as $i)
                            <h6>ID:
                                    {{$i->educational_building_id}}
                                </h6>
                                <br />
                                <table style="width: 100%;">
                                    <tr>
                                        <td>Nama </td>
                                        <td>:</td>
                                        <td>
                                            {{$i->name_of_educational_building}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Level of Education </td>
                                        <td>:</td>
                                        <td>
                                            {{$i->level}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>School Type</td>
                                        <td>:</td>
                                        <td>
                                            @if($i->school_type==0) Public School
                                            @elseif($i->school_type==1) Private School
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Headmaster Name</td>
                                        <td>:</td>
                                        <td>
                                            {{$i->headmaster_name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>All Students</td>
                                        <td>:</td>
                                        <td>
                                            {{$i->all_students}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>All Teachers</td>
                                        <td>:</td>
                                        <td>
                                            {{$i->all_teachers}}
                                        </td>
                                    </tr>
                            @endforeach
                        @elseif($type=="health")
                            @foreach ($info as $i)
                            <h6>ID:
                                {{$i->health_building_id}}
                            </h6>
                            <br />
                            <table style="width: 100%;">
                                <tr>
                                    <td>Nama </td>
                                    <td>:</td>
                                    <td>
                                        {{$i->name_of_health_building}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Type of Health Building </td>
                                    <td>:</td>
                                    <td>
                                        {{$i->jenis}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name of Head</td>
                                    <td>:</td>
                                    <td>
                                        {{$i->name_of_head}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>All Medical Personnel</td>
                                    <td>:</td>
                                    <td>
                                        {{$i->all_medical_personnel}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>All Non-Medical Personnel</td>
                                    <td>:</td>
                                    <td>
                                        {{$i->all_non_medical_personnel}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                            @foreach ($info as $i)
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
                            @php echo $img @endphp
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
                            
                            @if (count($fasilitas)<1) 
                            	<td colspan="2"><center>no facility data</center></td>
                            @endif

                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 