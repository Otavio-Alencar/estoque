<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{

    use HasFactory;
    /** @use HasFactory<\Database\Factories\ManufacturerFactory> */
    public function representative(){
        return $this->belongsTo(Representative::class);
    }
}
