<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'quantity',
        'sale_value',
        'sale_date',
        'proof',
        'product_code',
        'manufacturer_id',
        'item_id',
        'admin_id',
    ];
    public function admin():belongsTo{
        return $this->belongsTo(Admin::class);
    }
    public function product():belongsTo{
        return $this->belongsTo(Product::class,'product_code','code');
    }
    public function manufacturer():belongsTo{
        return $this->belongsTo(Manufacturer::class);
    }
    public function item():belongsTo{
        return $this->belongsTo(item::class);
    }
}
