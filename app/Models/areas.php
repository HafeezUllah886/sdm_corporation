<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class areas extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function town()
    {
        return $this->belongsTo(town::class, 'townID');
    }
}
