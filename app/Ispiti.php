<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ispiti
 *
 * @package App
 * @property string $kalendarski_naziv
 * @property string $profesor
 * @property string $predmet
 * @property string $datum_izvrsavanja
*/
class Ispiti extends Model
{
    use SoftDeletes;

    protected $fillable = ['kalendarski_naziv', 'datum_izvrsavanja', 'profesor_id', 'predmet_id'];
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
     * Set to null if empty
     * @param $input
     */
    public function setPredmetIdAttribute($input)
    {
        $this->attributes['predmet_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDatumIzvrsavanjaAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['datum_izvrsavanja'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['datum_izvrsavanja'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDatumIzvrsavanjaAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }
    
    public function fakultet()
    {
        return $this->belongsToMany(Fakulteti::class, 'fakulteti_ispiti')->withTrashed();
    }
    
    public function profesor()
    {
        return $this->belongsTo(Profesori::class, 'profesor_id')->withTrashed();
    }
    
    public function predmet()
    {
        return $this->belongsTo(Predmeti::class, 'predmet_id')->withTrashed();
    }
    
}
