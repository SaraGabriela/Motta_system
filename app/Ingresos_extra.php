<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ingresos_extra
 *
 * @package App
 * @property string $worker
 * @property string $fecha
*/
class Ingresos_extra extends Model
{
    use SoftDeletes;
    protected $fillable = ['worker_id','bono','bono_sueldo','movilidad'];

    /**
     * Set to null if empty
     * @param $input
     */
    
    public function setWorkerIdAttribute($input)
    {
        $this->attributes['worker_id'] = $input ? $input : null;
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id')->withTrashed();
    }
    
    
}

