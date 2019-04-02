<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Predmeti
 *
 * @package App
 * @property string $naziv
 * @property string $profesor
 * @property integer $semestar
*/
class Predmeti extends Model
{
    use SoftDeletes;

    protected $fillable = ['naziv', 'semestar', 'profesor_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProfesorIdAttribute($input)
    {
        $this->attributes['profesor_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setSemestarAttribute($input)
    {
        $this->attributes['semestar'] = $input ? $input : null;
    }
    
    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }
    
    public function fakulteti()
    {
        return $this->belongsToMany(Fakulteti::class, 'fakulteti_predmeti')->withTrashed();
    }
    
}
