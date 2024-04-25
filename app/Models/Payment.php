<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function payment_mov(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(payment_mov::class, 'payments_id', 'id');
    }

    public function area(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->belongsTo(Area::class);
    }
}
