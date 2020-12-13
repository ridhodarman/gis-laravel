<?php

namespace App\Http\Controllers;

use App\Worship_building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Worship_buildingsController extends Controller
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
     * @param  \App\Worship_building  $worship_building
     * @return \Illuminate\Http\Response
     */
    public function show(Worship_building $worship_building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Worship_building  $worship_building
     * @return \Illuminate\Http\Response
     */
    public function edit(Worship_building $worship_building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Worship_building  $worship_building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worship_building $worship_building)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worship_building  $worship_building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worship_building $worship_building)
    {
        //
    }

    public function digit(){
        $query = Worship_building::selectRaw("ST_AsGeoJSON(buildings.geom::geometry) AS geometry")
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id');
        $sql = $query->get();
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($sql as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geometry, true),
                'jenis' => "Worship Building",
                'properties' => array(
                    'id' => $data->worship_building_id,
                    'nama' => $data->name_of_worship_building
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

    public function semua(){
        $query = Worship_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_nama($nama){
        $query = Worship_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->orWhere('worship_buildings.name_of_worship_building', 'ilike', array("%".$nama."%"))  
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_jenis($jenis){
        $query = Worship_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->where('worship_buildings.type_of_worship', '=', '?')
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->setBindings([$jenis])
                    ->get();
        return $query;
    }

    public function cari_konstruksi($konstruksi){
        $query = Worship_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->where('buildings.type_of_construction', '=', '?')
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->setBindings([$konstruksi])
                    ->get();
        return $query;
    }

    public function cari_luasbang($luasbang){
        $luasbang2 = explode(",", $luasbang);
        $query = Worship_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->whereBetween('building_area', $luasbang2)
                    ->orderBy('name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_luasparkir($parkir){
        $luasparkir = explode(",", $parkir);
        $query = Worship_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                            ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->whereBetween('parking_area', $luasparkir)
                    ->orderBy('name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_tahun($tahun){
        $tahun2 = explode(",", $tahun);
        $query = Worship_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                            ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->whereBetween('standing_year', $tahun2)
                    ->orderBy('name_of_worship_building')
                    ->get();
        return $query;
    }

    public function cari_radius($lat, $lng, $rad){
        $lat = (double) $lat;
        $lng = (double) $lng;
        $query = Worship_building::selectRaw("ST_X(ST_CENTROID(buildings.geom::geometry)) AS longitude, 
                                    ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude,
                                    ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1), buildings.geom::geometry) AS jarak")
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->whereRaw("ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1),geom::geometry) <= ?")
                    ->orderByRaw('jarak')
                    ->setBindings([$rad])
                    ->get();
        return $query;
    }
    
    public function cari_jorong($jorong){
        $query = DB::table(DB::raw('worship_buildings AS W, jorongs AS J, buildings AS B')) 
                    ->selectRaw("ST_X(ST_Centroid(B.geom::geometry)) AS longitude, 
                                    ST_Y(ST_CENTROID(B.geom::geometry)) AS latitude, 
                                    W.worship_building_id, W.name_of_worship_building")
                    ->whereRaw("ST_CONTAINS(J.geom::geometry, B.geom::geometry) 
                                AND J.jorong_id = ? 
                                AND B.building_id=W.worship_building_id")
                    ->orderByRaw('W.name_of_worship_building')
                    ->setBindings([$jorong])
                    ->get();
        return $query;
    }

    public function cari_fasilitas($fas){
        $fasilitas = explode(",", $fas); 
        $total = count($fasilitas);
        $query = Worship_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building',)
                    ->join('detail_worship_building_facilities', 
                            'worship_buildings.worship_building_id', 
                            '=', 'detail_worship_building_facilities.worshipb_id')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->whereIn('detail_worship_building_facilities.worship_building_facilities', $fasilitas)
                    ->groupBy('detail_worship_building_facilities.worshipb_id',
                                'worship_buildings.worship_building_id',
                                'detail_worship_building_facilities.worshipb_id',
                                'buildings.building_id'
                    )
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->havingRaw('COUNT(*) = '. $total)
                    ->get();
        return $query;
    }

    public function cari_model($model){
        $query = Worship_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('worship_buildings.worship_building_id AS id', 'worship_buildings.name_of_worship_building AS name')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->where('buildings.building_model', '=', '?')
                    ->orderBy('worship_buildings.name_of_worship_building')
                    ->setBindings([$model])
                    ->get();
        return $query;
    }

    public function info($id){
        $query = Worship_building::selectRaw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude")
                    ->addSelect('worship_buildings.worship_building_id', 'worship_buildings.name_of_worship_building', 
                                'building_galleries.photo_url')
                    ->leftJoin('building_galleries', 'worship_buildings.worship_building_id', 
                            '=', 'building_galleries.building_id')
                    ->join('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->where('worship_buildings.worship_building_id', '=', '?')
                    ->orderBy('building_galleries.updated_at', 'DESC')
                    ->limit(1)
                    ->setBindings([$id])
                    ->get();
        return $query;
    }

    public function detail($id){
        $query = Worship_building::addSelect('worship_buildings.*', 'name_of_worship_building', 'building_area', 'land_area',
                                'parking_area', 'standing_year', 'electricity_capacity', 
                                'name_of_model', 'address', 'type_of_worships.name_of_type AS jenis', 
                                'type_of_constructions.name_of_type AS constr')
                    ->leftJoin('type_of_worships', 'worship_buildings.type_of_worship', '=', 'type_of_worships.id')
                    ->leftJoin('buildings', 'worship_buildings.worship_building_id', '=', 'buildings.building_id')
                    ->leftJoin('type_of_constructions', 'buildings.type_of_construction', '=', 'type_of_constructions.id')
                    ->leftJoin('building_models', 'buildings.building_model', '=', 'building_models.id')
                    ->where('worship_buildings.worship_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql = $query->get();

        $query2 = DB::table('building_galleries')
                    ->Select('photo_url', 'updated_at')
                    ->where('building_id', '=', '?')
                    ->setBindings([$id]);
        $sql2 = $query2->get();

        $query3 = DB::table('detail_worship_building_facilities')
                    ->Select('name_of_facility', 'quantity_of_facilities')
                    ->join('worship_building_facilities', 
                                'detail_worship_building_facilities.worship_building_facilities', '=', 
                                    'worship_building_facilities.id')
                    ->where('detail_worship_building_facilities.worshipb_id', '=', '?')
                    ->setBindings([$id]);
        $sql3 = $query3->get();

        return view('popup.view', ['type'=>'worship', 'info' => $sql, 'photo' => $sql2, 'fasilitas' => $sql3]);
    }
    
}
