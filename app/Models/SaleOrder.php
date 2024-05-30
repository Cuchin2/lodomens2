<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
class SaleOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'total',

        'name',
        'last_name',
        'business',
        'document_type',
        'dni',
        'phone',
        'email',
        'country',
        'address',
        'reference',
        'city',
        'state',
        'district',
        'zip_code'
    ];
    public function deliveryOrders(): HasOne {
    
        return $this->hasOne(DeliveryOrder::class);
    }
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class,'order_id');
    }
    public function scopeSearch($query, $value)
    {
        $query->where('name','like',"%{$value}%")
        ->orWhere('total','like',"%{$value}%")
        ->orWhere('last_name','like',"%{$value}%")
         /* ->orWhereHas('roles', function ($roleQuery) use ($value) {
            $roleQuery->where('name', 'like', "%{$value}%");
        });*/
       ->orWhere('created_at','like',"%{$value}%"); 
    }
    public function convert(){
        switch ($this->attributes['status']) {
            case 'PAID':
                return 'Pagado';
            case 'TRACKING':
                return 'En camino';
            case 'CANCEL':
                return 'Cancelado';
            case 'DONE':
                    return 'Entregado';
            case 'CREATE':
                        return 'Sin pagar';
            default:
                return 'En proceso';
        }
    }
}
