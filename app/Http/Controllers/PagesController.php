<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building_model;
use App\Type_of_construction;
use App\Jorong;
use App\Type_of_msme;
use App\msme_building_facilities;
use App\Type_of_worship;
use App\worship_building_facilities;
use App\Type_of_office;
use App\Level_of_education;
use App\Type_of_health_service;
use App\health_service_building_facilities;
use App\Worship_building;
use App\House_building;
use App\Office_building;
use App\Educational_building;
use App\Health_service_building;
use App\Msme_building;
use App\Tribe;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $building_model = Building_model::select('id','name_of_model')->orderBy('name_of_model')->get();
        $type_of_construction = Type_of_construction::select('id','name_of_type')->orderBy('name_of_type')->get();
        $jorong = Jorong::select('jorong_id','name_of_jorong')->orderBy('name_of_jorong')->get();
        $type_of_msme = Type_of_msme::select('id','name_of_type')->orderBy('name_of_type')->get();
        $msme_building_facilities = msme_building_facilities::select('id','name_of_facility')->orderBy('name_of_facility')->get();
        $type_of_worship = Type_of_worship::select('id','name_of_type')->orderBy('name_of_type')->get();
        $worship_building_facilities = worship_building_facilities::select('id','name_of_facility')->orderBy('name_of_facility')->get();
        $type_of_office = Type_of_office::select('id','name_of_type')->orderBy('name_of_type')->get();
        $level_of_education = Level_of_education::select('id','name_of_level')->orderBy('name_of_level')->get();
        $type_of_health_service = Type_of_health_service::select('id','name_of_type')->orderBy('name_of_type')->get();
        $health_service_building_facilities = health_service_building_facilities::select('id','name_of_facility')->orderBy('name_of_facility')->get();
        $tribe = Tribe::select('id','name_of_tribe')->orderBy('name_of_tribe')->get();
                                                
        return view ('index', 
                [
                    'api' => 'AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE',
                    'model' => $building_model,
                    'konstruksi' => $type_of_construction,
                    'jorong' => $jorong,
                    'jenis_umkm' => $type_of_msme,
                    'fasilitas_umkm' => $msme_building_facilities,
                    'jenis_ibadah' => $type_of_worship,
                    'fasilitas_ibadah' => $worship_building_facilities,
                    'jenis_kantor' => $type_of_office,
                    'tingkat' => $level_of_education,
                    'jenis_kesehatan' => $type_of_health_service,
                    'fasilitas_kesehatan' => $health_service_building_facilities,
                    'suku' => $tribe
                ]
            
            );
    }

    public function bangunan()
    {
        $ibadah = Worship_building::count();
        $rumah = House_building::count();
        $kantor = Office_building::count();
        $pendidikan = Educational_building::count();
        $kesehatan = Health_service_building::count();
        $umkm = Msme_building::count();
        return view ('admin.building.index', 
                [
                    'ibadah' => $ibadah,
                    'rumah' => $rumah,
                    'kantor' => $kantor,
                    'pendidikan' => $pendidikan,
                    'kesehatan' => $kesehatan,
                    'umkm' => $umkm
                ]
            
            );
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
