<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'hours_worked',
        'overtime_worked',
        'payment_date',
        'amount',
        'bonus'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function evaluation() {
        return $this->hasOne(Evaluation::class);
    }
}
