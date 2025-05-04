<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;
    /** @use HasFactory<\Database\Factories\ItemFactory> */

   protected $table = 'items';

   public function admin():belongsTo{
       return $this->belongsTo(Admin::class);
   }
   public function product():belongsTo{
       return $this->belongsTo(Product::class,'product_code','code');
   }
   public function manufacturer():belongsTo{
       return $this->belongsTo(Manufacturer::class,'manufacturer_id','id');
   }
}
