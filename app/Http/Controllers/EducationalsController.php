<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\educational;
use Illuminate\Http\Request;

class educationalsController extends Controller
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
     * @param  \App\educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function show(educational $educational)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function edit(educational $educational)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, educational $educational)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function destroy(educational $educational)
    {
        //
    }

    public function digit(){
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_AsGeoJSON(buildings.geom) AS geometry"))
                    ->addSelect('educational_building_id', 'name_of_educational_building')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id');
        $sql = $query->get();
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($sql as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geometry, true),
                'jenis' => "Educational Building",
                'properties' => array(
                    'id' => $data->educational_building_id,
                    'nama' => $data->name_of_educational_building
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

    public function semua(){
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('educational_buildings.educational_building_id', 'educational_buildings.name_of_educational_building')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->orderBy('educational_buildings.name_of_educational_building')
                    ->get();
        return $query;
    }

    public function cari_nama($nama){
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('educational_buildings.educational_building_id', 'educational_buildings.name_of_educational_building')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->orWhere('educational_buildings.name_of_educational_building', 'ilike', array("%".$nama."%"))
                    ->orderBy('educational_buildings.name_of_educational_building')
                    ->get();
        return $query;
    }

    public function cari_tingkat($tingkat){
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('educational_buildings.educational_building_id', 'educational_buildings.name_of_educational_building')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->where('educational_buildings.id_level_of_education', '=', '?')
                    ->orderBy('educational_buildings.name_of_educational_building')
                    ->setBindings([$tingkat])
                    ->get();
        return $query;
    }

    public function cari_jenis($jenis){
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('educational_buildings.educational_building_id', 'educational_buildings.name_of_educational_building')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->where('educational_buildings.school_type', '=', '?')
                    ->orderBy('educational_buildings.name_of_educational_building')
                    ->setBindings([$jenis])
                    ->get();
        return $query;
    }

    public function cari_luasbang($luasbang){
        $luasbang2 = explode(",", $luasbang);
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('educational_buildings.educational_building_id', 'educational_buildings.name_of_educational_building')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->whereBetween('building_area', $luasbang2)
                    ->orderBy('name_of_educational_building')
                    ->get();
        return $query;
    }

    public function cari_luastanah($luastanah){
        $luastanah2 = explode(",", $luastanah);
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                            ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('educational_buildings.educational_building_id', 'educational_buildings.name_of_educational_building')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->whereBetween('land_area', $luastanah2)
                    ->orderBy('name_of_educational_building')
                    ->get();
        return $query;
    }

    public function cari_konstruksi($konstruksi){
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('educational_buildings.educational_building_id', 'educational_buildings.name_of_educational_building')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->where('buildings.type_of_construction', '=', '?')
                    ->orderBy('educational_buildings.name_of_educational_building')
                    ->setBindings([$konstruksi])
                    ->get();
        return $query;
    }

    public function cari_tahun($tahun){
        $tahun2 = explode(",", $tahun);
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                            ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('educational_buildings.educational_building_id', 'educational_buildings.name_of_educational_building')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->whereBetween('standing_year', $tahun2)
                    ->orderBy('name_of_educational_building')
                    ->get();
        return $query;
    }

    public function cari_radius($rad){
        $r = explode(",", $rad);
        $lat = $r[0];
        $lng = $r[1];
        $radius = $r[2];
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_CENTROID(buildings.geom)) AS longitude, 
                                    ST_Y(ST_CENTROID(buildings.geom)) AS latitude,
                                    ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1), buildings.geom) AS jarak"))
                    ->addSelect('educational_buildings.educational_building_id', 'educational_buildings.name_of_educational_building')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->whereRaw("ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1),geom) <= ?")
                    ->orderByRaw('jarak')
                    ->setBindings([$radius])
                    ->get();
        return $query;
    }
    
    public function cari_jorong($jorong){
        $query = DB::table(DB::raw('educational_building AS W, jorong AS J, building AS B')) 
                    ->select(DB::raw("ST_X(ST_Centroid(B.geom)) AS longitude, 
                                      ST_Y(ST_CENTROID(B.geom)) AS latitude, 
                                      W.educational_building_id, W.name_of_educational_building"))
                    ->whereRaw("ST_CONTAINS(J.geom, B.geom) 
                                AND J.jorong_id = ? 
                                AND B.building_id=W.educational_building_id")
                    ->orderByRaw('W.name_of_educational_building')
                    ->setBindings([$jorong])
                    ->get();
        return $query;
    }

    public function cari_fasilitas($fas){
        $fasilitas = explode(",", $fas); 
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('educational_buildings.educational_building_id', 'educational_buildings.name_of_educational_building')
                    ->join('detail_educational_building_facilities', 
                            'educational_buildings.educational_building_id', 
                            '=', 'detail_educational_building_facilities.educational_building_id')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->whereIn('detail_educational_building_facilities.facility_id', $fasilitas)
                    ->groupBy('detail_educational_building_facilities.educational_building_id',
                                'educational_buildings.educational_building_id',
                                'educational_buildings.name_of_educational_building',
                                'buildings.geom'
                    )
                    ->orderBy('educational_buildings.name_of_educational_building')
                    ->get();
        return $query;
    }

    public function cari_model($model){
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('educational_buildings.educational_building_id AS id', 'educational_buildings.name_of_educational_building AS name')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->where('buildings.model_id', '=', '?')
                    ->orderBy('educational_buildings.name_of_educational_building')
                    ->setBindings([$model])
                    ->get();
        return $query;
    }

    public function info($id){
        $query = DB::table('educational_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('educational_buildings.educational_building_id', 'educational_buildings.name_of_educational_building', 
                                'building_gallery.photo_url')
                    ->leftJoin('building_gallery', 'educational_buildings.educational_building_id', 
                            '=', 'building_gallery.building_id')
                    ->join('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->where('educational_buildings.educational_building_id', '=', '?')
                    ->orderBy('building_gallery.upload_date', 'DESC')
                    ->limit(1)
                    ->setBindings([$id])
                    ->get();
        return $query;
    }

    public function detail($id){
        $query = DB::table('educational_buildings')
                    ->addSelect('educational_buildings.*', 'name_of_educational_building','building_area', 'land_area',
                                'parking_area', 'standing_year', 'electricity_capacity', 
                                'name_of_model', 'address', 'name_of_level AS level', 
                                'type_of_construction.name_of_type AS constr')
                    ->leftJoin('level_of_education', 'educational_buildings.id_level_of_education', '=', 'level_of_education.level_id')
                    ->leftJoin('buildings', 'educational_buildings.educational_building_id', '=', 'buildings.building_id')
                    ->leftJoin('type_of_construction', 'buildings.type_of_construction', '=', 'type_of_construction.type_id')
                    ->leftJoin('building_model', 'buildings.model_id', '=', 'building_model.model_id')
                    ->where('educational_buildings.educational_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql = $query->get();

        $query2 = DB::table('building_gallery')
                    ->Select('photo_url', 'upload_date')
                    ->where('building_id', '=', '?')
                    ->setBindings([$id]);
        $sql2 = $query2->get();

        $query3 = DB::table('detail_educational_building_facilities')
                    ->Select('name_of_facility', 'quantity_of_facilities')
                    ->join('educational_building_facilities', 
                                'detail_educational_building_facilities.facility_id', '=', 
                                    'educational_building_facilities.facility_id')
                    ->where('detail_educational_building_facilities.educational_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql3 = $query3->get();

        return view('popup.view', ['type'=>'educational', 'info' => $sql, 'photo' => $sql2, 'fasilitas' => $sql3]);
        //return $sql;
    }
}
