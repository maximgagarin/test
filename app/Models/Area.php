<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class Area extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $guarded = [];

    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(payment::class, 'areas_id', 'id');
    }
}
