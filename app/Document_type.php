<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Bath
 *
 * @package App
 * @property string $name
*/
class Document_type extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    
    
    
}
