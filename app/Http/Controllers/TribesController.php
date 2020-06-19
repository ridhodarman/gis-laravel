<?php

namespace App\Http\Controllers;

use App\Tribe;
use Illuminate\Http\Request;
use Validator;

class TribesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tribe = Tribe::select('tribes.id','name_of_tribe')
                            ->selectRaw('count(datuks.id) as jumlah')
                            ->leftJoin('datuks', 'tribes.id', '=', 'datuks.tribe_id')
                            ->groupBy('tribes.id')
                            ->orderBy('name_of_tribe')
                            ->get();
        //return $tribe;
        return view ('admin.datuk.suku',['suku' => $tribe]);
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
            'name_of_tribe' => 'required|max:40|unique:tribes|not_regex:/`/i'
        ]);
        Tribe::create($request->all());
        $pesan = "<b>".$request->name_of_tribe.'</b> added successfully';
        return redirect('/suku')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tribe  $tribe
     * @return \Illuminate\Http\Response
     */
    public function show(Tribe $tribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tribe  $tribe
     * @return \Illuminate\Http\Response
     */
    public function edit(Tribe $tribe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tribe  $tribe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tribe $tribe)
    {
        $validator = Validator::make($request->all(), [
            'new_name' => 'required|max:40|unique:tribes,name_of_tribe|not_regex:/`/i'
        ]);
        
        if ($validator->fails()) {
            $json = json_decode($validator->messages(), TRUE);
            $pesan = $json['new_name'][0];
            return redirect('/suku')->with(
                array('gagal-edit' => $pesan, 
                        'id_edit' => $tribe->id,
                        'nama_edit' => $tribe->name_of_tribe,
                        'nama_baru' => $request->new_name
                    )
                );
        }
        Tribe::where('id', $tribe->id)
                            ->update([
                                'name_of_tribe' => $request->new_name
                            ]);
                        $pesan = "the data was successfully changed to <b>".$request->new_name.'</b>';
                        return redirect('/suku')->with('status', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tribe  $tribe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tribe $tribe)
    {
        Tribe::destroy($tribe->id);
        $pesan = "<b>".$tribe->name_of_tribe.'</b> successfully deleted !';
        return redirect('/suku')->with('status-hapus', $pesan);
    }
}
