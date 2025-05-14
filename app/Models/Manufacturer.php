<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manufacturer extends Model
{

    use HasFactory;
    /** @use HasFactory<\Database\Factories\ManufacturerFactory> */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'cnpj',
        'admin_id'
    ];

    public function admin():belongsTo{
        return $this->belongsTo(Admin::class);
    }

    public function representative():HasMany{
        return $this->hasMany(Representative::class);
    }
}
