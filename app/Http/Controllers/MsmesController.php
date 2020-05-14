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

    public function semua(){
        $query = DB::table('msme_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('msme_building.msme_building_id', 'msme_building.name_of_msme_building')
                    ->join('building', 'msme_building.msme_building_id', '=', 'building.building_id')
                    ->orderBy('msme_building.name_of_msme_building')
                    ->get();
        return $query;
    }

    public function cari_nama($nama){
        $nama2 = strtolower($nama);
        $query = DB::table('msme_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('msme_building.msme_building_id', 'msme_building.name_of_msme_building')
                    ->join('building', 'msme_building.msme_building_id', '=', 'building.building_id')
                    ->whereRaw('LOWER(msme_building.name_of_msme_building) LIKE (?)',array("%{$nama2}%"))  
                    ->orderBy('msme_building.name_of_msme_building')
                    ->get();
        return $query;
    }

    public function cari_jenis($jenis){
        $query = DB::table('msme_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('msme_building.msme_building_id', 'msme_building.name_of_msme_building')
                    ->join('building', 'msme_building.msme_building_id', '=', 'building.building_id')
                    ->where('msme_building.type_of_msme', '=', '?')
                    ->orderBy('msme_building.name_of_msme_building')
                    ->setBindings([$jenis])
                    ->get();
        return $query;
    }

    public function cari_konstruksi($konstruksi){
        $query = DB::table('msme_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('msme_building.msme_building_id', 'msme_building.name_of_msme_building')
                    ->join('building', 'msme_building.msme_building_id', '=', 'building.building_id')
                    ->where('msme_building.type_of_construction', '=', '?')
                    ->orderBy('msme_building.name_of_msme_building')
                    ->setBindings([$konstruksi])
                    ->get();
        return $query;
    }

    public function cari_radius($rad){
        $r = explode(",", $rad);
        $lat = $r[0];
        $lng = $r[1];
        $radius = $r[2];
        $query = DB::table('msme_building')
                    ->select(DB::raw("ST_X(ST_CENTROID(building.geom)) AS longitude, 
                                    ST_Y(ST_CENTROID(building.geom)) AS latitude,
                                    ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1), building.geom) AS jarak"))
                    ->addSelect('msme_building.msme_building_id', 'msme_building.name_of_msme_building')
                    ->join('building', 'msme_building.msme_building_id', '=', 'building.building_id')
                    ->whereRaw("ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1),geom) <= ?")
                    ->orderByRaw('jarak')
                    ->setBindings([$radius])
                    ->get();
        return $query;
    }
    
    public function cari_jorong($jorong){
        $query = DB::table(DB::raw('msme_building AS W, jorong AS J, building AS B')) 
                    ->select(DB::raw("ST_X(ST_Centroid(B.geom)) AS longitude, 
                                      ST_Y(ST_CENTROID(B.geom)) AS latitude, 
                                      W.msme_building_id, W.name_of_msme_building"))
                    ->whereRaw("ST_CONTAINS(J.geom, B.geom) 
                                AND J.jorong_id = ? 
                                AND B.building_id=W.msme_building_id")
                    ->orderByRaw('W.name_of_msme_building')
                    ->setBindings([$jorong])
                    ->get();
        return $query;
    }

    public function cari_fasilitas($fas){
        $fasilitas = explode(",", $fas); 
        $query = DB::table('msme_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('msme_building.msme_building_id', 'msme_building.name_of_msme_building')
                    ->join('detail_msme_building_facilities', 
                            'msme_building.msme_building_id', 
                            '=', 'detail_msme_building_facilities.msme_building_id')
                    ->join('building', 'msme_building.msme_building_id', '=', 'building.building_id')
                    ->whereIn('detail_msme_building_facilities.facility_id', $fasilitas)
                    ->groupBy('detail_msme_building_facilities.msme_building_id',
                                'msme_building.msme_building_id',
                                'msme_building.name_of_msme_building',
                                'building.geom'
                    )
                    ->orderBy('msme_building.name_of_msme_building')
                    ->get();
        return $query;
    }

    public function info($id){
        $query = DB::table('msme_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('msme_building.msme_building_id', 'msme_building.name_of_msme_building', 
                                'building_gallery.photo_url')
                    ->leftJoin('building_gallery', 'msme_building.msme_building_id', 
                            '=', 'building_gallery.building_id')
                    ->join('building', 'msme_building.msme_building_id', '=', 'building.building_id')
                    ->where('msme_building.msme_building_id', '=', '?')
                    ->orderBy('building_gallery.upload_date', 'DESC')
                    ->limit(1)
                    ->setBindings([$id])
                    ->get();
        return $query;
    }

    public function detail($id){
        $query = DB::table('msme_building')
                    ->addSelect('msme_building.*', 'name_of_msme_building', 'owner_name', 'contact_person',
                                'building_area', 'land_area',
                                'parking_area', 'standing_year', 'electricity_capacity', 
                                'name_of_model', 'address', 'type_of_msme.name_of_type AS jenis', 
                                'type_of_construction.name_of_type AS constr')
                    ->leftJoin('type_of_msme', 'msme_building.type_of_msme', '=', 'type_of_msme.type_id')
                    ->leftJoin('building', 'msme_building.msme_building_id', '=', 'building.building_id')
                    ->leftJoin('type_of_construction', 'building.type_of_construction', '=', 'type_of_construction.type_id')
                    ->leftJoin('building_model', 'building.model_id', '=', 'building_model.model_id')
                    ->where('msme_building.msme_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql = $query->get();

        $query2 = DB::table('building_gallery')
                    ->Select('photo_url', 'upload_date')
                    ->where('building_id', '=', '?')
                    ->setBindings([$id]);
        $sql2 = $query2->get();

        $query3 = DB::table('detail_msme_building_facilities')
                    ->Select('name_of_facility', 'quantity_of_facilities')
                    ->join('msme_building_facilities', 
                                'detail_msme_building_facilities.facility_id', '=', 
                                    'msme_building_facilities.facility_id')
                    ->where('detail_msme_building_facilities.msme_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql3 = $query3->get();

        return view('popup.view', ['type'=>'msme', 'info' => $sql, 'photo' => $sql2, 'fasilitas' => $sql3]);
        //return $sql;
    }
}
