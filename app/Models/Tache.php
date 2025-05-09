<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'statut',
        'priorite',
        'date_debut',
        'date_fin',
        'date_effective',
        'created_by',
        'project_id',
        'category_id',
        'assigned_to'
    ];
    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function category() {
        return $this->belongsTo(TaskCategory::class, 'category_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function tags() {
        return $this->belongsToMany(TaskTag::class,'task_tag_task');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function dependencies() {
        return $this->hasMany(TaskDependency::class, 'task_id');
    }

    public function feedbacks() {
        return $this->hasMany(TaskFeedback::class);
    }
}
