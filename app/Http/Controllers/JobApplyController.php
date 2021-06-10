<?php

namespace App\Http\Controllers;

use App\Models\JobApply;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JobApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function create(String $slug)
    {
        $validator = Validator::make(compact('slug'),[
            'slug' => [
                'required',
                Rule::exists('job_postings')->where(function ($query) use ($slug) {
                    return $query->where('slug', $slug)->where('valid_through','>=',now());
                }),
            ],
        ],[
            'slug.exists' => 'Que pena, está vaga já não está mais disponível.',
        ]);

        if ($validator->fails()) {
            return redirect(route('jobposting.index'))
                ->withErrors($validator);
        }

        $jobposting = JobPosting::where('slug','=',$slug)->where('valid_through','>=',now())->first();
        return view('jobapply.create',compact('jobposting'));

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
     * @param  \App\Models\JobApply  $jobApply
     * @return \Illuminate\Http\Response
     */
    public function show(JobApply $jobApply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobApply  $jobApply
     * @return \Illuminate\Http\Response
     */
    public function edit(JobApply $jobApply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobApply  $jobApply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobApply $jobApply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobApply  $jobApply
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobApply $jobApply)
    {
        //
    }
}
