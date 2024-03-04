<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incoming extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function areas()
    {
        return $this->belongsTo(Area::class, 'areas_id', 'id');
    }
}
