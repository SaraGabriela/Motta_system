<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pension
 *
 * @package App
 * @property string $document_type
 * @property string $sector
*/
class Manifest extends Model
{

    use SoftDeletes;

    protected $fillable = ['document_type','attached','creation_date','pick_date','id_user ','id_customer','id_typedocument'];

     /**
     * Set to null if empty
     * @param $input
     */


    public function setManifest_customerIdAttribute($input)
    {
        $this->attributes['id_customer'] = $input ? $input : null;
    }

    
    public function manifest_customer()
    {
        return $this->belongsTo(Manifest_customer::class, 'id_customer')->withTrashed();
    }


     public function setUserIdAttribute($input)
    {
        $this->attributes['id_user'] = $input ? $input : null;
    }

    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user')->withTrashed();
    }

}
