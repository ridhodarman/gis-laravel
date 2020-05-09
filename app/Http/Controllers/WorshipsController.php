<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Worship;
use Illuminate\Http\Request;

class WorshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Worship  $worship
     * @return \Illuminate\Http\Response
     */
    public function show(Worship $worship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Worship  $worship
     * @return \Illuminate\Http\Response
     */
    public function edit(Worship $worship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Worship  $worship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worship $worship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worship  $worship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worship $worship)
    {
        //
    }

    public function digit(){
        $query = DB::table('worship_building')
                    ->select(DB::raw("ST_AsGeoJSON(building.geom) AS geometry"))
                    ->addSelect('worship_building.worship_building_id', 'worship_building.name_of_worship_building')
                    ->join('building', 'worship_building.worship_building_id', '=', 'building.building_id');
        $sql = $query->get();
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($sql as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geometry, true),
                'jenis' => "Worship Building",
                'properties' => array(
                    'id' => $data->worship_building_id,
                    'nama' => $data->name_of_worship_building
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

    public function semua(){
        $query = DB::table('worship_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('worship_building.worship_building_id', 'worship_building.name_of_worship_building')
                    ->join('building', 'worship_building.worship_building_id', '=', 'building.building_id')
                    ->orderBy('worship_building.name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_nama($nama){
        $nama2 = strtolower($nama);
        $query = DB::table('worship_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('worship_building.worship_building_id', 'worship_building.name_of_worship_building')
                    ->join('building', 'worship_building.worship_building_id', '=', 'building.building_id')
                    ->whereRaw('LOWER(worship_building.name_of_worship_building) LIKE (?)',"%{$nama2}%")
                    ->orderBy('worship_building.name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_jenis($jenis){
        $query = DB::table('worship_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('worship_building.worship_building_id', 'worship_building.name_of_worship_building')
                    ->join('building', 'worship_building.worship_building_id', '=', 'building.building_id')
                    ->where('worship_building.type_of_worship', '=', $jenis)
                    ->orderBy('worship_building.name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_konstruksi($konstruksi){
        $query = DB::table('worship_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('worship_building.worship_building_id', 'worship_building.name_of_worship_building')
                    ->join('building', 'worship_building.worship_building_id', '=', 'building.building_id')
                    ->where('type_of_construction', '=', $konstruksi)
                    ->orderBy('name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_luasbang($luasbang){
        $luasbang2 = explode(",", $luasbang);
        $query = DB::table('worship_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('worship_building.worship_building_id', 'worship_building.name_of_worship_building')
                    ->join('building', 'worship_building.worship_building_id', '=', 'building.building_id')
                    ->whereBetween('building_area', $luasbang2)
                    ->orderBy('name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_luastanah($luastanah){
        $luastanah2 = explode(",", $luastanah);
        $query = DB::table('worship_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                            ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('worship_building.worship_building_id', 'worship_building.name_of_worship_building')
                    ->join('building', 'worship_building.worship_building_id', '=', 'building.building_id')
                    ->whereBetween('land_area', $luastanah2)
                    ->orderBy('name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_tahun($tahun){
        $tahun2 = explode(",", $tahun);
        $query = DB::table('worship_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                            ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('worship_building.worship_building_id', 'worship_building.name_of_worship_building')
                    ->join('building', 'worship_building.worship_building_id', '=', 'building.building_id')
                    ->whereBetween('standing_year', $tahun2)
                    ->orderBy('name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_radius($rad){
        $r = explode(",", $rad);
        $lat = $r[0];
        $lng = $r[1];
        $radius = $r[2];
        $query = DB::table('worship_building')
                    ->select(DB::raw("ST_X(ST_CENTROID(building.geom)) AS longitude, 
                                    ST_Y(ST_CENTROID(building.geom)) AS latitude,
                                    ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1), building.geom) AS jarak"))
                    ->addSelect('worship_building.worship_building_id', 'worship_building.name_of_worship_building')
                    ->join('building', 'worship_building.worship_building_id', '=', 'building.building_id')
                    ->whereRaw("ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1),geom) <= $radius")
                    ->orderByRaw('jarak')
                    ->get();
        return $query;
    }
    
    public function cari_jorong($jorong){
        $query = DB::table(DB::raw('worship_building AS W, jorong AS J, building AS B')) 
                    ->select(DB::raw("ST_X(ST_Centroid(B.geom)) AS longitude, 
                                      ST_Y(ST_CENTROID(B.geom)) AS latitude, 
                                      W.worship_building_id, W.name_of_worship_building"))
                    ->whereRaw("ST_CONTAINS(J.geom, B.geom) 
                                AND J.jorong_id='$jorong' 
                                AND B.building_id=W.worship_building_id")
                    ->orderByRaw('W.name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_fasilitas($fas){
        $fasilitas = explode(",", $fas); $f = ""; $total = count($fasilitas);
        for($i=0;$i<$total;$i++){
            if($i == $total-1){
                $f .= "'".$fasilitas[$i]."'";
            }else{
                $f .= "'".$fasilitas[$i]."',";
            }
        }
        $query = DB::table(DB::raw('worship_building'))
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('worship_building.worship_building_id', 'worship_building.name_of_worship_building')
                    ->join('detail_worship_building_facilities', 
                            'worship_building.worship_building_id', 
                            '=', 'detail_worship_building_facilities.worship_building_id')
                    ->join('building', 'worship_building.worship_building_id', '=', 'building.building_id')
                    ->whereRaw("detail_worship_building_facilities.facility_id IN ($f) 
                                GROUP BY detail_worship_building_facilities.worship_building_id, 
                                worship_building.worship_building_id, 
                                worship_building.name_of_worship_building,
                                building.geom")
                    ->orderBy('worship_building.name_of_worship_building')
                    ->get();
        return $query;
    }

    public function detail($id){
        $query = DB::table(DB::raw('worship_building'))
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('worship_building.worship_building_id', 'worship_building.name_of_worship_building')
                    ->join('worship_building_gallery', 'worship_building.worship_building_id', 
                            '=', 'worship_building_gallery.worship_building_id')
                    ->join('building', 'worship_building.worship_building_id', '=', 'building.building_id')
                    ->where('worship_building.worship_building_id', '=', $id)
                    ->orderBy('worship_building_gallery.upload_date', 'DESC')
                    ->limit(1)
                    ->get();
        return $query;
    }
}
