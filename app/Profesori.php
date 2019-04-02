<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Profesori
 *
 * @package App
 * @property string $ime
 * @property string $prezime
 * @property string $zvanje
 * @property string $slika
 * @property enum $status
*/
class Profesori extends Model
{
    use SoftDeletes;

    protected $fillable = ['ime', 'prezime', 'zvanje', 'slika', 'status'];
    protected $hidden = [];
    
    

    public static $enum_status = ["redovan" => "Redovan", "gostujuci" => "Gostujuci", "vanredni" => "Vanredni"];
    
    public function fakultet()
    {
        return $this->belongsToMany(Fakulteti::class, 'fakulteti_profesori')->withTrashed();
    }
    
    public function predmeti()
    {
        return $this->belongsToMany(Predmeti::class, 'predmeti_profesori')->withTrashed();
    }
    
}
