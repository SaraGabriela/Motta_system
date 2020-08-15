<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer_address
 *
 * @package App
 * @property string $name_address
*/
class Customer_address extends Model
{
    use SoftDeletes;

    protected $fillable = ['name_address','id_customers'];
    

    
    public function setManifestCustomerIdAttribute($input)
    {
        $this->attributes['id_customers'] = $input ? $input : null;
    }

    public function manifestcustomer()
    {
        return $this->belongsTo(ManifestCustomer::class, 'id_customers')->withTrashed();
    }


}
