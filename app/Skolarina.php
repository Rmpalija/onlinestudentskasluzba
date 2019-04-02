<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Skolarina
 *
 * @package App
 * @property string $student
 * @property integer $semestar
 * @property decimal $uplata
*/
class Skolarina extends Model
{
    use SoftDeletes;

    protected $fillable = ['semestar', 'uplata', 'student_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setStudentIdAttribute($input)
    {
        $this->attributes['student_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setSemestarAttribute($input)
    {
        $this->attributes['semestar'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setUplataAttribute($input)
    {
        $this->attributes['uplata'] = $input ? $input : null;
    }
    
    public function student()
    {
        return $this->belongsTo(Studenti::class, 'student_id')->withTrashed();
    }
    
}
