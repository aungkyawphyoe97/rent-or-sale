<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LengthMeasurement extends Model
{
    use HasFactory;
    protected $primaryKey = 'length_measurement_id';
    public $incrementing = true;
}
