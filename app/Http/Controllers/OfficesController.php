<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\office;
use Illuminate\Http\Request;

class officesController extends Controller
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
     * @param  \App\office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, office $office)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(office $office)
    {
        //
    }

    public function digit(){
        $query = DB::table('office_building')
                    ->select(DB::raw("ST_AsGeoJSON(building.geom) AS geometry"))
                    ->addSelect('office_building_id', 'name_of_office_building')
                    ->join('building', 'office_building.office_building_id', '=', 'building.building_id');
        $sql = $query->get();
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        foreach ($sql as $data) {
            $feature = array(
                "type" => 'Feature',
                'geometry' => json_decode($data->geometry, true),
                'jenis' => "office Building",
                'properties' => array(
                    'id' => $data->office_building_id,
                    'nama' => $data->name_of_office_building
                )
            );
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

    public function semua(){
        $query = DB::table('office_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('office_building.office_building_id', 'office_building.name_of_office_building')
                    ->join('building', 'office_building.office_building_id', '=', 'building.building_id')
                    ->orderBy('office_building.name_of_office_building')
                    ->get();
        return $query;
    }

    public function cari_nama($nama){
        $nama2 = strtolower($nama);
        $query = DB::table('office_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('office_building.office_building_id', 'office_building.name_of_office_building')
                    ->join('building', 'office_building.office_building_id', '=', 'building.building_id')
                    ->whereRaw('LOWER(office_building.name_of_office_building) LIKE (?)',array("%{$nama2}%"))  
                    ->orderBy('office_building.name_of_office_building')
                    ->get();
        return $query;
    }

    public function cari_jenis($jenis){
        $query = DB::table('office_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('office_building.office_building_id', 'office_building.name_of_office_building')
                    ->join('building', 'office_building.office_building_id', '=', 'building.building_id')
                    ->where('office_building.type_of_office', '=', '?')
                    ->orderBy('office_building.name_of_office_building')
                    ->setBindings([$jenis])
                    ->get();
        return $query;
    }

    public function cari_konstruksi($konstruksi){
        $query = DB::table('office_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('office_building.office_building_id', 'office_building.name_of_office_building')
                    ->join('building', 'office_building.office_building_id', '=', 'building.building_id')
                    ->where('office_building.type_of_construction', '=', '?')
                    ->orderBy('office_building.name_of_office_building')
                    ->setBindings([$konstruksi])
                    ->get();
        return $query;
    }

    public function cari_tahun($tahun){
        $tahun2 = explode(",", $tahun);
        $query = DB::table('office_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                            ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('office_building.office_building_id', 'office_building.name_of_office_building')
                    ->join('building', 'office_building.office_building_id', '=', 'building.building_id')
                    ->whereBetween('standing_year', $tahun2)
                    ->orderBy('name_of_office_building')
                    ->get();
        return $query;
    }

    public function cari_radius($rad){
        $r = explode(",", $rad);
        $lat = $r[0];
        $lng = $r[1];
        $radius = $r[2];
        $query = DB::table('office_building')
                    ->select(DB::raw("ST_X(ST_CENTROID(building.geom)) AS longitude, 
                                    ST_Y(ST_CENTROID(building.geom)) AS latitude,
                                    ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1), building.geom) AS jarak"))
                    ->addSelect('office_building.office_building_id', 'office_building.name_of_office_building')
                    ->join('building', 'office_building.office_building_id', '=', 'building.building_id')
                    ->whereRaw("ST_DISTANCE_SPHERE(ST_GeomFromText('POINT($lng $lat)',-1),geom) <= ?")
                    ->orderByRaw('jarak')
                    ->setBindings([$radius])
                    ->get();
        return $query;
    }
    
    public function cari_jorong($jorong){
        $query = DB::table(DB::raw('office_building AS W, jorong AS J, building AS B')) 
                    ->select(DB::raw("ST_X(ST_Centroid(B.geom)) AS longitude, 
                                      ST_Y(ST_CENTROID(B.geom)) AS latitude, 
                                      W.office_building_id, W.name_of_office_building"))
                    ->whereRaw("ST_CONTAINS(J.geom, B.geom) 
                                AND J.jorong_id = ? 
                                AND B.building_id=W.office_building_id")
                    ->orderByRaw('W.name_of_office_building')
                    ->setBindings([$jorong])
                    ->get();
        return $query;
    }

    public function cari_fasilitas($fas){
        $fasilitas = explode(",", $fas); 
        $query = DB::table('office_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('office_building.office_building_id', 'office_building.name_of_office_building')
                    ->join('detail_office_building_facilities', 
                            'office_building.office_building_id', 
                            '=', 'detail_office_building_facilities.office_building_id')
                    ->join('building', 'office_building.office_building_id', '=', 'building.building_id')
                    ->whereIn('detail_office_building_facilities.facility_id', $fasilitas)
                    ->groupBy('detail_office_building_facilities.office_building_id',
                                'office_building.office_building_id',
                                'office_building.name_of_office_building',
                                'building.geom'
                    )
                    ->orderBy('office_building.name_of_office_building')
                    ->get();
        return $query;
    }

    public function info($id){
        $query = DB::table('office_building')
                    ->select(DB::raw("ST_X(ST_Centroid(building.geom)) AS longitude, 
                                        ST_Y(ST_CENTROID(building.geom)) AS latitude"))
                    ->addSelect('office_building.office_building_id', 'office_building.name_of_office_building', 
                                'building_gallery.photo_url')
                    ->leftJoin('building_gallery', 'office_building.office_building_id', 
                            '=', 'building_gallery.building_id')
                    ->join('building', 'office_building.office_building_id', '=', 'building.building_id')
                    ->where('office_building.office_building_id', '=', '?')
                    ->orderBy('building_gallery.upload_date', 'DESC')
                    ->limit(1)
                    ->setBindings([$id])
                    ->get();
        return $query;
    }

    public function detail($id){
        $query = DB::table('office_building')
                    ->addSelect('office_building.*', 'name_of_office_building','building_area', 'land_area',
                                'parking_area', 'standing_year', 'electricity_capacity', 
                                'name_of_model', 'address', 'type_of_office.name_of_type AS jenis', 
                                'type_of_construction.name_of_type AS constr')
                    ->leftJoin('type_of_office', 'office_building.type_of_office', '=', 'type_of_office.type_id')
                    ->leftJoin('building', 'office_building.office_building_id', '=', 'building.building_id')
                    ->leftJoin('type_of_construction', 'building.type_of_construction', '=', 'type_of_construction.type_id')
                    ->leftJoin('building_model', 'building.model_id', '=', 'building_model.model_id')
                    ->where('office_building.office_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql = $query->get();

        $query2 = DB::table('building_gallery')
                    ->Select('photo_url', 'upload_date')
                    ->where('building_id', '=', '?')
                    ->setBindings([$id]);
        $sql2 = $query2->get();

        $query3 = DB::table('detail_office_building_facilities')
                    ->Select('name_of_facility', 'quantity_of_facilities')
                    ->join('office_building_facilities', 
                                'detail_office_building_facilities.facility_id', '=', 
                                    'office_building_facilities.facility_id')
                    ->where('detail_office_building_facilities.office_building_id', '=', '?')
                    ->setBindings([$id]);
        $sql3 = $query3->get();

        return view('popup.view', ['type'=>'office', 'info' => $sql, 'photo' => $sql2, 'fasilitas' => $sql3]);
        //return $sql;
    }
}
