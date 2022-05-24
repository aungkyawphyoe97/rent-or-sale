<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingLocation extends Model
{
    use HasFactory;
    protected $primaryKey = 'building_location_id';
    public $incrementing = true;
}
