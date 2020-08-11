<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sector
 *
 * @package App
 * @property string $name
 * @property string $address
 * @property string $photo
*/
class Sector extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    
}
