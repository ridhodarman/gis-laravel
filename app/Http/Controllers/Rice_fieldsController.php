<?php

namespace App\Http\Controllers;

use App\Rice_field;
use Illuminate\Http\Request;

class Rice_fieldsController extends Controller
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
     * @param  \App\Rice_field  $rice_field
     * @return \Illuminate\Http\Response
     */
    public function show(Rice_field $rice_field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rice_field  $rice_field
     * @return \Illuminate\Http\Response
     */
    public function edit(Rice_field $rice_field)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rice_field  $rice_field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rice_field $rice_field)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rice_field  $rice_field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rice_field $rice_field)
    {
        //
    }

    public function digit()
    {
        $query = Rice_field::selectRaw('ST_AsGeoJSON(rice_fields.geom::geometry) AS geom')
                        ->addSelect('id', 'information')->get();
        //return $query;
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($query as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geom,true),
                'jenis' => "Sawah",
                'properties' => array(
                    'id' => $data->id,
                    'nama' => $data->information
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }
}
