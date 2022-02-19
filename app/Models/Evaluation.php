<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'performance',
        'communication',
        'teamwork',
        'dedication',
        'personality'
    ];

    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}
