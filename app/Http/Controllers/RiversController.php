<?php

namespace App\Http\Controllers;

use App\River;
use Illuminate\Http\Request;

class RiversController extends Controller
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
     * @param  \App\River  $river
     * @return \Illuminate\Http\Response
     */
    public function show(River $river)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\River  $river
     * @return \Illuminate\Http\Response
     */
    public function edit(River $river)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\River  $river
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, River $river)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\River  $river
     * @return \Illuminate\Http\Response
     */
    public function destroy(River $river)
    {
        //
    }

    public function digit()
    {
        $query = River::selectRaw('ST_AsGeoJSON(rivers.geom::geometry) AS geom')
                        ->addSelect('id', 'river_name')->get();
        //return $query;
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($query as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geom,true),
                'jenis' => "Sungai",
                'properties' => array(
                    'id' => $data->id,
                    'nama' => $data->river_name
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

}
