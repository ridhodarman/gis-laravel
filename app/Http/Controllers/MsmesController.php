<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Msmes;
use Illuminate\Http\Request;

class MsmesController extends Controller
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
     * @param  \App\Msmes  $msmes
     * @return \Illuminate\Http\Response
     */
    public function show(Msmes $msmes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Msmes  $msmes
     * @return \Illuminate\Http\Response
     */
    public function edit(Msmes $msmes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Msmes  $msmes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Msmes $msmes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Msmes  $msmes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Msmes $msmes)
    {
        //
    }

    public function digit(){
        $query = DB::table('msme_building')
                    ->select(DB::raw("ST_AsGeoJSON(building.geom) AS geometry"))
                    ->addSelect('msme_building_id', 'name_of_msme_building')
                    ->join('building', 'msme_building.msme_building_id', '=', 'building.building_id');
        $sql = $query->get();
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($sql as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geometry, true),
                'jenis' => "Micro, Small, Medium Enterprise Building",
                'properties' => array(
                    'id' => $data->msme_building_id,
                    'nama' => $data->name_of_msme_building
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }
}
