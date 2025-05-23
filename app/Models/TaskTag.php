<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTag extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'color'];
    public function tags() {
        return $this->belongsToMany(TaskTag::class,'task_tag_task');
    }

}
