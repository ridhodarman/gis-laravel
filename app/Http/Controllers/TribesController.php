<?php

namespace App\Http\Controllers;

use App\Tribe;
use Illuminate\Http\Request;

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
                            ->orderBy('tribes.name_of_tribe')
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
            'name_of_tribe' => 'required|max:40|unique:tribes'
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
        try {
            Tribe::where('id', $tribe->id)
                ->update([
                    'name_of_tribe' => $request->nama_e
                ]);
            $pesan = "the data was successfully changed to <b>".$request->nama_e.'</b>';
            return redirect('/suku')->with('status', $pesan);
        }
        catch(\Illuminate\Database\QueryException $ex){ 
        $p = explode("ERROR: ", $ex->getMessage());
        $p = explode(' "', $p[1]);
        $p = explode('(SQL', $p[0]);
        $pesan =$p[0];
        return redirect('/suku')->with(
            array('gagal-edit' => $pesan, 
                    'id_edit' => $tribe->id,
                    'nama_edit' => $tribe->name_of_tribe,
                    'nama_baru' => $request->nama_e
                )
            );

        }
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
