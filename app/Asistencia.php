<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Asistencia 
 *
 * @package App
 * @property string $worker
 * @property string $fecha
*/
class Asistencia extends Model
{
    use SoftDeletes;

    protected $fillable = ['worker_id','dias_vacaciones','descanso_medico','horas_extra_25','horas_extra_35','horas_extra_100'];
    
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

