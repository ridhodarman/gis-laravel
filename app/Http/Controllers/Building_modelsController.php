<?php

namespace App\Http\Controllers;

use \App\Building_model;
use Illuminate\Http\Request;

class Building_modelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Building_model::select('id','name_of_model')
                            ->selectRaw('count(buildings.building_id) as jumlah')
                            ->leftJoin('buildings', 'building_models.id', '=', 'buildings.building_model')
                            ->groupBy('building_models.id')
                            ->orderBy('building_models.name_of_model')
                            ->get();
        //return $model;
        return view ('admin.building.model',['model' => $model]);
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
            'name_of_model' => 'required|max:40|unique:building_models'
        ]);
        Building_model::create($request->all());
        $pesan = "<b>".$request->name_of_model.'</b> added successfully';
        return redirect('/model')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Building_model  $Building_model
     * @return \Illuminate\Http\Response
     */
    public function show(Building_model $Building_model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Building_model  $Building_model
     * @return \Illuminate\Http\Response
     */
    public function edit(Building_model $Building_model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building_model  $Building_model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building_model $Building_model)
    {
        try {
            Building_model::where('id', $Building_model->id)
                ->update([
                    'name_of_model' => $request->nama_e
                ]);
            $pesan = "the data was successfully changed to <b>".$request->nama_e.'</b>';
            return redirect('/model')->with('status', $pesan);
        }
        catch(\Illuminate\Database\QueryException $ex){ 
        $p = explode("ERROR: ", $ex->getMessage());
        $p = explode(' "', $p[1]);
        $p = explode('(SQL', $p[0]);
        $pesan =$p[0];
        return redirect('/model')->with(
            array('gagal-edit' => $pesan, 
                    'id_edit' => $Building_model->id,
                    'nama_edit' => $Building_model->name_of_model,
                    'nama_baru' => $request->nama_e
                )
            );

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building_model  $Building_model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building_model $Building_model)
    {
        Building_model::destroy($Building_model->id);
        $pesan = "<b>".$Building_model->name_of_model.'</b> successfully deleted !';
        return redirect('/model')->with('status-hapus', $pesan);
    }
}
