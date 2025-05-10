<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'tache_id', 'filename', 'filepath', 'user_id',
    ];

    public function tache()
    {
        return $this->belongsTo(Tache::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
