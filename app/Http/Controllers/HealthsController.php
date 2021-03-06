<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\health;
use Illuminate\Http\Request;

class healthsController extends Controller
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
     * @param  \App\health  $health
     * @return \Illuminate\Http\Response
     */
    public function show(health $health)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\health  $health
     * @return \Illuminate\Http\Response
     */
    public function edit(health $health)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\health  $health
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, health $health)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\health  $health
     * @return \Illuminate\Http\Response
     */
    public function destroy(health $health)
    {
        //
    }

    public function digit(){
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_AsGeoJSON(buildings.geom) AS geometry"))
                    ->addSelect('health_service_building_id', 'name_of_health_service_building')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id');
        $sql = $query->get();
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($sql as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geometry, true),
                'jenis' => "health Building",
                'properties' => array(
                    'id' => $data->health_service_building_id,
                    'nama' => $data->name_of_health_service_building
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

    public function semua(){
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->orderBy('health_service_buildings.name_of_health_service_building')
                    ->get();
        return $query;
    }

    public function cari_nama($nama){
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->orWhere('health_service_buildings.name_of_health_service_building', 'ilike', array("%".$nama."%"))
                    ->orderBy('health_service_buildings.name_of_health_service_building')
                    ->get();
        return $query;
    }

    public function cari_jenis($jenis){
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->where('health_service_buildings.type_of_health_service_building', '=', '?')
                    ->orderBy('health_service_buildings.name_of_health_service_building')
                    ->setBindings([$jenis])
                    ->get();
        return $query;
    }

    public function cari_radius($rad){
        $r = explode(",", $rad);
        $lat = $r[0];
        $lng = $r[1];
        $radius = $r[2];
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_X(ST_CENTROID(buildings.geom)) AS longitude, 
                                    ST_Y(ST_CENTROID(buildings.geom)) AS latitude,
                                    ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1), buildings.geom) AS jarak"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->whereRaw("ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1),geom) <= ?")
                    ->orderByRaw('jarak')
                    ->setBindings([$radius])
                    ->get();
        return $query;
    }
    
    public function cari_jorong($jorong){
        $query = DB::table(DB::raw('health_service_building AS W, jorong AS J, building AS B')) 
                    ->select(DB::raw("ST_X(ST_Centroid(B.geom)) AS longitude, 
                                      ST_Y(ST_CENTROID(B.geom)) AS latitude, 
                                      W.health_service_building_id, W.name_of_health_service_building"))
                    ->whereRaw("ST_CONTAINS(J.geom, B.geom) 
                                AND J.jorong_id = ? 
                                AND B.building_id=W.health_service_building_id")
                    ->orderByRaw('W.name_of_health_service_building')
                    ->setBindings([$jorong])
                    ->get();
        return $query;
    }

    public function cari_fasilitas($fas){
        $fasilitas = explode(",", $fas); 
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building')
                    ->join('detail_health_service_building_facilities', 
                            'health_service_buildings.health_service_building_id', 
                            '=', 'detail_health_service_building_facilities.health_service_building_id')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->whereIn('detail_health_service_building_facilities.facility_id', $fasilitas)
                    ->groupBy('detail_health_service_building_facilities.health_service_building_id',
                                'health_service_buildings.health_service_building_id',
                                'health_service_buildings.name_of_health_service_building',
                                'buildings.geom'
                    )
                    ->orderBy('health_service_buildings.name_of_health_service_building')
                    ->get();
        return $query;
    }

    public function cari_model($model){
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('health_service_buildings.health_service_building_id AS id', 'health_service_buildings.name_of_health_service_building AS name')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->where('buildings.model_id', '=', '?')
                    ->orderBy('health_service_buildings.name_of_health_service_building')
                    ->setBindings([$model])
                    ->get();
        return $query;
    }

    public function info($id){
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building', 
                                'building_gallery.photo_url')
                    ->leftJoin('building_gallery', 'health_service_buildings.health_service_building_id', 
                            '=', 'building_gallery.building_id')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->where('health_service_buildings.health_service_building_id', '=', '?')
                    ->orderBy('building_gallery.upload_date', 'DESC')
                    ->limit(1)
                    ->setBindings([$id])
                    ->get();
        return $query;
    }

    public function detail($id){
        $query = DB::table('health_service_buildings')
                    ->addSelect('health_service_buildings.*', 'name_of_health_service_building','building_area', 'land_area',
                                'parking_area', 'standing_year', 'electricity_capacity', 
                                'name_of_model', 'address', 'type_of_health_service_building.name_of_type AS jenis', 
                                'type_of_construction.name_of_type AS constr')
                    ->leftJoin('type_of_health_service_building', 'health_service_buildings.type_of_health_service_building', '=', 'type_of_health_service_building.type_id')
                    ->leftJoin('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->leftJoin('type_of_construction', 'buildings.type_of_construction', '=', 'type_of_construction.type_id')
                    ->leftJoin('building_model', 'buildings.model_id', '=', 'building_model.model_id')
                    ->where('health_service_buildings.health_service_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql = $query->get();

        $query2 = DB::table('building_gallery')
                    ->Select('photo_url', 'upload_date')
                    ->where('building_id', '=', '?')
                    ->setBindings([$id]);
        $sql2 = $query2->get();

        $query3 = DB::table('detail_health_service_building_facilities')
                    ->Select('name_of_facility', 'quantity_of_facilities')
                    ->join('health_service_building_facilities', 
                                'detail_health_service_building_facilities.facility_id', '=', 
                                    'health_service_building_facilities.facility_id')
                    ->where('detail_health_service_building_facilities.health_service_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql3 = $query3->get();

        return view('popup.view', ['type'=>'health', 'info' => $sql, 'photo' => $sql2, 'fasilitas' => $sql3]);
        //return $sql;
    }
}
