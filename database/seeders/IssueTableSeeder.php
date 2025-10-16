<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Issue;
use App\Models\Label;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueTableSeeder extends Seeder
{
    public function run()
    {
        Issue::truncate();
        DB::table('issue_user')->truncate();
        DB::table('issue_label')->truncate();

        $projects = Project::all();
        $users = User::all();
        $labels = Label::pluck('id')->toArray();

        $statuses = ['open', 'in_progress', 'completed'];
        $priorities = ['low', 'medium', 'high'];

        foreach ($projects as $project) {
            for ($i = 1; $i <= 5; $i++) {
                $issue = Issue::create([
                    'code' => 'ISS-' . strtoupper($project->id . $i),
                    'title' => "Test Issue $i for {$project->name}",
                    'description' => 'This is a seeded test issue.',
                    'status' => $statuses[array_rand($statuses)],
                    'priority' => $priorities[array_rand($priorities)],
                    'due_window' => [
                        'start' => now(),
                        'end' => now()->addDays(rand(3, 15)),
                    ],
                    'project_id' => $project->id,
                ]);

                // إسناد المستخدمين
                $reporter = $users->random();
                $assignee = $users->where('id', '!=', $reporter->id)->random();

                $issue->users()->attach($reporter->id, ['role' => 'reporter']);
                $issue->users()->attach($assignee->id, ['role' => 'assignee']);

                // ربط التسميات
                $issue->labels()->attach(array_rand($labels, rand(1, 2)));

                // تعليق مبدئي
                $issue->comments()->create([
                    'user_id' => $reporter->id,
                    'content' => "Seeded issue created by {$reporter->name}.",
                ]);
            }
        }
    }
}
