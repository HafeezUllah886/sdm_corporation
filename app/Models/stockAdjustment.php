<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stockAdjustment extends Model
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

    public function warehouse()
    {
        return $this->belongsTo(warehouses::class, 'warehouseID');
    }
}
