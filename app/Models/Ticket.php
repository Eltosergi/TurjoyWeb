<?php

namespace App\Models;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'seat',
        'total',
        'date',
        'tripId'

    ];

    public function travelDates()
    {
        return $this->belongsTo(Trip::class, 'travelId');
    }
}
