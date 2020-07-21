<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pension
 *
 * @package App
 * @property string $nombre
*/
class Pension extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre','fecha','obligatorio','seguro','variable','estado'];
}
