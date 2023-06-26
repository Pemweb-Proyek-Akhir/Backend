<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'campaign_id',
        'package_id',
        'name',
        'address',
        'phone_number',
        'quantity',
        'price',
        'total',
        'payment_method',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
