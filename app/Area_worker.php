<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Area_worker
 *
 * @package App
 * @property string $nombre

*/
class Area_worker extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre'];
    
    
    
}
