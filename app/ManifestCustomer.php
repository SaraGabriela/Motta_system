<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ManifestCustomer
 *
 * @package App
 * @property string $name
 * @property string $contact_phone
 * @property string $ruc
*/
class ManifestCustomer extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','contact_phone','ruc','contact_name','id_sector'];
    

    public function setSectorIdAttribute($input)
    {
        $this->attributes['id_sector'] = $input ? $input : null;
    }
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'id_sector')->withTrashed();
    }
}
