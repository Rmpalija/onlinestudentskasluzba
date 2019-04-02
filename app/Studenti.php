<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Studenti
 *
 * @package App
 * @property string $ime
 * @property string $prezime
 * @property string $jmb
 * @property string $index
 * @property enum $status
 * @property string $slika
 * @property string $fakultet
*/
class Studenti extends Model
{
    use SoftDeletes;

    protected $fillable = ['ime', 'prezime', 'jmb', 'index', 'status', 'slika', 'fakultet_id'];
    protected $hidden = [];
    
    

    public static $enum_status = ["redovan" => "Redovan", "vanredan" => "Vanredan"];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setFakultetIdAttribute($input)
    {
        $this->attributes['fakultet_id'] = $input ? $input : null;
    }
    
    public function predmeti()
    {
        return $this->belongsToMany(Predmeti::class, 'predmeti_studenti')->withTrashed();
    }
    
    public function fakultet()
    {
        return $this->belongsTo(Fakulteti::class, 'fakultet_id')->withTrashed();
    }
    
}
