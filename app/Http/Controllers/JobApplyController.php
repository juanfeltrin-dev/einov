<?php

namespace App\Http\Controllers;

use App\Models\JobApply;
use App\Repository\JobApplyRepository;
use App\Repository\JobPostingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class JobApplyController extends Controller
{
    /**
     * @var JobApplyRepository
     */
    private $jobApplyRepository;
    /**
     * @var JobPostingRepository
     */
    private $jobPostingRepository;

    public function __construct(
        JobApplyRepository $jobApplyRepository,
        JobPostingRepository $jobPostingRepository
    ) {
        $this->jobApplyRepository = $jobApplyRepository;
        $this->jobPostingRepository = $jobPostingRepository;
    }

    public function index()
    {
        //
    }

    public function create($slug)
    {
        return view('jobapply.create', [
            'jobposting' => $this->jobPostingRepository->findBySlug($slug)
        ]);

    }

    public function store(Request $request)
    {
        $curriculum = Storage::disk('local')->put(
            auth()->user()->name,
            $request->file('curriculum')
        );

        $jobApply = $this->jobApplyRepository->findApplyUserBySlug($request->slug);

        if (is_null($jobApply)) {
            $jobApply = $this->jobApplyRepository->apply($request, $curriculum);
        } else {
            $jobApply->delete();

            $jobApply = $this->jobApplyRepository->apply($request, $curriculum);
        }

        Mail::to(config('mail.from.address'))
            ->send(new \App\Mail\JobApply($jobApply));

        return redirect()->route('jobposting.index');
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
