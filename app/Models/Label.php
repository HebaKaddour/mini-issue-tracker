<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'color', 'description'];

    public function issues()
    {
        return $this->belongsToMany(Issue::class, 'issue_label', 'label_id', 'issue_id');
    }
}
