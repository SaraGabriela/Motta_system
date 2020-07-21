<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Worker
 *
 * @package App
 * @property string $nombre_del_trabajador
 * @property string $documento_indentificacion
 * @property string $banco
 * @property string $cussp
 * @property string $cuenta_sueldo
 * @property dateTime $fecha_de_ingreso
 * @property dateTime $fecha_de_cese

*/
class Worker extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre_del_trabajador','documento_indentificacion','banco','cussp','cuenta_sueldo','cuenta_interbancaria','cuenta_viaticos','fecha_de_ingreso','fecha_de_cese','pension_id','total_dias_pagado'];
    

        
    public function job_title()
    {
        return $this->belongsToMany(Job_title::class, 'job_titles_workers');
    }
    public function area_worker()
    {
        return $this->belongsToMany(Area_worker::class, 'worker_area_work');
    }
    public function subarea_worker()
    {
        return $this->belongsToMany(Subarea_worker::class, 'worker_subarea_work');
    }
    public function pension()
    {
        return $this->belongsToMany(Pension::class, 'pension_id')->withTrashed();
    }

}
