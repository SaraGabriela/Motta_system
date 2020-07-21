<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Job_title
 *
 * @package App
 * @property string $nombre

*/
class Job_title extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre'];
    
    
    
}
