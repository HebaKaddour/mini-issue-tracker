<?php

namespace App\Http\Controllers;

use App\Services\IssueService;
use App\Http\Requests\IssueRequest;
use App\Models\Project;
/**
 *
 */
class IssueController extends Controller
{
    protected $issueService;
    public function __construct(IssueService $issueService)
    {
        $this->issueService = $issueService;
    }

    public function index()
    {
        return self::success($this->issueService->getAllIssues());
    }

    public function store(IssueRequest $request)
    {
        return self::success($this->issueService->createIssue($request->validated()), 'Issue created successfully', 201);
    }

    public function getIssueUserCompleted()
    {
        return self::success($this->issueService->getIssueUserCompleted());
    }

    public function getOpenUrgentIssues(Project $project)
    {
        return self::success($this->issueService->getOpenUrgentIssues($project));
    }

    public function getOpenIssue(Project $project)
    {
        return self::success($this->issueService->getOpenIssue($project));
    }


}
