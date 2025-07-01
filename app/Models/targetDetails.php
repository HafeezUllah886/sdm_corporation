<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class targetDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(products::class, 'productID');
    }

    public function unit()
    {
        return $this->belongsTo(units::class, 'unitID');
    }

}
