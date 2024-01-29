<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'id_warehouse_origin',
        'id_warehouse_destination',
        'id_stock',
        'created_by',
        'update_by',
        'created_at',
    ];
}
