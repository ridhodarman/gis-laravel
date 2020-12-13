<?php

namespace App\Http\Controllers;

use App\House_building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class House_buildingsController extends Controller
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
        $query = House_building::selectRaw("ST_AsGeoJSON(buildings.geom::geometry) AS geometry")
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
                'jenis' => "House/residence",
                'properties' => array(
                    'id' => $data->house_building_id
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

    public function cari_id($id){
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('house_buildings.house_building_id', 'house_buildings.house_building_id AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->orWhere('house_buildings.house_building_id', 'ilike', array("%".$id."%"))
                    ->get();
        return $query;
    }

    public function cari_model($model){
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('house_buildings.house_building_id AS id', 'house_buildings.house_building_id AS name')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->where('buildings.building_model', '=', '?')
                    ->orderBy('house_buildings.house_building_id')
                    ->setBindings([$model])
                    ->get();
        return $query;
    }

    public function info($id){
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('house_buildings.house_building_id', 'building_galleries.photo_url')
                    ->leftJoin('building_galleries', 'house_buildings.house_building_id', 
                            '=', 'building_galleries.building_id')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->where('house_buildings.house_building_id', '=', '?')
                    ->orderBy('building_galleries.updated_at', 'DESC')
                    ->limit(1)
                    ->setBindings([$id])
                    ->get();
        return $query;
    }

    public function cari_namapemilik($nama){
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('house_buildings.house_building_id', 
                                'citizen.name AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->join('citizen', 'house_buildings.owner_id', '=', 'citizen.national_identity_number')
                    ->orWhere('citizen.name', 'ilike', array("%".$nama."%"))
                    ->get();
        return $query;
    }

    public function cari_nikpemilik($nik){
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('house_buildings.house_building_id', 
                                'house_buildings.owner_id AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->orWhere('house_buildings.owner_id', 'ilike', array("%".$nik."%"))
                    ->get();
        return $query;
    }

    public function cari_namapenghuni($nama){
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
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
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
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
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('house_buildings.house_building_id', 
                                'family_card.family_card_number AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->join('family_card', 'house_buildings.house_building_id', '=', 'family_card.house_building_id')
                    ->orWhere('family_card.family_card_number', 'ilike', array("%".$kk."%"))
                    ->get();
        return $query;
    }

    public function cari_sukupenghuni($suku){
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
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
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('house_buildings.house_building_id', 
                                'house_buildings.house_building_id AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->orWhere('buildings.type_of_construction', '=', array($k))
                    ->get();
        return $query;
    }

    public function cari_tahun($tahun){
        $tahun2 = explode(",", $tahun);
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('house_buildings.house_building_id', 
                                'house_buildings.house_building_id AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->whereBetween('standing_year', $tahun2)
                    ->get();
        return $query;
    }

    public function cari_listrik($listrik){
        $listrik2 = explode(",", $listrik);
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude,
                                        coalesce(house_building_id) || 
                                        coalesce(' (') || 
                                        coalesce(electricity_capacity) || 
                                        coalesce('VA)') AS result
                                ")
                    ->addSelect('house_buildings.house_building_id')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->whereBetween('electricity_capacity', $listrik2)
                    ->get();
        return $query;
    }

    public function cari_status($s){
        $query = House_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('house_buildings.house_building_id', 
                                'house_buildings.house_building_id AS result')
                    ->join('buildings', 'house_buildings.house_building_id', '=', 'buildings.building_id')
                    ->orWhere('house_buildings.building_status', '=', array($s))
                    ->get();
        return $query;
    }
}
