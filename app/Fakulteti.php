<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fakulteti
 *
 * @package App
 * @property string $naziv
*/
class Fakulteti extends Model
{
    use SoftDeletes;

    protected $fillable = ['naziv'];
    protected $hidden = [];
    
    
    
}
