<?php

namespace App\Http\Controllers;

use \App\Type_of_construction;
use Illuminate\Http\Request;
use Validator;

class Type_of_constructionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konstruksi = Type_of_construction::select('id','name_of_type')
                            ->selectRaw('count(buildings.building_id) as jumlah')
                            ->leftJoin('buildings', 'type_of_constructions.id', '=', 'buildings.type_of_construction')
                            ->groupBy('type_of_constructions.id')
                            ->orderBy('type_of_constructions.name_of_type')
                            ->get();
        //return $konstruksi;
        return view ('admin.building.konstruksi',['konstruksi' => $konstruksi]);
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
        $request->validate([
            'name_of_type' => 'required|max:40|unique:type_of_constructions'
        ]);
        Type_of_construction::create($request->all());
        $pesan = "<b>".$request->name_of_type.'</b> added successfully';
        return redirect('/konstruksi')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type_of_construction  $Type_of_construction
     * @return \Illuminate\Http\Response
     */
    public function show(Type_of_construction $Type_of_construction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type_of_construction  $Type_of_construction
     * @return \Illuminate\Http\Response
     */
    public function edit(Type_of_construction $Type_of_construction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type_of_construction  $Type_of_construction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type_of_construction $Type_of_construction)
    {
        
        try {
            Type_of_construction::where('id', $Type_of_construction->id)
                ->update([
                    'name_of_type' => $request->nama_e
                ]);
            $pesan = "the data was successfully changed to <b>".$request->nama_e.'</b>';
            return redirect('/konstruksi')->with('status', $pesan);
        }
        catch(\Illuminate\Database\QueryException $ex){ 
        $p = explode("ERROR: ", $ex->getMessage());
        $p = explode(' "', $p[1]);
        $p = explode('(SQL', $p[0]);
        $pesan =$p[0];
        return redirect('/konstruksi')->with(
            array('gagal-edit' => $pesan, 
                    'id_edit' => $Type_of_construction->id,
                    'nama_edit' => $Type_of_construction->name_of_type,
                    'nama_baru' => $request->nama_e
                )
            );

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type_of_construction  $Type_of_construction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type_of_construction $Type_of_construction)
    {
        Type_of_construction::destroy($Type_of_construction->id);
        $pesan = "<b>".$Type_of_construction->name_of_type.'</b> successfully deleted !';
        return redirect('/konstruksi')->with('status-hapus', $pesan);
    }
}