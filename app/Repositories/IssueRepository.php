<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Issue;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Repository class for managing Issue-related data operations.
 * @package App\Repositories
 * @method Issue create(array $data) Creates a new issue with associated users, labels, and initial comment.
 * @
 */
class IssueRepository
{
    // Get all issues with comment count
    public function all(){
        return Issue::withCount('comments')->get('id');
    }

    // Get user with count of completed issues
    public function getIssueUserCompleted()
    {
        return User::withCount(['issues' => function ($query) {
            $query->where('status', 'completed');
        }])->get();

    }
    // Get open and urgent issues for a specific project
    public function getOpenUrgentIssues(Project $project)
    {
        return Issue::open()->urgent()
        ->whereRelation('project', 'id', $project->id)->get();
    }

    // Get open issues for a specific project
    public function getOpenIssue(Project $project)
    {
        return Issue::open()->whereRelation('project', 'id', $project->id)->get();

}
// Create a new issue with associated users, labels, and initial comment
    public function create(array $data): Issue
    {
        try {
       return DB::transaction(function () use ($data) {
            $issue = Issue::create($data);

            // إسناد المستخدمين
            if(!empty($data['reporter_id'])){
                $issue->users()->attach($data['reporter_id'], ['role' => 'reporter']);
            }

            if(!empty($data['assignee_id'])){
                $issue->users()->attach($data['assignee_id'], ['role' => 'assignee']);
            }

            if (!empty($data['label_ids'])) {
                $issue->labels()->attach($data['label_ids']);
            }

            if (!empty($data['comment'])) {
                $issue->comments()->create([
                    'user_id' => $data['reporter_id'],
                    'content' => $data['comment'],
                ]);
            }

            return $issue;
       });
       } catch (\Exception $e) {
        Log::error('Error creating issue: ' . $e->getMessage());
        throw $e;
    }
}
}
