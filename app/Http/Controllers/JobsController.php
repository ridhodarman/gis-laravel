<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job = Job::select('id','job_name')
                            ->selectRaw('count(citizens.national_identity_number) as jumlah')
                            ->leftJoin('citizens', 'jobs.id', '=', 'citizens.job_id')
                            ->groupBy('jobs.id')
                            ->orderBy('job_name')
                            ->get();
        //return $job;
        return view ('admin.kependudukan.pekerjaan',['kerja' => $job]);
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
            'job_name' => 'required|max:40|unique:jobs'
        ]);
        Job::create($request->all());
        $pesan = "<b>".$request->job_name.'</b> added successfully';
        return redirect('/pekerjaan')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        try {
            Job::where('id', $job->id)
                ->update([
                    'job_name' => $request->nama_e
                ]);
            $pesan = "the data was successfully changed to <b>".$request->nama_e.'</b>';
            return redirect('/pekerjaan')->with('status', $pesan);
        }
        catch(\Illuminate\Database\QueryException $ex){ 
        $p = explode("ERROR: ", $ex->getMessage());
        $p = explode(' "', $p[1]);
        $p = explode('(SQL', $p[0]);
        $pesan =$p[0];
        return redirect('/pekerjaan')->with(
            array('gagal-edit' => $pesan, 
                    'id_edit' => $job->id,
                    'nama_edit' => $job->job_name,
                    'nama_baru' => $request->nama_e
                )
            );

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        Job::destroy($job->id);
        $pesan = "<b>".$job->job_name.'</b> successfully deleted !';
        return redirect('/pekerjaan')->with('status-hapus', $pesan);
    }
}
