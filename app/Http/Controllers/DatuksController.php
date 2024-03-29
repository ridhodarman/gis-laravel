<?php

namespace App\Http\Controllers;

use App\Datuk;
use Illuminate\Http\Request;
use Validator;

class DatuksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datuk = Datuk::select('id','datuk_name')
                            ->selectRaw('count(citizens.national_identity_number) as jumlah')
                            ->leftJoin('citizens', 'datuks.id', '=', 'citizens.datuk_id')
                            ->groupBy('datuks.id')
                            ->orderBy('datuk_name')
                            ->get();
        //return $datuk;
        return view ('admin.datuk.datuk',['datuk' => $datuk]);
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
            'datuk_name' => 'required|max:40|unique:datuks|not_regex:/`/i'
        ]);
        Datuk::create($request->all());
        $pesan = "<b>".$request->datuk_name.'</b> added successfully';
        return redirect('/datuk')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Datuk  $datuk
     * @return \Illuminate\Http\Response
     */
    public function show(Datuk $datuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Datuk  $datuk
     * @return \Illuminate\Http\Response
     */
    public function edit(Datuk $datuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Datuk  $datuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Datuk $datuk)
    {
        $validator = Validator::make($request->all(), [
            'new_name' => 'required|max:40|unique:datuks,datuk_name|not_regex:/`/i'
        ]);
        
        if ($validator->fails()) {
            $json = json_decode($validator->messages(), TRUE);
            $pesan = $json['new_name'][0];
            return redirect('/datuk')->with(
                array('gagal-edit' => $pesan, 
                        'id_edit' => $datuk->id,
                        'nama_edit' => $datuk->datuk_name,
                        'nama_baru' => $request->new_name
                    )
                );
        }
        Datuk::where('id', $datuk->id)
                            ->update([
                                'datuk_name' => $request->new_name
                            ]);
                        $pesan = "the data was successfully changed to <b>".$request->new_name.'</b>';
                        return redirect('/datuk')->with('status', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Datuk  $datuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Datuk $datuk)
    {
        Datuk::destroy($datuk->id);
        $pesan = "<b>".$datuk->datuk_name.'</b> successfully deleted !';
        return redirect('/datuk')->with('status-hapus', $pesan);
    }
}
