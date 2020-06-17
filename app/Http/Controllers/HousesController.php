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
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_AsGeoJSON(buildings.geom) AS geometry"))
                    ->addSelect('house_buildings.house_building_id')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id');
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

    public function cari_id($id){
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 'house_buildings.house_building_id AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->orWhere('house_buildings.house_building_id', 'ilike', array("%".$id."%"))
                    ->get();
        return $query;
    }

    public function cari_model($model){
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 'house_buildings.house_building_id AS name')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->where('buildings.model_id', '=', '?')
                    ->orderBy('house_buildings.house_building_id')
                    ->setBindings([$model])
                    ->get();
        return $query;
    }

    public function info($id){
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 'building_gallery.photo_url')
                    ->leftJoin('building_gallery', 'house_buildings.house_building_id', 
                            '=', 'building_gallery.building_id')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->where('house_buildings.house_building_id', '=', '?')
                    ->orderBy('building_gallery.upload_date', 'DESC')
                    ->limit(1)
                    ->setBindings([$id])
                    ->get();
        return $query;
    }

    public function cari_namapemilik($nama){
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 
                                'citizen.name AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->join('citizen', 'house_buildings.owner_id', '=', 'citizen.national_identity_number')
                    ->orWhere('citizen.name', 'ilike', array("%".$nama."%"))
                    ->get();
        return $query;
    }

    public function cari_nikpemilik($nik){
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 
                                'house_buildings.owner_id AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->orWhere('house_buildings.owner_id', 'ilike', array("%".$nik."%"))
                    ->get();
        return $query;
    }

    public function cari_namapenghuni($nama){
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 
                                'citizen.name AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->join('family_card', 'house_buildings.house_building_id', '=', 'family_card.house_building_id')
                    ->join('citizen', 'family_card.family_card_number', '=', 'citizen.family_card_number')
                    ->orWhere('citizen.name', 'ilike', array("%".$nama."%"))
                    ->get();
        return $query;
    }

    public function cari_nikpenghuni($nik){
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 
                                'citizen.national_identity_number AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->join('family_card', 'house_buildings.house_building_id', '=', 'family_card.house_building_id')
                    ->join('citizen', 'family_card.family_card_number', '=', 'citizen.family_card_number')
                    ->orWhere('citizen.national_identity_number', 'ilike', array("%".$nik."%"))
                    ->get();
        return $query;
    }

    public function cari_kkpenghuni($kk){
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 
                                'family_card.family_card_number AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->join('family_card', 'house_buildings.house_building_id', '=', 'family_card.house_building_id')
                    ->orWhere('family_card.family_card_number', 'ilike', array("%".$kk."%"))
                    ->get();
        return $query;
    }

    public function cari_sukupenghuni($suku){
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 
                                'house_buildings.house_building_id AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->join('citizen', 'house_buildings.owner_id', '=', 'citizen.national_identity_number')
                    ->join('datuk', 'citizen.datuk_id', '=', 'datuk.datuk_id')
                    ->join('tribe', 'datuk.tribe_id', '=', 'tribe.tribe_id')
                    ->orWhere('tribe.tribe_id', '=', array($suku))
                    ->get();
        return $query;
    }

    public function cari_konstruksi($k){
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 
                                'house_buildings.house_building_id AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->orWhere('buildings.type_of_construction', '=', array($k))
                    ->get();
        return $query;
    }

    public function cari_tahun($tahun){
        $tahun2 = explode(",", $tahun);
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 
                                'house_buildings.house_building_id AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->whereBetween('standing_year', $tahun2)
                    ->get();
        return $query;
    }

    public function cari_listrik($listrik){
        $listrik2 = explode(",", $listrik);
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude,
                                        coalesce(house_building_id) || 
                                        coalesce(' (') || 
                                        coalesce(electricity_capacity) || 
                                        coalesce('VA)') AS result
                                "))
                    ->addSelect('house_buildings.house_building_id')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->whereBetween('electricity_capacity', $listrik2)
                    ->get();
        return $query;
    }

    public function cari_status($s){
        $query = DB::table('house_buildings')
                    ->select(DB::raw("ST_X(ST_Centroid(buildings.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom)) AS latitude"))
                    ->addSelect('house_buildings.house_building_id', 
                                'house_buildings.house_building_id AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->orWhere('house_buildings.building_status', '=', array($s))
                    ->get();
        return $query;
    }
}
