<?php

namespace App\Http\Controllers;

use App\Nagari;
use Illuminate\Http\Request;
use DB;

class NagarisController extends Controller
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
     * @param  \App\Nagari  $nagari
     * @return \Illuminate\Http\Response
     */
    public function show(Nagari $nagari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nagari  $nagari
     * @return \Illuminate\Http\Response
     */
    public function edit(Nagari $nagari)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nagari  $nagari
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nagari $nagari)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nagari  $nagari
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nagari $nagari)
    {
        //
    }

    public function digit(){
        // $query = DB::select(DB::raw("
        //                     SELECT row_to_json(fc) 
        //                     FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features 
        //                     FROM (SELECT 'Feature' As type , ST_AsGeoJSON(nagaris.geom, 4326)::json As geometry , row_to_json((SELECT l 
        //                     FROM (SELECT nagaris.name_of_nagari, nagaris.nagari_id as gid, 
        //                         ST_X(ST_Centroid(nagaris.geom::geometry)) AS lon, 
        //                         ST_Y(ST_CENTROID(nagaris.geom::geometry)) As lat) As l )) As properties 
        //                     FROM nagaris As nagaris  
        //                     ) As f ) As fc
        //                     ")
        //                 )->first();
        $query = Nagari::selectRaw('ST_AsGeoJSON(nagaris.geom::geometry) AS geom')
                        ->addSelect('nagari_id', 'name_of_nagari')->get();
        //return $query;
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($query as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geom,true),
                'jenis' => "nagari",
                'properties' => array(
                    'id' => $data->nagari_id,
                    'nama' => $data->name_of_nagari
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }
}
