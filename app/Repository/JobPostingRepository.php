<?php


namespace App\Repository;


use App\Models\JobPosting;

class JobPostingRepository
{
    /**
     * @var JobPosting
     */
    private $jobPosting;

    public function __construct(JobPosting $jobPosting)
    {
        $this->jobPosting = $jobPosting;
    }

    public function all()
    {
        return $this->jobPosting
            ->where('valid_through', '>=', now())
            ->get();
    }

    public function findBySlug($slug)
    {
        return $this->jobPosting
            ->where([
                ['slug', '=', $slug],
                ['valid_through', '>=', now()]
            ])
            ->firstOrFail();
    }
}
