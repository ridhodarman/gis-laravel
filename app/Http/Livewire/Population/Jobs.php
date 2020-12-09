<?php

namespace App\Http\Livewire\Population;

use Livewire\Component;
use App\Job;

class Jobs extends Component
{
    public function render()
    {
        $job = Job::select('id','job_name')
                            ->selectRaw('count(citizens.national_identity_number) as jumlah')
                            ->leftJoin('citizens', 'jobs.id', '=', 'citizens.job_id')
                            ->groupBy('jobs.id')
                            ->orderBy('job_name')
                            ->get();
        //return $job;
        return view ('livewire.population.jobs',['kerja' => $job]);
    }
}
