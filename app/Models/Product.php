<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Product extends Model
{
    use HasFactory;
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'code',
        'admin_id',
    ];
    public function admin():belongsTo{
        return $this->belongsTo(Admin::class);
    }
    public function items():hasMany{
        return $this->hasMany(Item::class);
    }
}
