<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'target', 'status', 'current'
    ];

    public function banners()
    {
        return $this->hasMany(BannerCampaign::class, 'campaign_id');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }
}
