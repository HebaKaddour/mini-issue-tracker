<?php

namespace App\Models;

use App\Casts\DueWindowCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Issue model representing an issue in the issue tracking system.
 *
 * @package App\Models
 * Relationships:
 * @property-read \App\Models\Project $project The project this issue belongs to.
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users The users associated with this issue.
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $assignees The assignees of this issue.
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $reporters The reporters of this issue.
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments The comments on this issue.
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Label[] $labels The labels associated with this issue.
 */
class Issue extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status',
    'project_id',  'code', 'priority', 'due_window'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'issue_user', 'issue_id', 'user_id')
        ->withPivot('role');
    }

    public function assignees()
    {
        return $this->users()->wherePivot('role', 'assignee');
    }
    public function reporters()
    {
        return $this->users()->wherePivot('role', 'reporter');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'issue_label', 'issue_id', 'label_id');
    }

    // Custom casts for due_window field
    protected $casts = [
        'due_window' => DueWindowCast::class,
    ];
// Mutators and Accessors for title and code
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    public function getCodeAttribute($value){
        return '#' . $value;
    }

    // Scope to filter open issues
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

// Scope to filter urgent issues
    public function scopeUrgent($query)
    {
        return $query->where('priority', 'urgent');
    }
}
