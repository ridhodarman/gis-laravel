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
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_AsGeoJSON(buildings.geom::geometry) AS geometry"))
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id');
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
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_nama($nama){
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->orWhere('worship_buildings.name_of_worship_building', 'ilike', array("%".$nama."%"))  
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_jenis($jenis){
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->where('worship_buildings.type_of_worship', '=', '?')
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->setBindings([$jenis])
                    ->get();
        return $query;
    }

    public function cari_konstruksi($konstruksi){
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->where('buildings.type_of_construction', '=', '?')
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->setBindings([$konstruksi])
                    ->get();
        return $query;
    }

    public function cari_luasbang($luasbang){
        $luasbang2 = explode(",", $luasbang);
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->whereBetween('building_area', $luasbang2)
                    ->orderBy('name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_luastanah($luastanah){
        $luastanah2 = explode(",", $luastanah);
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                            ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->whereBetween('land_area', $luastanah2)
                    ->orderBy('name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_tahun($tahun){
        $tahun2 = explode(",", $tahun);
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                            ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->whereBetween('standing_year', $tahun2)
                    ->orderBy('name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_radius($rad){
        $r = explode(",", $rad);
        $lat = $r[0];   if (!is_numeric($lat)) { return abort(500); }
        $lng = $r[1];   if (!is_numeric($lng)) { return abort(500); }
        $radius = $r[2];
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_X(ST_CENTROID(buildings.geom::geometry)) AS longitude, 
                                    ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude,
                                    ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1), buildings.geom::geometry) AS jarak"))
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->whereRaw("ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1),geom) <= ?")
                    ->orderByRaw('jarak')
                    ->setBindings([$radius])
                    ->get();
        return $query;
    }
    
    public function cari_jorong($jorong){
        $query = DB::table(DB::raw('worship_building AS W, jorong AS J, building AS B')) 
                    ->select(DB::raw("ST_X(ST_Centroid(B.geom)) AS longitude, 
                                      ST_Y(ST_CENTROID(B.geom)) AS latitude, 
                                      W.worship_building_id, W.name_of_worship_building"))
                    ->whereRaw("ST_CONTAINS(J.geom, B.geom) 
                                AND J.jorong_id = ? 
                                AND B.building_id=W.worship_building_id")
                    ->orderByRaw('W.name_of_worship_building')
                    ->setBindings([$jorong])
                    ->get();
        return $query;
    }

    public function cari_fasilitas($fas){
        $fasilitas = explode(",", $fas); 
        $total = count($fasilitas);
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building',)
                    ->join('detail_worship_building_facilities', 
                            'worship_buildings.worship_building_id', 
                            '=', 'detail_worship_building_facilities.worshipb_id')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->whereIn('detail_worship_building_facilities.worship_building_facilities', $fasilitas)
                    ->groupBy('detail_worship_building_facilities.worshipb_id',
                                'worship_buildings.worship_building_id',
                                'detail_worship_building_facilities.worshipb_id',
                                'buildings.building_id'
                    )
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->havingRaw('COUNT(*) = '. $total)
                    ->get();
        return $query;
    }

    public function cari_model($model){
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('worship_buildings.worship_building_id AS id', 'worship_buildings.name_of_worship_building AS name')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->where('buildings.model_id', '=', '?')
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->setBindings([$model])
                    ->get();
        return $query;
    }

    public function info($id){
        $query = DB::table('worship_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building', 
                                'building_gallery.photo_url')
                    ->leftJoin('building_gallery', 'worship_buildings.worship_building_id', 
                            '=', 'building_gallery.building_id')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->where('worship_buildings.worship_building_id', '=', '?')
                    ->orderBy('building_gallery.upload_date', 'DESC')
                    ->limit(1)
                    ->setBindings([$id])
                    ->get();
        return $query;
    }

    public function detail($id){
        $query = DB::table('worship_buildings')
                    ->addSelect('worship_buildings.*', 'name_of_worship_building', 'building_area', 'land_area',
                                'parking_area', 'standing_year', 'electricity_capacity', 
                                'name_of_model', 'address', 'type_of_worship.name_of_type AS jenis', 
                                'type_of_construction.name_of_type AS constr')
                    ->leftJoin('type_of_worship', 'worship_buildings.type_of_worship', '=', 'type_of_worship.type_id')
                    ->leftJoin('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->leftJoin('type_of_construction', 'buildings.type_of_construction', '=', 'type_of_construction.type_id')
                    ->leftJoin('building_model', 'buildings.model_id', '=', 'building_model.model_id')
                    ->where('worship_buildings.worship_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql = $query->get();

        $query2 = DB::table('building_gallery')
                    ->Select('photo_url', 'upload_date')
                    ->where('building_id', '=', '?')
                    ->setBindings([$id]);
        $sql2 = $query2->get();

        $query3 = DB::table('detail_worship_building_facilities')
                    ->Select('name_of_facility', 'quantity_of_facilities')
                    ->join('worship_building_facilities', 
                                'detail_worship_building_facilities.facility_id', '=', 
                                    'worship_building_facilities.facility_id')
                    ->where('detail_worship_building_facilities.worship_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql3 = $query3->get();

        return view('popup.view', ['type'=>'worship', 'info' => $sql, 'photo' => $sql2, 'fasilitas' => $sql3]);
    }
}
