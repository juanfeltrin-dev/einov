<?php


namespace App\Repository;


use App\Models\JobApply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplyRepository
{
    /**
     * @var JobApply
     */
    private $jobApply;

    /**
     * @var JobPostingRepository
     */
    private $jobPostingRepository;

    public function __construct(
        JobApply $jobApply,
        JobPostingRepository $jobPostingRepository
    ) {
        $this->jobApply = $jobApply;
        $this->jobPostingRepository = $jobPostingRepository;
    }

    public function findApplyUserBySlug($slug)
    {
        return $this->jobApply
            ->with('jobPosting')
            ->whereHas('jobPosting', function ($query) use ($slug) {
                $query->where([
                    ['slug', '=', $slug]
                ]);
            })
            ->where('user_id', auth()->user()->id)
            ->first();
    }

    public function apply(Request $request, $file)
    {
        $jobPosting = $this->jobPostingRepository->findBySlug($request->slug);

        return $this->jobApply->create([
            'user_id' => auth()->user()->id,
            'job_posting_id' => $jobPosting->id,
            'curriculum' => Storage::path($file),
            'challenge_date' => $request->challenge_date,
            'salary_claim' => $request->salary_claim,
        ]);
    }
}
