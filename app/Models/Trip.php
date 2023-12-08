<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin',
        'destination',
        'qtySeats',
        'price',

    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'tripId');
    }
}
