<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Representative extends Model
{
    use HasFactory;
    /** @use HasFactory<\Database\Factories\RepresentativeFactory> */

    public function admin():belongsTo{
        return $this->belongsTo(Admin::class);
    }
    public function manufacturer():belongsTo{
        return $this->belongsTo(Manufacturer::class);
    }
}
