<?php

namespace App\Http\Controllers;

use App\Office_building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Office_buildingsController extends Controller
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
     * @param  \App\Office_building  $office_building
     * @return \Illuminate\Http\Response
     */
    public function show(Office_building $office_building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Office_building  $office_building
     * @return \Illuminate\Http\Response
     */
    public function edit(Office_building $office_building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Office_building  $office_building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office_building $office_building)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Office_building  $office_building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office_building $office_building)
    {
        //
    }

    public function digit(){
        $query = Office_building::selectRaw("ST_AsGeoJSON(buildings.geom::geometry) AS geometry")
                    ->addSelect('office_building_id', 'name_of_office_building')
                    ->join('buildings', 'office_buildings.office_building_id', '=', 'buildings.building_id');
        $sql = $query->get();
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($sql as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geometry, true),
                'jenis' => "Office Building",
                'properties' => array(
                    'id' => $data->office_building_id,
                    'nama' => $data->name_of_office_building
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

    public function semua(){
        $query = Office_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('office_buildings.office_building_id', 'office_buildings.name_of_office_building')
                    ->join('buildings', 'office_buildings.office_building_id', '=', 'buildings.building_id')
                    ->orderBy('office_buildings.name_of_office_building')
                    ->get();
        return $query;
    }

    public function cari_nama($nama){
        $query = Office_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('office_buildings.office_building_id', 'office_buildings.name_of_office_building')
                    ->join('buildings', 'office_buildings.office_building_id', '=', 'buildings.building_id')
                    ->orWhere('office_buildings.name_of_office_building', 'ilike', array("%".$nama."%"))
                    ->orderBy('office_buildings.name_of_office_building')
                    ->get();
        return $query;
    }

    public function cari_jenis($jenis){
        $query = Office_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('office_buildings.office_building_id', 'office_buildings.name_of_office_building')
                    ->join('buildings', 'office_buildings.office_building_id', '=', 'buildings.building_id')
                    ->where('office_buildings.type_of_office', '=', '?')
                    ->orderBy('office_buildings.name_of_office_building')
                    ->setBindings([$jenis])
                    ->get();
        return $query;
    }

    public function cari_tahun($tahun){
        $tahun2 = explode(",", $tahun);
        $query = Office_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                            ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('office_buildings.office_building_id', 'office_buildings.name_of_office_building')
                    ->join('buildings', 'office_buildings.office_building_id', '=', 'buildings.building_id')
                    ->whereBetween('standing_year', $tahun2)
                    ->orderBy('name_of_office_building')
                    ->get();
        return $query;
    }

    public function cari_model($model){
        $query = Office_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('office_buildings.office_building_id AS id', 'office_buildings.name_of_office_building AS name')
                    ->join('buildings', 'office_buildings.office_building_id', '=', 'buildings.building_id')
                    ->where('buildings.building_model', '=', '?')
                    ->orderBy('office_buildings.name_of_office_building')
                    ->setBindings([$model])
                    ->get();
        return $query;
    }

    public function info($id){
        $query = Office_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('office_buildings.office_building_id', 'office_buildings.name_of_office_building', 
                                'building_galleries.photo_url')
                    ->leftJoin('building_galleries', 'office_buildings.office_building_id', 
                            '=', 'building_galleries.building_id')
                    ->join('buildings', 'office_buildings.office_building_id', '=', 'buildings.building_id')
                    ->where('office_buildings.office_building_id', '=', '?')
                    ->orderBy('building_galleries.updated_at', 'DESC')
                    ->limit(1)
                    ->setBindings([$id])
                    ->get();
        return $query;
    }

    public function detail($id){
        $query = Office_building::addSelect('office_buildings.*', 'name_of_office_building','building_area', 'land_area',
                                'parking_area', 'standing_year', 'electricity_capacity', 
                                'name_of_model', 'address', 'type_of_offices.name_of_type AS jenis', 
                                'type_of_constructions.name_of_type AS constr')
                    ->leftJoin('type_of_offices', 'office_buildings.type_of_office', '=', 'type_of_offices.id')
                    ->leftJoin('buildings', 'office_buildings.office_building_id', '=', 'buildings.building_id')
                    ->leftJoin('type_of_constructions', 'buildings.type_of_construction', '=', 'type_of_constructions.id')
                    ->leftJoin('building_models', 'buildings.building_model', '=', 'building_models.id')
                    ->where('office_buildings.office_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql = $query->get();

        $query2 = DB::table('building_galleries')
                    ->Select('photo_url', 'updated_at')
                    ->where('building_id', '=', '?')
                    ->setBindings([$id]);
        $sql2 = $query2->get();

        $query3 = DB::table('detail_office_building_facilities')
                    ->Select('name_of_facility', 'quantity_of_facilities')
                    ->join('office_building_facilities', 
                                'detail_office_building_facilities.office_building_facilities', '=', 
                                    'office_building_facilities.id')
                    ->where('detail_office_building_facilities.officeb_id', '=', '?')
                    ->setBindings([$id]);
        $sql3 = $query3->get();

        return view('popup.view', ['type'=>'office', 'info' => $sql, 'photo' => $sql2, 'fasilitas' => $sql3]);
        //return $sql;
    }
}
