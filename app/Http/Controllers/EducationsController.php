<?php

namespace App\Http\Controllers;

use App\Education;
use Illuminate\Http\Request;

class EducationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $education = Education::select('id','education_level')
                            ->selectRaw('count(citizens.national_identity_number) as jumlah')
                            ->leftJoin('citizens', 'educations.id', '=', 'citizens.educations')
                            ->groupBy('educations.id')
                            ->orderBy('id')
                            ->get();
        //return $education;
        return view ('admin.kependudukan.pendidikan',['pendidikan' => $education]);
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
            'education_level' => 'required|max:40|unique:educations'
        ]);
        Education::create($request->all());
        $pesan = "<b>".$request->education_level.'</b> added successfully';
        return redirect('/pendidikan')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education $education)
    {
        try {
            Education::where('id', $education->id)
                ->update([
                    'education_level' => $request->nama_e
                ]);
            $pesan = "the data was successfully changed to <b>".$request->nama_e.'</b>';
            return redirect('/pendidikan')->with('status', $pesan);
        }
        catch(\Illuminate\Database\QueryException $ex){ 
        $p = explode("ERROR: ", $ex->getMessage());
        $p = explode(' "', $p[1]);
        $p = explode('(SQL', $p[0]);
        $pesan =$p[0];
        return redirect('/pendidikan')->with(
            array('gagal-edit' => $pesan, 
                    'id_edit' => $education->id,
                    'nama_edit' => $education->education_level,
                    'nama_baru' => $request->nama_e
                )
            );

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        Education::destroy($education->id);
        $pesan = "<b>".$education->education_level.'</b> successfully deleted !';
        return redirect('/pendidikan')->with('status-hapus', $pesan);
    }
}
