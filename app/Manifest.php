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

    protected $fillable = ['id_typedocument','code','attached','document_code','pick_date','id_user ','id_customer','id_customer_addresses'];

     /**
     * Set to null if empty
     * @param $input
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->id_user = auth()->user()->id;
        });
    }

    public function setManifestCustomerIdAttribute($input)
    {
        $this->attributes['id_customer'] = $input ? $input : null;
    }

    
    public function manifestCustomer()
    {
        return $this->belongsTo(ManifestCustomer::class, 'id_customer')->withTrashed();
    }


     public function setUserIdAttribute($input)
    {
        $this->attributes['id_user'] = $input ? $input : null;
    }

    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function setDocument_typeIdAttribute($input)
    {
        $this->attributes['document_type'] = $input ? $input : null;
    }

    public function document_type()
    {
        return $this->belongsTo(Document_type::class, 'id_typedocument')->withTrashed();
    }

    public function setCustomer_addressIdAttribute($input)
    {
        $this->attributes['id_customer_addresses'] = $input ? $input : null;
    }

    public function customer_address()
    {
        return $this->belongsTo(Customer_address::class, 'id_customer_addresses')->withTrashed();
    }

}
