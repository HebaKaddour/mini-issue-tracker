<?php
namespace App\Services;


use App\Models\User;
use App\Models\Issue;
use App\Models\Label;
use App\Models\Comment;
use App\Models\Project;
use App\Repositories\IssueRepository;


class IssueService
{
    protected $issueRepository;

    public function __construct(IssueRepository $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function getAllIssues()
    {
        return $this->issueRepository->all();
    }

    public function getIssueUserCompleted()
    {
        return $this->issueRepository->getIssueUserCompleted();
    }

    public function getOpenUrgentIssues(Project$project)
    {
        return $this->issueRepository->getOpenUrgentIssues($project);
    }

    public function getOpenIssue($project)
    {
        return $this->issueRepository->getOpenIssue($project);
    }

    public function createIssue(array $data): Issue
    {
        return $this->issueRepository->create($data);
    }
}
