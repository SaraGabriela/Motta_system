<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subarea_worker
 *
 * @package App
 * @property string $nombre

*/
class Subarea_worker extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre'];
    
    public function area_worker()
    {
        return $this->belongsToMany(Area_worker::class, 'subarea_area_workers');
    }

}
