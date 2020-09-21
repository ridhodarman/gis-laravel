<?php

namespace App\Http\Controllers;

use \App\Building_model;
use Illuminate\Http\Request;
use Validator;

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
            'name_of_model' => 'required|max:40|unique:building_models|not_regex:/`/i'
        ]);
        Building_model::create($request->all());
        $nama = str_replace('"',"", $request->name_of_type);
        $pesan = "<b>".$nama."</b> added successfully";
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
        $validator = Validator::make($request->all(), [
            'new_name' => 'required|max:40|unique:building_models,name_of_model|not_regex:/`/i'
        ]);
        
        if ($validator->fails()) {
            $json = json_decode($validator->messages(), TRUE);
            $pesan = $json['new_name'][0];
            return redirect('/model')->with(
                array('gagal-edit' => $pesan, 
                        'id_edit' => $Building_model->id,
                        'nama_edit' => $Building_model->name_of_model,
                        'nama_baru' => $request->new_name
                    )
                );
        }
        Building_model::where('id', $Building_model->id)
                            ->update([
                                'name_of_model' => $request->new_name
                            ]);
                        $nama = str_replace('"',"", $request->new_name);
                        $pesan = "the name of the building model has been changed to <b>".$nama."</b>";
                        return redirect('/model')->with('status', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building_model  $Building_model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building_model $Building_model)
    {
        $model = Building_model::find($Building_model->id);
        $model->delete();
        $nama = str_replace('"',"", $Building_model->name_of_model);
        $pesan = "<b>".$nama."</b> successfully deleted !";
        return redirect('/model')->with('status-hapus', $pesan);
    }
}
