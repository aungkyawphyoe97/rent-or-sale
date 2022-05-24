<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingPhoto extends Model
{
    use HasFactory;
    protected $primaryKey = 'building_photo_id';
    public $incrementing = true;
}
