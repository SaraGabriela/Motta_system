<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Descuento
 *
 * @package App
 * @property string $worker
 * @property string $fecha
*/
class Descuento extends Model
{
    use SoftDeletes;
    protected $fillable = ['worker_id','tardanzas','faltas','descuento_judicial','descuento_varios','descuentos','adelantos'];

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

