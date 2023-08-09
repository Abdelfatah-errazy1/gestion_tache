 <?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prerequis extends Model
{
    use HasFactory;
    public $table='prerequis';
    protected $fillable = [
        'prerequis',
        'tache'
        ];
}
