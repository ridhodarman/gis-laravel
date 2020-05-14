<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HousesController extends Controller
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
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        //
    }

    public function digit(){
        $query = DB::table('house_building')
                    ->select(DB::raw("ST_AsGeoJSON(building.geom) AS geometry"))
                    ->addSelect('house_building.house_building_id')
                    ->join('building', 'house_building.house_building_id', '=', 'building.building_id');
        $sql = $query->get();
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($sql as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geometry, true),
                'jenis' => "House",
                'properties' => array(
                    'id' => $data->house_building_id
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

    public function cari_model($model){
        $query = DB::table('house_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('house_building.house_building_id AS id', 'house_building.house_building_id AS name')
                    ->join('building', 'house_building.house_building_id', '=', 'building.building_id')
                    ->where('building.model_id', '=', '?')
                    ->orderBy('house_building.house_building_id')
                    ->setBindings([$model])
                    ->get();
        return $query;
    }
}
