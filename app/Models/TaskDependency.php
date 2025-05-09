<?php

namespace App\Models;

use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDependency extends Model
{
    use HasFactory;
    protected $fillable = ['task_id', 'depends_on_task_id'];

    public function task() {
        return $this->belongsTo(Tache::class, 'task_id');
    }

    public function dependsOn() {
        return $this->belongsTo(Tache::class, 'depends_on_task_id');
    }
}
