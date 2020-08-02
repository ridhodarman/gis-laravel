<?php

namespace App\Http\Controllers;

use App\Msme_building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Building_gallery;
use App\detail_msme_building_facilities;

class Msme_buildingsController extends Controller
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
     * @param  \App\Msme_building  $msme_building
     * @return \Illuminate\Http\Response
     */
    public function show(Msme_building $msme_building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Msme_building  $msme_building
     * @return \Illuminate\Http\Response
     */
    public function edit(Msme_building $msme_building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Msme_building  $msme_building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Msme_building $msme_building)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Msme_building  $msme_building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Msme_building $msme_building)
    {
        //
    }

    public function digit(){
        $query = Msme_building::select(DB::raw("ST_AsGeoJSON(buildings.geom::geometry) AS geom"))
                    ->addSelect('msme_building_id', 'name_of_msme_building')
                    ->join('buildings', 'msme_buildings.msme_building_id', '=', 'buildings.building_id');
        $sql = $query->get();
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($sql as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geom, true),
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

    public function semua(){
        $query = Msme_building::select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('msme_buildings.msme_building_id', 'msme_buildings.name_of_msme_building')
                    ->join('buildings', 'msme_buildings.msme_building_id', '=', 'buildings.building_id')
                    ->orderBy('msme_buildings.name_of_msme_building')
                    ->get();
        return $query;
    }

    public function cari_nama($nama){
        $query = Msme_building::select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('msme_buildings.msme_building_id', 'msme_buildings.name_of_msme_building')
                    ->join('buildings', 'msme_buildings.msme_building_id', '=', 'buildings.building_id')
                    ->orWhere('msme_buildings.name_of_msme_building', 'ilike', array("%".$nama."%"))
                    ->orderBy('msme_buildings.name_of_msme_building')
                    ->get();
        return $query;
    }

    public function cari_jenis($jenis){
        $query = Msme_building::select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('msme_buildings.msme_building_id', 'msme_buildings.name_of_msme_building')
                    ->join('buildings', 'msme_buildings.msme_building_id', '=', 'buildings.building_id')
                    ->where('msme_buildings.type_of_msme', '=', '?')
                    ->orderBy('msme_buildings.name_of_msme_building')
                    ->setBindings([$jenis])
                    ->get();
        return $query;
    }

    public function cari_radius($lat, $lng, $rad){
        $lat = (double) $lat;
        $lng = (double) $lng;
        $query = Msme_building::select(DB::raw("ST_X(ST_CENTROID(buildings.geom::geometry)) AS longitude, 
                                    ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude,
                                    ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1), buildings.geom::geometry) AS jarak"))
                    ->addSelect('msme_buildings.msme_building_id', 'msme_buildings.name_of_msme_building')
                    ->join('buildings', 'msme_buildings.msme_building_id', '=', 'buildings.building_id')
                    ->whereRaw("ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1),geom::geometry) <= ?")
                    ->orderByRaw('jarak')
                    ->setBindings([$rad])
                    ->get();
        return $query;
    }

    public function cari_fasilitas($fas){
        $fasilitas = explode(",", $fas); 
        $total = count($fasilitas);
        $query = Msme_building::select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('msme_buildings.msme_building_id', 'msme_buildings.name_of_msme_building')
                    ->join('detail_msme_building_facilities', 
                            'msme_buildings.msme_building_id', 
                            '=', 'detail_msme_building_facilities.msmeb_id')
                    ->join('buildings', 'msme_buildings.msme_building_id', '=', 'buildings.building_id')
                    ->whereIn('detail_msme_building_facilities.msme_building_facilities', $fasilitas)
                    ->groupBy('detail_msme_building_facilities.msmeb_id',
                                'msme_buildings.msme_building_id',
                                'msme_buildings.name_of_msme_building',
                                'buildings.geom'
                    )
                    ->havingRaw('COUNT(*) = '. $total)
                    ->orderBy('msme_buildings.name_of_msme_building')
                    ->get();
        return $query;
    }

    public function cari_model($model){
        $query = Msme_building::select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('msme_buildings.msme_building_id AS id', 'msme_buildings.name_of_msme_building AS name')
                    ->join('buildings', 'msme_buildings.msme_building_id', '=', 'buildings.building_id')
                    ->where('buildings.building_model', '=', '?')
                    ->orderBy('msme_buildings.name_of_msme_building')
                    ->setBindings([$model])
                    ->get();
        return $query;
    }

    public function info($id){
        $query = Msme_building::select(DB::raw("ST_X(ST_Centroid(buildings.geom::geometry)) AS longitude, 
                                        ST_Y(ST_CENTROID(buildings.geom::geometry)) AS latitude"))
                    ->addSelect('msme_buildings.msme_building_id', 'msme_buildings.name_of_msme_building', 
                                'building_gallerys.photo_url')
                    ->leftJoin('building_gallerys', 'msme_buildings.msme_building_id', 
                            '=', 'building_gallerys.building_id')
                    ->join('buildings', 'msme_buildings.msme_building_id', '=', 'buildings.building_id')
                    ->where('msme_buildings.msme_building_id', '=', '?')
                    ->orderBy('building_gallerys.updated_at', 'DESC')
                    ->limit(1)
                    ->setBindings([$id])
                    ->get();
        return $query;
    }
    
    public function cari_jorong($jorong){
        $query = DB::table(DB::raw('msme_buildings AS W, jorongs AS J, buildings AS B')) 
                    ->select(DB::raw("ST_X(ST_Centroid(B.geom::geometry)) AS longitude, 
                                    ST_Y(ST_CENTROID(B.geom::geometry)) AS latitude, 
                                    W.msme_building_id, W.name_of_msme_building"))
                    ->whereRaw("ST_CONTAINS(J.geom::geometry, B.geom::geometry) 
                                AND J.jorong_id = ? 
                                AND B.building_id=W.msme_building_id")
                    ->orderByRaw('W.name_of_msme_building')
                    ->setBindings([$jorong])
                    ->get();
        return $query;
    }

    public function detail($id){
        $query = Msme_building::Select('msme_buildings.*', 'name_of_msme_building', 'owner_name', 'contact_person',
                                'building_area', 'land_area',
                                'parking_area', 'standing_year', 'electricity_capacity', 
                                'name_of_model', 'address', 'type_of_msmes.name_of_type AS jenis', 
                                'type_of_constructions.name_of_type AS constr')
                    ->leftJoin('type_of_msmes', 'msme_buildings.type_of_msme', '=', 'type_of_msmes.id')
                    ->leftJoin('buildings', 'msme_buildings.msme_building_id', '=', 'buildings.building_id')
                    ->leftJoin('type_of_constructions', 'buildings.type_of_construction', '=', 'type_of_constructions.id')
                    ->leftJoin('building_models', 'buildings.building_model', '=', 'building_models.id')
                    ->where('msme_buildings.msme_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql = $query->get();

        $query2 = Building_gallery::Select('photo_url', 'updated_at')
                    ->where('building_id', '=', '?')
                    ->setBindings([$id]);
        $sql2 = $query2->get();

        $query3 = detail_msme_building_facilities::Select('name_of_facility', 'quantity_of_facilities')
                    ->join('msme_building_facilities', 
                                'detail_msme_building_facilities.msme_building_facilities', '=', 
                                    'msme_building_facilities.id')
                    ->where('detail_msme_building_facilities.msmeb_id', '=', '?')
                    ->setBindings([$id]);
        $sql3 = $query3->get();

        return view('popup.view', ['type'=>'msme', 'info' => $sql, 'photo' => $sql2, 'fasilitas' => $sql3]);
        //return $sql;
    }
}
