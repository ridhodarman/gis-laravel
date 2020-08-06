<?php

namespace App\Http\Controllers;

use App\Health_service_building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Health_service_buildingsController extends Controller
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
     * @param  \App\Health_service_building  $health_service_building
     * @return \Illuminate\Http\Response
     */
    public function show(Health_service_building $health_service_building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Health_service_building  $health_service_building
     * @return \Illuminate\Http\Response
     */
    public function edit(Health_service_building $health_service_building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Health_service_building  $health_service_building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Health_service_building $health_service_building)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Health_service_building  $health_service_building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Health_service_building $health_service_building)
    {
        //
    }

    public function digit(){
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_AsGeoJSON(buildings.geom::geometry) AS geometry"))
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
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->orderBy('health_service_buildings.name_of_health_service_building')
                    ->get();
        return $query;
    }

    public function cari_nama($nama){
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->orWhere('health_service_buildings.name_of_health_service_building', 'ilike', array("%".$nama."%"))
                    ->orderBy('health_service_buildings.name_of_health_service_building')
                    ->get();
        return $query;
    }

    public function cari_jenis($jenis){
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->where('health_service_buildings.type_of_health_service', '=', '?')
                    ->orderBy('health_service_buildings.name_of_health_service_building')
                    ->setBindings([$jenis])
                    ->get();
        return $query;
    }

    public function cari_radius($lat, $lng, $rad){
        $lat = (double) $lat;
        $lng = (double) $lng;
        $query = DB::table('health_service_buildings')
                    ->select(DB::raw("ST_X(ST_CENTROID(buildings.geom::geometry)) AS longitude, 
                                    ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude,
                                    ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1), buildings.geom::geometry) AS jarak"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->whereRaw("ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1),geom::geometry) <= ?")
                    ->orderByRaw('jarak')
                    ->setBindings([$rad])
                    ->get();
        return $query;
    }
    
    public function cari_jorong($jorong){
        $query = DB::table(DB::raw('health_service_buildings AS W, jorongs AS J, buildings AS B')) 
                    ->select(DB::raw("ST_X(ST_Centroid(B.geom::geometry)) AS longitude, 
                                    ST_Y(ST_CENTROID(B.geom::geometry)) AS latitude, 
                                    W.health_service_building_id, W.name_of_health_service_building"))
                    ->whereRaw("ST_CONTAINS(J.geom::geometry, B.geom::geometry) 
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
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building')
                    ->join('detail_health_service_building_facilities', 
                            'health_service_buildings.health_service_building_id', 
                            '=', 'detail_health_service_building_facilities.healthb_id')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->whereIn('detail_health_service_building_facilities.health_service_building_facilities', $fasilitas)
                    ->groupBy('detail_health_service_building_facilities.healthb_id',
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
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
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
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('health_service_buildings.health_service_building_id', 'health_service_buildings.name_of_health_service_building', 
                                'building_galleries.photo_url')
                    ->leftJoin('building_galleries', 'health_service_buildings.health_service_building_id', 
                            '=', 'building_galleries.building_id')
                    ->join('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->where('health_service_buildings.health_service_building_id', '=', '?')
                    ->orderBy('building_galleries.updated_at', 'DESC')
                    ->limit(1)
                    ->setBindings([$id])
                    ->get();
        return $query;
    }

    public function detail($id){
        $query = DB::table('health_service_buildings')
                    ->addSelect('health_service_buildings.*', 'name_of_health_service_building','building_area', 'land_area',
                                'parking_area', 'standing_year', 'electricity_capacity', 
                                'name_of_model', 'address', 'type_of_health_services.name_of_type AS jenis', 
                                'type_of_constructions.name_of_type AS constr')
                    ->leftJoin('type_of_health_services', 'health_service_buildings.type_of_health_service', '=', 'type_of_health_services.id')
                    ->leftJoin('buildings', 'health_service_buildings.health_service_building_id', '=', 'buildings.building_id')
                    ->leftJoin('type_of_constructions', 'buildings.type_of_construction', '=', 'type_of_constructions.id')
                    ->leftJoin('building_models', 'buildings.building_model', '=', 'building_models.id')
                    ->where('health_service_buildings.health_service_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql = $query->get();

        $query2 = DB::table('building_galleries')
                    ->Select('photo_url', 'updated_at')
                    ->where('building_id', '=', '?')
                    ->setBindings([$id]);
        $sql2 = $query2->get();

        $query3 = DB::table('detail_health_service_building_facilities')
                    ->Select('name_of_facility', 'quantity_of_facilities')
                    ->join('health_service_building_facilities', 
                                'detail_health_service_building_facilities.health_service_building_facilities', '=', 
                                    'health_service_building_facilities.id')
                    ->where('detail_health_service_building_facilities.healthb_id', '=', '?')
                    ->setBindings([$id]);
        $sql3 = $query3->get();

        return view('popup.view', ['type'=>'health', 'info' => $sql, 'photo' => $sql2, 'fasilitas' => $sql3]);
        //return $sql;
    }
}
