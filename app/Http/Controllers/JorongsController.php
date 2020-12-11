<?php

namespace App\Http\Controllers;

use App\Jorong;
use Illuminate\Http\Request;

class JorongsController extends Controller
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
     * @param  \App\Jorong  $jorong
     * @return \Illuminate\Http\Response
     */
    public function show(Jorong $jorong)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jorong  $jorong
     * @return \Illuminate\Http\Response
     */
    public function edit(Jorong $jorong)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jorong  $jorong
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jorong $jorong)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jorong  $jorong
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jorong $jorong)
    {
        //
    }

    public function digit(){
        //$query = Jorong::Select('ST_AsGeoJSON(jorongs.geom::geometry) AS geom', 
        $query = Jorong::selectRaw('ST_AsGeoJSON(jorongs.geom::geometry) AS geom')
                        ->addSelect('jorong_id', 'name_of_jorong')->get();
        //return $query;
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($query as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => $data->geom,
                'jenis' => "Jorong",
                'properties' => array(
                    'id' => $data->jorong_id,
                    'nama' => $data->name_of_jorong
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }
}
